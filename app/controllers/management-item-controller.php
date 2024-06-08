<?php
class ManagementItemController
{
    public $table;
    public $conn;
    
    public function __construct()
    {
        try {
            global $conn;
            $this->conn = $conn;
            $this->table = 'products';
        } catch (mysqli_sql_exception) {
            echo "Could not show data";
        }
    }
    public function index()
    {
        $select_sql = "select * from $this->table where deleted = false";
        $products_data = mysqli_query($this->conn, $select_sql);

        $select_sql_deleted = "select * from $this->table where deleted = true";
        $deleted_products_data = mysqli_query($this->conn, $select_sql_deleted);
        include __DIR__ . ('\..\..\resources\views\management-item.php');
    }

    public function patch($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        $count = $data['count'];
        $category = $data['category'];

        $sql = "UPDATE $this->table SET name='$name', price='$price', count='$count', category_id='$category', updated_at=NOW() WHERE id='$id'";

        if (mysqli_query($this->conn, $sql)) 
        {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($this->conn);
        }
    }

    public function create($data)
    {
        $name = $data['name'];
        $price = $data['price'];
        $count = $data['count'];
        $category = $data['category'];
    
        $sql = "INSERT INTO $this->table (name, price, count, category_id) VALUES (?, ?, ?, ?);";
    
        if ($stmt = mysqli_prepare($this->conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $count, $category);
    
            if (mysqli_stmt_execute($stmt)) {
                echo "Record added successfully";
            } else {
                echo "Error adding record: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } 
        else {
            echo "Error preparing statement: " . mysqli_error($this->conn);
        }
    }
    

    public function soft_delete($data){
        $id = $data['id'];

        $sql = "UPDATE $this->table SET deleted=true WHERE id='$id'";

        if (mysqli_query($this->conn, $sql)) 
        {
            echo "Delete successfully";
        } else {
            echo "Error deleted record: " . mysqli_error($this->conn);
        }
    }

    public function restore($data){
        $id = $data['id'];

        $sql = "UPDATE $this->table SET deleted=false WHERE id='$id'";

        if (mysqli_query($this->conn, $sql)) 
        {
            echo "Restore successfully";
        } else {
            echo "Error restored record: " . mysqli_error($this->conn);
        }
    }

    public function delete($data){
        $id = $data['id'];

        $sql = "DELETE FROM $this->table WHERE id='$id'";

        if (mysqli_query($this->conn, $sql)) 
        {
            echo "Delete successfully";
        } else {
            echo "Error deleted record: " . mysqli_error($this->conn);
        }
    }
}

return new ManagementItemController;
