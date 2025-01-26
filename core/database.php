<?php

    $server = "localhost";
    $username = "root";
    $pass = "";
    $db_name = "oem_task";

    $con = mysqli_connect($server,$username,$pass,$db_name);

    if (!$con) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // return $con;



