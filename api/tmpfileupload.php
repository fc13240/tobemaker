<?php

include_once "../config.php";
include_once ROOT_PATH."class/class_file.php";

$file_instance = new class_file();

$url = $file_instance->save_as_tmp();

$data = array();
$data['url'] = $url;

if ($url == ""){
    $data['err_msg'] = $file_instance->get_error_msg();
}

echo json_encode($data);