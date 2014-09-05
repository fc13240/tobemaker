<?php

include_once 'config.php';
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_group_auth.php";
$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}
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
	if(strlen(trim($_POST['title']))>15||strlen(trim($_POST['title']))<=1)
	{
	   //返回错误信息
	   echo '<script>alert("标题长度不正确，应介于2-15之间！");history.go(-1);</script>';
	   return;
	}
	$arr['content']=$_POST['content'];
	if(strlen(trim($_POST['content']))<=0)
	{
	   //返回错误信息
	    echo '<script>alert("内容不能为空！");history.go(-1);</script>';
	   return;
	}
	$arr['create_time']='now()';
	$arr['picture_url']=$pic_url;
	$arr['tags']=$_POST['tags'];
	if(count(explode(',',$_POST['tags']))>5)
	{
	   //返回错误信息
	   echo '<script>alert("标签过多！不能超过5个！");history.go(-1);</script>';
	   return;
	}
	if(array_key_exists('cover-display', $_POST))
	{
		$arr['cover_display']=1;
	}
	else
    {
      $arr['cover_display']=0;
    }
	//echo "";
	$arr['user_name']=$current_user['user_name'];
	$arr['idea_status']='2';
	// 插入数据库
	$new_idea= new class_idea();
	$new_idea_id=$new_idea->insert("idea_info",$arr);
	$url="Location:".BASE_URL."project.php?idea_id=".$new_idea_id;
	header($url);

}

include 'view/share_page.php';