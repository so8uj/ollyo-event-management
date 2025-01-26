<?php

if(!isset($_SESSION)){
    session_start();
}

// Project File with Requested Data
if(isset($_POST['catchRegisterData']) || isset($_POST['catchLoginData'])){
    
    include('database.php');
    include('data_validation.php');

    // Register Functions
    if (isset($_POST['catchRegisterData'])) {

        $validation_rules = [
            'name' => ['required' => true, 'min' => 3, 'max' => 20, 'string' => true],
            'username' => [
                'required' => true, 'min' => 3, 'max' => 20, 'string' => true,
                'unique' => ['table' => 'users']
            ],
            'password' => ['required' => true, 'min' => 6],
            'confirm_password' => ['required' => true,'min' => 6,'confirm' => 'password'],
        ];

        $errors = data_validation($_POST,$validation_rules);

        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors,
            ]);
            exit;
        } else {

            $real_name = mysqli_real_escape_string($con,$_POST['name']);
            $real_username = mysqli_real_escape_string($con,$_POST['username']);
            $real_password = mysqli_real_escape_string($con,$_POST['password']);
            $has_password = password_hash($real_password, PASSWORD_DEFAULT);
            $query = "INSERT INTO `users` (`name`,`username`,`password`) VALUES ('$real_name','$real_username','$has_password')";

            $insert_data = mysqli_query($con,$query);

            if($insert_data){
                echo json_encode([
                    'status' => 'success',
                    'msg' =>"Registration Done! <a href='login.php' class='color-a hover-color-black'>Login Now</a>",
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

    // Login Functions
    if(isset($_POST['catchLoginData'])){

        $validation_rules = [
            'username' => ['required' => true, 'min' => 3, 'max' => 20, 'string' => true],
            'password' => ['required' => true, 'min' => 6]
        ];
        $errors = data_validation($_POST,$validation_rules);
        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors,
            ]);
            exit;
        } else {

            $real_username = mysqli_real_escape_string($con,$_POST['username']);
            $real_password = mysqli_real_escape_string($con,$_POST['password']);

            $check_with_username = mysqli_query($con,"SELECT * FROM `users` WHERE `username` = '$real_username'");

            if(mysqli_num_rows($check_with_username) > 0){
                $get_user_data = mysqli_fetch_assoc($check_with_username);
                if(password_verify($real_password,$get_user_data['password'])){
                    $_SESSION['auth'] = $get_user_data;
                    echo json_encode([
                        'status' => 'redirect',
                        'url' => 'dashboard'
                    ]);
                    exit;
                }else{
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'password'=>'Invalid Password!'
                        ]
                    ]);
                    exit;
                }
            }else{
                echo json_encode([
                    'status' => 'error',
                    'errors' => [
                        'username'=>'Invalid Username!'
                    ]
                ]);
                exit;
            }
        }

    }




}else{
    header('Location: ../login.php');
}




