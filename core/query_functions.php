<?php

include('database.php');

// Assign Database Connection Global
function con_global(){
    global $con;
    return $con;
}


// Fetch All Data
function get_all_data($table_name){
    return mysqli_query(con_global(),"SELECT * FROM `$table_name` ORDER BY `id` desc");
}

// Fetch Data by a specific filed
function get_single_data($table_name,$table_field,$table_value){
    return mysqli_query(con_global(),"SELECT * FROM `$table_name` WHERE `$table_field` = '$table_value'");
}


// Delete All Data by a Specific Field
function delete_data($table_name,$table_field,$table_value){
    mysqli_query(con_global(),"DELETE FROM `$table_name` WHERE `$table_field` = '$table_value'");
    return;
}

// Fetch Data by Relation
function relational_data($main_table,$main_table_filed,$relation_table,$relation_value,$limit=null,$single_field=null,$single_value=null){
    if($limit != null){
        $limit = "LIMIT $limit";
    }
    if($single_field != null && $single_value != null){
        $single_target = "WHERE `$single_field` = '$single_value'";
    }else{
        $single_target = null;
    }
    $relational_join_query = "
        SELECT main.*, relation.name 
        FROM `$main_table` AS main
        INNER JOIN `$relation_table` AS relation
        ON main.$main_table_filed = relation.id
        $single_target
        ORDER BY main.id DESC $limit
    ";
    return mysqli_query(con_global(),$relational_join_query);
}

// Count Function
function count_data($table_name,$filed_name=null,$filed_value=null){
    $add_condition = null;
    if($filed_name != null && $filed_value != null){
        $add_condition = "WHERE `$filed_name` = '$filed_value'";
    }
    $buld_query = "SELECT COUNT(*) AS cnt FROM `$table_name` ".$add_condition;
    $count_query = mysqli_query(con_global(),$buld_query);
    $get_data = mysqli_fetch_assoc($count_query);
    if($get_data['cnt'] > 0){
        return $get_data['cnt']; 
    }else{
        return 0;
    }
}


?>