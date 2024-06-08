<?php
class HomeController
{
    public $conn;

    public function __construct()
    {
        try {
            global $conn;
            $this->conn = $conn;
        } catch (mysqli_sql_exception) {
            echo "Could not show data";
        }
    }
    public function index()
    {
        

        include __DIR__ . ('\..\..\resources\views\home.php');
    }
}

return new HomeController;
