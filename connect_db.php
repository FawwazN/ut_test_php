<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ut_test';
    $port = 3306;

    $con = mysqli_connect($server, $username, $password, $database, $port);
    if (mysqli_connect_errno()) {
        echo "Connection error". mysqli_connect_error();
    }
?>