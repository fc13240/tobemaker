<?php

include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();

$sort_rule = 'new';

if (array_key_exists('sort', $_GET)){
    $sort_rule = $_GET['sort'];
}

// 导航 当前页面控制
$current_page = 'project_list';
$page_level = explode('-', $current_page);

include 'view/project_list_page.php';