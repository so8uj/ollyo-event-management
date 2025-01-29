<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $get_pagename = $_SERVER['PHP_SELF'];
    $page = explode('/',$get_pagename);
    $page = end($page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/favicon.webp" type="image/x-icon">
    <title>OEM - Ollyo Event Management</title>


    <!-- Extanal CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css?<?= time() ?>">


</head>
<body>

    <!-- Preloader -->
    <div class="preeloader content-center d-none align-items-center justify-content-center">
        <div class="text-center">
            <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <h3>Please Wait...</h3>
        </div>
    </div>


    <!-- Header Part -->
    <header class="bg-body-tertiary ">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom-nav justify-content-between">

                <a class="navbar-brand" href="/ollyo-event-management">
                    <img src="./assets/img/ollyo-event-management.webp" alt="Ollyo Event Management">
                </a>


                <div class="menu-buttons d-flex justify-content-end column-gap-2">
                    <?php if(isset($_SESSION['auth'])){ ?> 
                        <a href="dashboard/" class="btn btn-a" target="_blank">Dasboard</a>
                    <?php }else{ ?> 
                        <a href="login.php" class="btn btn-a" >Login</a>
                        <a href="register.php" class="btn btn-a-outline" >Register</a>
                    <?php } ?>
                </div>

            </nav>
        </div>
    </header>
