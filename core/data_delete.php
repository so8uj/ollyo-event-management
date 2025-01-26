<?php

if(!isset($_GET['delete'])){
    header("Location: ../index.php");
    exit;
}

include('image_upload.php');
include('query_functions.php');

$target_table = $_GET['target_table'];
$target_id = $_GET['target_id'];
$delete_img = $_GET['delete_img'];

if($delete_img != 'false' && $delete_img != 'default_image.jpg'){
    delete_image($delete_img);
}

$table_field = "id";
delete_data($target_table,$table_field,$target_id);

echo $target_id;

?>