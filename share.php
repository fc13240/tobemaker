<?php

include 'config.php';
include_once ROOT_PATH."class/class_file.php";
include_once ROOT_PATH."class/class_idea.php";
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");

$accessKey = ACCESS_KEY;
$secretKey = SECRET_KEY;
$bucket="yzzwordpress";
$dd=date('Y-m-d H:i:s',time());
$key=md5($dd).rand(0,1000).".jpg";
Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$putPolicy->deadline=1800;
$putPolicy->FsizeLimit=2000000;
$putPolicy->mineLimit="image/jpeg;image/png";
$upToken = $putPolicy->Token(null);

// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);


//保存提交的想法
if(array_key_exists('img_url',$_POST))
{
	//保存图片
	$pic_url=$_POST['img_url'];
	//$file_instance = new class_file();
	//$pic_url=$file_instance->save($tmp_url);
	// 保存其他信息  预留字段user_id 和user_name
	$arr= array();
	$arr['name']=$_POST['title'];
	$arr['content']=$_POST['content'];
	$arr['picture_url']=$pic_url;
	if(array_key_exists('cover-display', $_POST))
	{
		$arr['cover_display']=1;
	}

	//$arr['user_name']=$_POST['user_id'];
	$arr['user_id']=3;

	$new_idea= new class_idea();
	$new_idea_id=$new_idea->insert("idea_info",$arr);
	$url="Location:".BASE_URL."project.php?idea_id=".$new_idea_id;
	header($url);
}


include 'view/share_page.php';
