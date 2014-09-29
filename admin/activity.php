<?php

include_once '../config.php';
include_once '../class/class_activity.php';
include_once '../class/class_file.php';
include_once ROOT_PATH."class/class_group_auth.php";
include_once '../class/class_check.php';
include_once '../class/class_qiniu.php';
//上传suo xu
$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_head();
$class_check=new class_check();
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
// 导航 当前页面控制
$current_page = 'activity-activity';
$page_level = explode('-', $current_page);

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
//跳转页面
function changeTo($url)
{
   //echo '<script>location.href ="'.$url.'";</script>';
}
//获取目录数量及内容
$activity=new class_activity();
//保存表单内容到数据库
var_dump($_POST);
if(array_key_exists('img_url', $_POST)){
//验证表单内容合法性
if(empty($_POST["img_url"]))
{
   alertMsg('图片不能为空！',"error");
}
elseif(strlen(trim($_POST["link"]))<=0)
{
  alertMsg("链接不能为空！","error");
}
else
{
$time = time();
$_head="http:";
if(!strstr($_POST['link'], $_head))
{
    $link="http://".$_POST['link'];
}
 else {
    $link=$_POST['link'];
}

if(!strstr($_POST['activity_url'], $_head))
{
    $ac_link="http://".$_POST['activity_url'];
}
 else {
    $ac_link=$_POST['activity_url'];
}

$arr= array("activity_name"=>$_POST["name"],"pic_url"=>$_POST["img_url"],
            "qiu_piao_url"=>$link,'activity_url'=>$ac_link);
include 'view/activity_page.php';
$activity->add_activity($arr);
alertMsg("添加成功！","success");
}
}
else {
include 'view/activity_page.php';
}
