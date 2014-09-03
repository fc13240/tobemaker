<?php

include_once 'config.php';
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_group_auth.php";
$class_session=new class_session();
$class_user=new class_user();
$class_group_auth=new class_group_auth();
$current_user = $class_user->get_current_user();

$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_idea();
// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);
//保存提交的想法
if(array_key_exists('act',$_POST)&&$_POST['act']=='create_share')
{
  if(!$class_group_auth->check_auth("submitproject"))
  {
    //echo '<script>alert("对不起，您没有权限！");history.go(-1);</script>';
	die('对不起，您没有权限！');
	//return;
  }
    $arr= array();
	$arr['user_id']=$current_user['user_id'];
	//七牛保存图片
	if(isset($_POST['img_url']))
	{
	$pic_url=$_POST['img_url'];
	//$url_array = explode("/", $pic_url);
    //$key = end($url_array);
    //$key1 ="upload/".$current_user['user_id']."/".$key;
    //$qiniu->copy($key,$key1);
    //$pic_url=QINIU_DOWN.$key1;
    }
    else $pic_url="";

   //写数据库保存想法
	$arr['name']=$_POST['title'];
	$arr['content']=$_POST['content'];
	$arr['create_time']='now()';
	$arr['picture_url']=$pic_url;
	$arr['tags']=$_POST['tags'];
	if(array_key_exists('cover_display', $_POST))// 是否显示封面  数据库默认显示
	{
		$arr['cover_display']=1;
	}
	else
    {
      $arr['cover_display']=0;
    }
	//echo "";
	$arr['user_name']=$current_user['user_name'];


	// 插入数据库
	$new_idea= new class_idea();
	$new_idea_id=$new_idea->insert("idea_info",$arr);
	$url="Location:".BASE_URL."project.php?idea_id=".$new_idea_id;
	header($url);
	exit();
}
include 'view/share_page.php';
