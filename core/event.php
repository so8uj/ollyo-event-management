<?php

if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['auth'])){
    header("Location: ../login.php");
}

include('database.php');
include('data_validation.php');
include('image_upload.php');


// Project File with Requested Data
if(isset($_POST['event_from_action'])){

    // Add and Update Data
    if(isset($_POST['event_from_action'])){

        $event_from_action = $_POST['event_from_action'];

        $validation_rules = [
            'title' => ['required' => true, 'min' => 5, 'string' => true],
            'description' => ['required' => true, 'min' => 30],
            'maximum_capacity' => ['required' => true, 'min' => 2, 'integer'=> true],
            'event_date' => ['required' => true, 'date' => true],
        ];

        
        $errors = data_validation($_POST,$validation_rules);
        if($event_from_action == 'add'){
            if(empty($_FILES['featured_image']['name'])){
                $errors['featured_image'] = 'Fretured Image is required.';
            }
        }
        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors,
            ]);
            exit;
        }else {

            $real_title = mysqli_real_escape_string($con,$_POST['title']);
            $real_description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');;
            $real_maximum_capacity = mysqli_real_escape_string($con,$_POST['maximum_capacity']);
            $created_by = $_POST['created_by'];
            $slug = make_slug($real_title);
            $event_date = mysqli_real_escape_string($con,$_POST['event_date']);

            if($event_from_action != 'add'){
                if($_FILES['featured_image']['name']){
                    if($_POST['old_image_name'] != 'default_image.jpg'){
                        delete_image($_POST['old_image_name']);
                    }
                    $featured_image = image_upload($_FILES['featured_image'],$slug);
                }else{
                    $featured_image = $_POST['old_image_name'];
                }

                $event_id = $_POST['event_id'];
                $query = "UPDATE `events` SET `title`='$real_title',`description`='$real_description',`featured_image`='$featured_image',`maximum_capacity`='$real_maximum_capacity',`created_by`='$created_by',`slug`='$slug',`event_date`='$event_date' WHERE `id` = '$event_id'";
                $msg = "Event Updated";
            }else{

                $featured_image = image_upload($_FILES['featured_image'],$slug);
                $query = "INSERT INTO `events`(`title`, `description`,`featured_image`,`maximum_capacity`, `created_by`, `slug`, `event_date`) VALUES ('$real_title','$real_description','$featured_image','$real_maximum_capacity','$created_by','$slug','$event_date')";
                $msg = "Event Added";
            }
            
            $execute_event_query = mysqli_query($con,$query);

            if($execute_event_query){
                echo json_encode([
                    'status' => 'redirect',
                    'url' => 'index.php?action=success&msg='.$msg
                ]);
                exit;
            }else{
                echo json_encode([
                    'status' => 'database_error',
                    'msg' => 'Something Went Wrong!',
                ]);
                exit;
            }

        }

    }

}else{
    header('Location: ../index.php');
}


function make_slug($str) { 
    $str = preg_replace('/[^A-Za-z0-9-]+/', '-', $str);
    $str = trim($str, '-');
    $str = strtolower($str);
	return $str; 
}

