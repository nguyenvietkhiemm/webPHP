INSERT INTO roles 
VALUES (1, 'Admin'),
(2, 'Manager'); 

insert into users (fullname, phone_number, address, username, password, role_id)
value ('Nguyễn Việt Khiêm', '0919804815', 'Hà Nội', 'nguyenvietkhiem', '8248030068', 1),
('Trương Công Tuấn Thành', '0919804815', 'Hà Nội', 'truongcongtuanthanh', '8248030068', 2);


INSERT INTO categories (name) VALUES 
('Hàng tiêu dùng'),
('Đồ điện tử'),
('Thời trang'),
('Thực phẩm'),
('Đồ gia dụng');

use pm;
insert into products(name, price, count, category_id)
value ("Test1", 3500, 1530, 4);

insert into products(name, price, count, category_id)
value ("Mì tôm hảo hảo", 3500, 1530, 4),
('Sữa tươi Vinamilk', 12000, 500, 4),
('Bánh quy Oreo', 25000, 300, 4),
('Nước ngọt Coca-Cola', 10000, 1000, 4),
('Tivi Samsung', 30000000, 50, 2),
('Máy giặt LG', 40000000, 30, 2),
('Áo thun Nam', 150000, 200, 3),
('Quần Jeans Nữ', 250000, 150, 3),
('Túi xách Nữ', 500000, 100, 3),
('Gạo ST25', 8000, 1000, 4),
('Đèn LED Philips', 100000, 400, 2),
('Bếp từ Panasonic', 1500000, 50, 2),
('Kem đánh răng P/S', 15000, 700, 1),
('Xà bông Lifebuoy', 10000, 800, 1),
('Bột giặt Omo', 50000, 600, 1),
('Máy tính Dell', 80000000, 20, 2),
('Điện thoại iPhone', 100000000, 15, 2),
('Giày thể thao Nike', 600000, 100, 3),
('Mì gói Omachi', 3000, 2000, 4),
('Nước mắm Nam Ngư', 20000, 1500, 4),
('Sữa rửa mặt Nivea', 60000, 500, 1),
('Nồi cơm điện Sharp', 500000, 80, 2),
('Máy xay sinh tố Philips', 300000, 70, 2),
('Áo sơ mi Nữ', 200000, 200, 3),
('Đồ chơi Lego', 350000, 50, 1),
('Sách giáo khoa Toán', 100000, 300, 1),
('Bình nước Lock&Lock', 70000, 500, 4),
('Máy sấy tóc Panasonic', 250000, 100, 2),
('Chăn lông cừu', 400000, 150, 4),
('Thảm trải sàn', 700000, 100, 4),
('Bàn làm việc', 1200000, 40, 4),
('Bánh mì gối', 15000, 500, 4),
('Nước ép trái cây', 25000, 300, 4),
('Trứng gà', 3000, 1000, 4),
('Điện thoại Samsung', 25000000, 50, 2),
('Laptop HP', 20000000, 30, 2),
('Quần short nam', 100000, 200, 3),
('Áo khoác nữ', 300000, 150, 3),
('Túi du lịch', 700000, 100, 3),
('Bánh quy AFC', 15000, 1000, 4),
('Pin sạc dự phòng', 500000, 400, 2),
('Máy pha cà phê', 2000000, 50, 2),
('Sữa rửa mặt Olay', 120000, 700, 1),
('Nước lau sàn', 20000, 800, 1),
('Dầu gội Head & Shoulders', 80000, 600, 1),
('Máy in Canon', 3000000, 20, 2),
('Máy ảnh Sony', 15000000, 15, 2),
('Giày cao gót', 500000, 100, 3),
('Snack Poca', 12000, 2000, 4),
('Mắm tôm', 15000, 1500, 4),
('Kem dưỡng da', 250000, 500, 1),
('Nồi chiên không dầu', 3000000, 80, 2),
('Máy làm sữa chua', 1000000, 70, 2),
('Váy đầm', 500000, 200, 3),
('Mô hình Gundam', 600000, 50, 1),
('Sách truyện tranh', 50000, 300, 1),
('Hộp đựng thực phẩm', 50000, 500, 4),
('Bàn phím cơ', 1500000, 100, 2),
('Chăn điện', 1000000, 150, 4),
('Quạt điều hòa', 2000000, 100, 4),
('Giá sách', 300000, 40, 4),
('Đèn ngủ', 200000, 200, 4),
('Bột ngũ cốc', 80000, 500, 4),
('Tivi LG', 25000000, 30, 2),
('Loa Bluetooth', 1000000, 200, 2),
('Chuột máy tính', 500000, 300, 2),
('Áo sơ mi nam', 200000, 400, 3),
('Váy maxi', 350000, 150, 3),
('Kem chống nắng', 200000, 500, 1),
('Sữa chua Vinamilk', 12000, 800, 4),
('Bánh bông lan', 50000, 1000, 4),
('Bột giặt Ariel', 150000, 600, 1),
('Máy xay cầm tay', 800000, 70, 2),
('Máy ảnh Canon', 25000000, 15, 2),
('Giày đá banh', 800000, 200, 3),
('Mì chính Ajinomoto', 10000, 1500, 4),
('Nước ngọt Pepsi', 10000, 1000, 4),
('Tẩy trang Bioderma', 300000, 500, 1),
('Quạt đứng Panasonic', 1500000, 80, 2),
('Lò vi sóng Sharp', 2000000, 70, 2),
('Đầm xòe', 600000, 200, 3),
('Mô hình siêu nhân', 400000, 50, 1),
('Sách kỹ năng', 100000, 300, 1),
('Bình giữ nhiệt', 150000, 500, 4),
('Tai nghe Sony', 1000000, 100, 2),
('Đèn bàn học', 300000, 150, 4),
('Quạt trần', 2000000, 100, 4),
('Tủ lạnh Toshiba', 15000000, 30, 2),
('Nước rửa tay Lifebuoy', 25000, 800, 1),
('Giày thể thao Adidas', 600000, 200, 3),
('Nước ngọt 7Up', 10000, 1000, 4),
('Thịt heo', 150000, 500, 4),
('Sữa bột Enfa', 500000, 300, 4),
('Máy hút bụi', 3000000, 70, 2),
('Nồi áp suất', 2000000, 80, 2),
('Áo len nam', 300000, 200, 3),
('Váy ngắn', 250000, 150, 3),
('Son môi', 300000, 500, 1),
('Bánh trung thu', 50000, 1000, 4),
('Nước rửa chén', 30000, 800, 1),
('Máy cắt cỏ', 2000000, 50, 2);

use pm;

insert into orders (fullname, user_id, phone_number, note, shipping_method, shipping_address, shipping_date, payment_method)
value ('Nguyễn Văn A', 2,'0123456789', 'Giao tầm giờ trưa nhé shop', 'Bưu điện', 'Cổ Điển, Hải Bối, Đông Anh, Hà Nội', '2024/05/29', 'Trả trước');

insert into order_details (order_id, order_type, product_id, price, number_of_products, total_money)
value (1, 'orders', 1, 4000, 30, 4000*30),
(1, 'order', 2, 15000, 30, 15000 * 30);

insert into imported_orders (user_id, note)
value (1, 'Không');

insert into order_details (order_id, order_type, product_id, price, number_of_products, total_money)
value (1, 'imported_order', 3, 3500, 30, 3500*30);