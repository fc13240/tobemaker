<?php

include_once "config.php";
include_once ROOT_PATH."class/class_user.php";

// 导航 当前页面控制
$current_page = 'person';
$page_level = explode('-', $current_page);
$class_user=new class_user();
//  准备数据

if(array_key_exists('user_id', $_GET)){
	$user_info=$class_user->select($_GET['user_id']);
	if(count($user_info)==0)
	{
		echo "no user";
		header("Location:".BASE_URL);
	}
	else{
		$user_info=$user_info[0];
	}
}
else{
	$url="Location:".BASE_URL;
	header($url);

}

include 'view/person_page.php';
