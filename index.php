<?php
    // include("config/database.php");
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "123";
    $db_name = "pm";
    $db_port = "3307";
    global $conn;
    // Bật chế độ báo cáo lỗi cho MySQLi
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name, $db_port);
        echo "<script>console.log('Successfully');</script>";
    } catch (mysqli_sql_exception $e) {
        echo "<script>console.log('Couldn't connect');</script>";
        echo "<script>console.log(`Error: {$e->getMessage()}`);</script>";
    }
    session_start();
    include("routes/index.php");   
?>