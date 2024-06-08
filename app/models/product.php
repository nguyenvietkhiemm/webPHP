<?php
try {
    $table = 'products';
    $select_sql = "select * from $table";

    $users_data = mysqli_query($conn, $select_sql);

    echo "Connected to Users<br>";

} catch (mysqli_sql_exception) {
    echo "Could not show data";
}

mysqli_close($conn);
