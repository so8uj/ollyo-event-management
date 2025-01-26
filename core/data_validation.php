<?php
include('database.php');

// Assign Database Connection Global
function con_global(){
    global $con;
    return $con;
}

function data_validation($data, $rules) {
    $errors = []; 

    foreach ($rules as $field => $fieldRules) {

        $value = isset($data[$field]) ? $data[$field] : null;

        foreach ($fieldRules as $rule => $ruleValue) {
            switch ($rule) {
                case 'required':
                    if ($ruleValue && empty($value)) {
                        $errors[$field][] = change_lebel_readable($field)." is required.";
                    }
                    break;

                case 'min':
                    if (!empty($value) && strlen($value) < $ruleValue) {
                        $errors[$field][] = change_lebel_readable($field)." must be at least $ruleValue characters.";
                    }
                    break;

                case 'max':
                    if (!empty($value) && strlen($value) > $ruleValue) {
                        $errors[$field][] = change_lebel_readable($field)." must not exceed $ruleValue characters.";
                    }
                    break;

                case 'string':
                    if (!empty($value) && !is_string($value)) {
                        $errors[$field][] = change_lebel_readable($field)." must be a string.";
                    }
                    break;

                case 'integer':
                    if (!empty($value) && !filter_var($value, FILTER_VALIDATE_INT)) {
                        $errors[$field][] = change_lebel_readable($field)." must be an integer.";
                    }
                    break;
                case 'date':
                    if (!empty($value) && !DateTime::createFromFormat('Y-m-d', $value)) {
                        $errors[$field][] = change_lebel_readable($field) . " must be a valid date in the format YYYY-MM-DD.";
                    }
                    break;
                case 'confirm':
                    if (isset($data[$ruleValue]) && $value !== $data[$ruleValue]) {
                        $errors[$field][] = change_lebel_readable($field)." must match with ".change_lebel_readable($ruleValue).".";
                    }
                    break;

                case 'unique':
                    if (!empty($value) && is_array($ruleValue)) {
                        $check =  check_unique_field($ruleValue['table'],$field,$value);
                        if($check === true){
                            $errors[$field][] = change_lebel_readable($field)." must be unique.";
                        }
                    }
                    break;
                
                default:
                    $errors[$field][] = "Unknown validation rule: $rule.";
                    break;
            }
        }
    }

    return $errors;
}


function change_lebel_readable($label){
    $new_lebel = str_replace('_' ," ",$label);
    return ucwords(strtolower($new_lebel));

}


function check_unique_field($table_name,$field,$value){
    $check_unique_query = "SELECT * FROM `$table_name` WHERE `$field` = '$value'";
    $get_qunique_data = mysqli_query(con_global(), $check_unique_query);
    if(mysqli_num_rows($get_qunique_data) > 0){
        return true;
    }
}