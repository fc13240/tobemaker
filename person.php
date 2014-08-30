<?php

include_once "config.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_attention.php";
//上传suo xu
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");
require_once("qiniu/http.php");

$accessKey = ACCESS_KEY;
$secretKey = SECRET_KEY;
$bucket=BUCKET;

Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$putPolicy->deadline=1800;
$putPolicy->FsizeLimit=2000000;
$putPolicy->mineLimit="image/jpeg;image/png";
$upToken = $putPolicy->Token(null);

// 导航 当前页面控制
$current_page = 'person';
$page_level = explode('-', $current_page);
$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();
//  准备数据

if(array_key_exists('user_id', $_GET)){
	$user_info=$class_user->select($_GET['user_id']);
	if(count($user_info)==0)
	{
		echo "no user";
		header("Location:".BASE_URL);
	}else{
		$user_info=$user_info[0];
	}
}else{
    $user_id = $_SESSION['user_id'];
    $user_info = $class_user->select($user_id);
    $user_info=$user_info[0];
}

include 'view/person_page.php';
