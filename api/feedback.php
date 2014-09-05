<?php
include_once "../config.php";

include_once ROOT_PATH."class/class_feedback.php";

if( array_key_exists('msg', $_POST) && array_key_exists('userid', $_POST) ){
    $msg = $_POST['msg'];
    $userid = $_POST['userid'];
    
    $feedback = new class_feedback();
    $feedback->insert($msg, $userid);
    
    echo json_encode(array('status'=>'success'));
}else{
    echo json_encode(array('status'=>'missing_param'));
}

