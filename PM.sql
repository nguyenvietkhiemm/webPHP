CREATE DATABASE PM;
USE PM;
-- Khách hàng khi muốn mua hàng => phải đăng ký tài khoản => bảng users

CREATE TABLE roles(
    id INT PRIMARY KEY,
    name VARCHAR(20) NOT NULL 
);

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) DEFAULT '',
    phone_number VARCHAR(10) NOT NULL,
    address VARCHAR(200) DEFAULT '',
    username varchar(25) NOT NULL default '',
    password VARCHAR(100) NOT NULL DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    active TINYINT(1) DEFAULT 1,
    role_id int,
    FOREIGN KEY (role_id) REFERENCES roles (id)
);



CREATE TABLE tokens(
    id int PRIMARY KEY AUTO_INCREMENT,
    token varchar(255) UNIQUE NOT NULL,
    token_type varchar(50) NOT NULL,
    expiration_date DATETIME,
    revoked tinyint(1) NOT NULL,
    expired tinyint(1) NOT NULL,
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng danh mục sản phẩm(Category)
CREATE TABLE categories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL DEFAULT '' COMMENT 'Tên danh mục, vd: đồ điện tử'
);

-- Bảng chứa sản phẩm(Product): "laptop macbook air 15 inch 2023", iphone 15 pro,...
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(350) COMMENT 'Tên sản phẩm',
    price FLOAT NOT NULL CHECK (price >= 0),
    count int(11),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    category_id INT,
    deleted boolean not null default false,
    FOREIGN KEY (category_id) REFERENCES categories (id)
);
-- Đặt hàng - orders
CREATE TABLE orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id),
    fullname VARCHAR(100) DEFAULT '',
    phone_number VARCHAR(20) NOT NULL,
    note VARCHAR(100) DEFAULT '',
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled'),
    shipping_method varchar(100),
    shipping_address varchar (200),
    shipping_date date,
    payment_method varchar(100)
);

-- Nhập hàng - 

CREATE TABLE imported_orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id),
    note VARCHAR(100) DEFAULT '',
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_details(
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    order_type ENUM('order', 'imported_order') NOT NULL,
    product_id INT,
    FOREIGN KEY (product_id) REFERENCES products (id),
    price FLOAT CHECK(price >= 0),
    number_of_products INT CHECK(number_of_products > 0),
    total_money FLOAT CHECK(total_money >= 0)
);

DELIMITER //

CREATE TRIGGER before_insert_order_details
BEFORE INSERT ON order_details
FOR EACH ROW
BEGIN
    IF NEW.order_type = 'order' THEN
        IF NOT EXISTS (SELECT 1 FROM orders WHERE id = NEW.order_id) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Order ID does not exist in orders table';
        END IF;
    ELSEIF NEW.order_type = 'imported_order' THEN
        IF NOT EXISTS (SELECT 1 FROM imported_orders WHERE id = NEW.order_id) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Order ID does not exist in imported_orders table';
        END IF;
    END IF;
END

 // DELIMITER ;
 
DELIMITER //

CREATE TRIGGER after_order_insert
AFTER INSERT ON order_details
FOR EACH ROW
BEGIN
    -- Update the products count based on order_type
    IF (NEW.order_type = 'order') THEN
        UPDATE products
        SET count = count - NEW.number_of_products
        WHERE id = NEW.product_id;
    ELSE
        UPDATE products
        SET count = count + NEW.number_of_products
        WHERE id = NEW.product_id;
    END IF;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER after_order_update
AFTER UPDATE ON order_details
FOR EACH ROW
BEGIN
    DECLARE old_product_count INT;
    DECLARE new_product_count INT;
    DECLARE diff INT;

    -- Tính sự khác biệt giữa số lượng sản phẩm cũ và mới
    SET diff = NEW.number_of_products - OLD.number_of_products;

    -- Nếu order_type không thay đổi
    IF NEW.order_type = OLD.order_type THEN
        IF NEW.order_type = 'order' THEN
            -- Cập nhật giảm số lượng sản phẩm
            UPDATE products
            SET count = count - diff
            WHERE id = NEW.product_id;
        ELSE
            -- Cập nhật tăng số lượng sản phẩm
            UPDATE products
            SET count = count + diff
            WHERE id = NEW.product_id;
        END IF;
    ELSE
        -- Nếu order_type thay đổi, điều chỉnh số lượng sản phẩm theo giá trị cũ
        IF OLD.order_type = 'order' THEN
            UPDATE products
            SET count = count + OLD.number_of_products
            WHERE id = OLD.product_id;
        ELSE
            UPDATE products
            SET count = count - OLD.number_of_products
            WHERE id = OLD.product_id;
        END IF;

        -- Điều chỉnh số lượng sản phẩm theo giá trị mới
        IF NEW.order_type = 'order' THEN
            UPDATE products
            SET count = count - NEW.number_of_products
            WHERE id = NEW.product_id;
        ELSE
            UPDATE products
            SET count = count + NEW.number_of_products
            WHERE id = NEW.product_id;
        END IF;
    END IF;
END //

DELIMITER ;