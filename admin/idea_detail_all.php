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
function alertMsg($msg,$status)
{
    if($status=='error')
    {
       echo '<script>alert("'.$msg.'");history.go(-1);</script>';
    }
	else
	{
	   echo '<script>alert("'.$msg.'");</script>';
	}
}
if(isset($_POST["idea_id"]))
{
   //表单验证
  if(strlen(trim($_POST["name"]))<=1||strlen(trim($_POST["name"]))>15)
  {
      alertMsg("标题长度有误，应介于2-15之间！","error");
  }
  elseif(count($tags)>=6)
  {
      alertMsg("标签数量过多！","error");
      
  }
  elseif(strlen(trim($_POST["content"]))<=0)
  {
      alertMsg("内容不能为空！","error");
  }
  
  elseif($_POST["target"]<=0)
  {
       alertMsg("目标数不能小于等于0！","error");
  }
  else{
	$id=$_POST["idea_id"];
	$arr=$_POST;
	$idea->update_idea($id,$arr);
	//注册修改时间
	$change_info=array();
    
	$url="Location:".BASE_URL."admin/idea_detail_all.php?idea_id=".$id;
	header($url);
	exit();
	}
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
