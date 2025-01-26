<?php

if(!isset($_SESSION)){
    session_start();
}

include('database.php');
include('data_validation.php');

// Project File with Requested Data
if(isset($_POST['postRegistrationData'])){

    $validation_rules = [
        'name' => ['required' => true, 'min' => 3, 'max' => 50, 'string' => true],
        'email' => ['required' => true, 'string' => true]
    ];

    $check_query = check_uniq_data('event_registrations',['email','event_id'],$_POST);

    $errors = data_validation($_POST,$validation_rules);
    if($check_query == true){
        $errors['email'] = "Email is Already Registered for this Event";
    }

    if (!empty($errors)) {
        echo json_encode([
            'status' => 'error',
            'errors' => $errors,
        ]);
        exit;
    } else {

        $real_name= mysqli_real_escape_string($con,$_POST['name']);
        $real_email = mysqli_real_escape_string($con,$_POST['email']);
        $event_id = mysqli_real_escape_string($con,$_POST['event_id']);

        $registration_query = mysqli_query($con,"INSERT INTO `event_registrations`(`event_id`, `name`, `email`) VALUES ('$event_id','$real_name','$real_email')");

        if($registration_query){
            echo json_encode([
                'status' => 'registration_done',
                'msg' =>"Congratulations! Registration Done.",
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

}else{
    header('Location: ../index.php');
}


// Check Uniq Data
function check_uniq_data($table_name,$filed_names,$filed_valus){
    $index = 0;
    $query_check = null;
    foreach ($filed_names as $filed_name){
        if($index != 0){
            $query_add = "AND `$filed_name` = '$filed_valus[$filed_name]'";
        }else{
            $query_add = "`$filed_name` = '$filed_valus[$filed_name]'";
        }
        $query_check = $query_check.' '.$query_add;
        $index++;
    }
    $build_query = "SELECT * FROM `$table_name` WHERE ".$query_check;
    $check_data = mysqli_query(con_global(),$build_query);
    if(mysqli_num_rows($check_data) > 0){
        return true;
    }else{
        return false;
    }
}