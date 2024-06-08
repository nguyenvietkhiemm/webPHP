<?php
try {
    $table = 'users';
    $select_sql = "select * from $table";

    $users_data = mysqli_query($conn, $select_sql);

    echo "Connected to Users<br>";

    foreach ($users_data as $user_data) {
        echo implode(" ", $user_data) . "<br>";
    }

    echo "<br>";
    // Hoặc:

    if (mysqli_num_rows($users_data) > 0) {
        echo "Connected to Users<br>" . mysqli_num_rows($users_data) . "<br>";
        while ($row = mysqli_fetch_assoc($users_data)) {
            echo $row["user_ID"] . "<br>";
            echo $row["user_username"] . "<br>";
            echo $row["user_password"] . "<br>";
        }
    }
} catch (mysqli_sql_exception) {
    echo "Could not show data";
}

mysqli_close($conn);
