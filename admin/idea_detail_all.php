<?php

include_once '../config.php';
include_once ROOT_PATH.'class/class_idea.php';
include_once ROOT_PATH."class/class_group_auth.php";
include_once ROOT_PATH.'class/class_like.php';
include_once '../class/class_qiniu.php';
//上传suo xu
$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_head();
$class_like=new class_like();
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
//获取想买数目
//如果是修改请求
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
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
   $tags=explode(',',$_POST["tags"]);
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
	$arr=array("name"=>$_POST["name"],"tags"=>$_POST["tags"],"picture_url"=>$_POST["img_url"],"content"=>$_POST["content"],"is_recommend"=>$_POST["is_recommend"],"begin_time"=>$_POST["begin_time"],"end_time"=>$_POST["end_time"],"target"=>$_POST["target"]);
	$idea->update_idea($id,$arr);
	//注册修改时间
	$change_info=array();
    alertMsg("修改成功！","success");
	$url=BASE_URL."admin/idea_detail_all.php?idea_id=".$id;
	changeTo($url);
	exit();
	}
}


//如果是请求数据
elseif(isset($_GET["idea_id"]))
{
	$idea_id=$_GET["idea_id"];
	$idea_list=$idea->get_idea_by_id($idea_id);
	//var_dump($idea_list);
	//获取喜欢数目
	$likenum=$class_like->get_like_num($idea_id);
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
