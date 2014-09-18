<?php

include_once "config.php";
include_once ROOT_PATH."class/class_product.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$user=new class_user();

$result = $user->select(@$_GET['to_user']);
$to_user_info = $result[0];
//var_dump($to_user_info);
// 导航 当前页面控制
$current_page = 'shop';
$page_level = explode('-', $current_page);

include 'view/msg_send_2.php';
