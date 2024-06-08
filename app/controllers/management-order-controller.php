<?php
class ManagementOrderController
{
    public $table;
    public $conn;

    public function __construct()
    {
        try {
            global $conn;
            $this->conn = $conn;
            $this->table = 'orders';
        } catch (mysqli_sql_exception) {
            echo "Could not show data";
        }
    }
    public function index()
    {
        $select_sql = "select * from $this->table";
        $orders_data = mysqli_query($this->conn, $select_sql);

        $select_sql_2 = "SELECT order_details.*, products.name FROM order_details 
                JOIN products ON order_details.product_id = products.id
                WHERE order_details.order_type = 'order'";

        $orders_detail_data = mysqli_query($this->conn, $select_sql_2);

        $select_sql_3 = "select * from products where deleted = false";
        $products_data = mysqli_query($this->conn, $select_sql_3);

        include __DIR__ . ('\..\..\resources\views\management-order.php');
    }

    public function create($data)
    {
        $shipping_address = $data['address'];
        $fullname = $data['fullname'];
        $phone_number = $data['phone_number'];
        $payment_method = $data['payment_method'];
        $note = $data['note'];
        $order_id = $data['order_id'];
        $shipping_date = $data['shipping_date'];
        $shipping_method = $data['shipping_method'];
        $status = $data['status'];
        $user_id = $data['user_id'];
        $products = $data['products'];

        // Sử dụng prepared statements cho câu lệnh INSERT vào bảng orders
        $stmt = $this->conn->prepare("INSERT INTO orders(id, user_id, fullname, phone_number, note, shipping_date, status, shipping_method, shipping_address, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iissssssss', $order_id, $user_id, $fullname, $phone_number, $note, $shipping_date, $status, $shipping_method, $shipping_address, $payment_method);

        if ($stmt->execute()) {
            echo 'Insert order successfully';

            // Sử dụng prepared statements cho câu lệnh INSERT vào bảng order_details
            $stmt2 = $this->conn->prepare("INSERT INTO order_details(order_id, order_type, product_id, price, number_of_products, total_money) VALUES (?, 'order', ?, ?, ?, ?)");

            foreach ($products as $product) {
                $product_id = $product['product_id'];
                $price = $product['product_price'];
                $quantity = $product['product_quantity'];
                $total_money = $quantity * $price;

                $stmt2->bind_param('iiiii', $order_id, $product_id, $price, $quantity, $total_money);

                if ($stmt2->execute()) {
                    echo 'Insert order detail successfully';
                } else {
                    echo "Error inserting order detail: " . $stmt2->error;
                }
            }

            $stmt2->close();
        } else {
            echo "Error inserting order: " . $stmt->error;
        }

        $stmt->close();
    }
}

return new ManagementOrderController;
