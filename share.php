<?php

include 'config.php';
include_once ROOT_PATH."class/class_file.php";
include_once ROOT_PATH."class/class_idea.php";


include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();

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
    $key1 ="upload/".$arr['user_id']."/".$key;

    $client = new Qiniu_MacHttpClient(null);
    echo $key1;
    $err = Qiniu_RS_Copy($client, $bucket, $key, $bucket, $key1);
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
