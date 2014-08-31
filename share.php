<?php

include_once 'config.php';
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();

$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_idea();

// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);


//保存提交的想法
if(array_key_exists('img_url',$_POST))
{
	$arr= array();
	$arr['user_id']=3;
	//保存图片
	$pic_url=$_POST['img_url'];
	$url_array = explode("/", $pic_url);
    $key = end($url_array);
    $key1 ="upload/".$current_user['user_id']."/".$key;
    $qiniu->move($key,$key1);
    $pic_url=QINIU_DOWN.$key1;
	//$file_instance = new class_file();
	//$pic_url=$file_instance->save($tmp_url);
	// 保存其他信息  预留字段user_id 和user_name

	$arr['name']=$_POST['title'];
	$arr['content']=$_POST['content'];
	$arr['picture_url']=$pic_url;
	if(array_key_exists('cover-display', $_POST))
	{
		$arr['cover_display']=1;
	}
	$arr['user_name']=$_POST['user_id'];
	$new_idea= new class_idea();
	$new_idea_id=$new_idea->insert("idea_info",$arr);
	$url="Location:".BASE_URL."project.php?idea_id=".$new_idea_id;
	header($url);
}


include 'view/share_page.php';
