<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['auth'])){
        header("Location: ../login.php");
    }

    $get_path = $_SERVER['REQUEST_URI'];
    $path = explode('/',$get_path);
    $path = $path[2];

    $auth = $_SESSION['auth'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/favicon.webp" type="image/x-icon">
    <title>OEM - User Panel</title>


    <!-- Extanal CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">


</head>
<body>
    <!-- Preloader -->
    <div class="preeloader content-center d-none align-items-center justify-content-center">
        <div class="text-center">
            <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <h3>Please Wait...</h3>
        </div>
    </div>
    <main>
       <div class="dashboard-header p-3 bg-a">
           <div class="container-fluid">
                <div class="d-flex column-gap-5 align-items-center">
                    <div class="logo">
                        <a class="navbar-brand" href="/ollyo-event-management">
                            <img src="../assets/img/ollyo-event-management.webp" width="200px" alt="Ollyo Event Management">
                        </a>
                    </div>
                    <div>
                        <a href="../index.php" target="_blank" class="btn btn-light">Website</a>
                    </div>
                </div>
           </div>
       </div>
        <div class="container-fluid" style="min-height: 100vh;">
            <div class="row">
                <?php require_once('sidebar.php'); ?>

                <div class="col-lg-10">
                    <div class="main-content pt-4 ps-3">
                        