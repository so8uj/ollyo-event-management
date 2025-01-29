<?php

    $server = "localhost";
    $username = "your database username";
    $pass = "your database password";
    $db_name = "your database dabatase name";

    $con = mysqli_connect($server,$username,$pass,$db_name);

    if (!$con) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }




