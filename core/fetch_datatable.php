<?php

if(!isset($_GET['table_name'])){
    exit;
}
if(!isset($_SESSION)){
    session_start();
}

include('query_functions.php');

$table_name = $_GET['table_name'];


if(isset($_GET['type']) && isset($_GET['type']) == 'events'){
    $auth = $_SESSION['auth'];
    if($auth['role'] != 1){
        $get_all_data = get_single_data($table_name,'created_by',$auth['id']);
    }else{
        $get_all_data = get_all_data($table_name);
    }

}else{
    $get_all_data = get_all_data($table_name);
}

while($row = mysqli_fetch_assoc($get_all_data)){

    $attendies = count_data('event_registrations','event_id',$row['id']);
    $row['attendees'] = $attendies;
    $data[] = $row;

}

$count = count($data);

$response = array(
    "draw" => 1,
    "iTotalRecords" => $count,
    "iTotalDisplayRecords" => $count,
    "aaData" => $data
);

echo json_encode($response);
