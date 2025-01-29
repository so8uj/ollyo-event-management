<?php

function make_response($status,$data){
    $response = [
        'status' => $status,
        'data' => $data,
    ];
    return json_encode($response,JSON_UNESCAPED_UNICODE);
}

include('../core/query_functions.php');

if(isset($_GET['request_for']) && isset($_GET['table_name'])){
    $table_name = $_GET['table_name'];
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    $paginate = isset($_GET['paginate']) ? $_GET['paginate'] : null;
    $page = isset($_GET['page']) ? $_GET['page'] : null;


    $data = [];

    if(isset($_GET['search_field'])){
        $search_field = $_GET['search_field'];
        $search_value= $_GET['search_value'];
        $data['search'] = true;
        $data['search_with'] = $search_value;
    }else{
        $search_field = null;
        $search_value=null;
        $data['search'] = false;
    }

    // Get All Data
    if($_GET['request_for'] == 'all_data'){

        $get_events = relational_data('events','created_by','users','name',$limit,null,null,$paginate,$page,$search_field,$search_value);      
        $total_number_of_rows = intval(count_data($table_name));

        if($paginate != null){
            $page_data = $page * $limit;
            if($total_number_of_rows <= $page_data){
                $data['paginate_button'] = false;
            }else{
                $data['paginate_button'] = true;
            }
        }

        if(mysqli_num_rows($get_events)>0){
            while($get_event = mysqli_fetch_assoc($get_events)){
                $get_event['description'] = utf8_encode($get_event['description']);
                $data['events'][] = $get_event;
            }
        }

        echo make_response('success',$data);
        exit;
    }
}else{
    // Give Emplty Success Response
    echo make_response('success','API working!');
    exit;
}






?>