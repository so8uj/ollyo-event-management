<?php

include('query_functions.php');

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$view_limit = 6;
$search = isset($_GET['search']) ? $_GET['search'] : null;
if($search != null){
    $view_limit = 100;
    $all_events = relational_data('events','created_by','users','name',$view_limit,null,null,false,$current_page,'title',$search);
}else{
    $all_events = relational_data('events','created_by','users','name',$view_limit,null,null,1,$current_page);
}

$count_events = count_data('events');

if($page === 'view_event.php'){
    if(isset($_GET['name'])){
        $slug = $_GET['name'];
    }else{
        header("Location: index.php");
    }
    $get_single_event = relational_data('events','created_by','users','name',null,'slug',$slug);
    
}

// Minimise Title
function minimise_title($title){
    if (strlen($title) > 36){
        return $new_title = substr($title, 0, 35) . '...';
    }else{
        return $title;
    }
}

// Make Group data from Array
function make_group($all_datas, $field) {
    $group_array = [];
    foreach ($all_datas as $data) {
        $group_array[$data[$field]][] = $data[$field];
    }
    return $group_array;
}
