<?php

include_once '../config.php';
include_once ROOT_PATH.'class/class_idea.php';
include_once ROOT_PATH."class/class_group_auth.php";
$class_group_auth=new class_group_auth();
//判断权限
if(!$class_group_auth->check_auth("admin"))
  {
  $url="Location:".BASE_URL."error.php";
  header($url);
    //echo '<script>alert("对不起，您没有权限！");history.go(-1);</script>';
	//die('对不起，您没有权限！请登录或联系管理员！');
	//return;
  }
//include_once ROOT_PATH.'';
header("Content-Type: text/html; charset=utf-8");
// 获取数据开始
$idea=new class_idea();
//如果是修改请求
if(isset($_POST["idea_id"]))
{
	$id=$_POST["idea_id"];
	$arr=$_POST;
	$idea->update_idea($id,$arr);
	//注册修改时间
	$change_info=array();
    $change_info['user_id']=1;
    $change_info['idea_id']=$_POST['idea_id'];
    $change_info['idea_status']=$_POST['idea_status'];
    $change_info['last_change_time']='now()';
    $idea->insert("idea_manage",$change_info);
    // 返回
	$url="Location:".BASE_URL."admin/idea_detail_all.php?idea_id=".$id;
	header($url);
	exit();
}


//如果是请求数据
elseif(isset($_GET["idea_id"]))
{
	$idea_id=$_GET["idea_id"];
	$idea_list=$idea->get_idea_by_id($idea_id);
	//var_dump($idea_list);
}

else{
	echo "error";
	exit();
}
//
// 导航 当前页面控制
$current_page = 'idea-idea_detail_all';
$page_level = explode('-', $current_page);

include 'view/idea_detail_all.php';
