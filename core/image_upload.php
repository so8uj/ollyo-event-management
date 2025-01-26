<?php

function image_upload($file,$name,$delete=null,$old_image=null){
    if($delete!=null){
        if(file_exists('../uploads/'.$old_image)){
            unlink('../uploads/'.$old_image);
        }
    }
    $img_ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $new_name = $name.'-'.time().'.'.$img_ext;
    move_uploaded_file($file['tmp_name'],'../uploads/'.$new_name);
    return $new_name;
}


function delete_image($image){
    if(file_exists('../uploads/'.$image)){
        unlink('../uploads/'.$image);
    }
}