<?php

include('query_functions.php');

// $all_events = get_all_data('events');
$all_event_homepage = relational_data('events','created_by','users','name',3);
$all_events = relational_data('events','created_by','users','name');

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
    if (strlen($title) > 40){
        return $new_title = substr($title, 0, 39) . '...';
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
