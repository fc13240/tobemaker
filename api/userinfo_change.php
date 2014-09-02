<?php

/*
前台用户信息修改接口

1，传入   user_id  user_name  head_url  user_occupation  user_introduction

2，传出   status:success/error
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$class_idea=new class_idea();
$current_user = $class_user->get_current_user();
$user_id=$current_user['user_id'];
$arr['user_name']=$_POST['user_name'];


//七牛处理图片
$qiniu= new class_qiniu();
$pic_url=$_POST['head_url'];
$url_array = explode("/", $pic_url);
$key = end($url_array);
$key1 ="upload/".$user_id."/head/".$key;

$qiniu->move($key,$key1);
$pic_url=QINIU_DOWN.$key1;

//
$arr['head_pic_url']=$pic_url;
$arr['occupation']=$_POST['user_occupation'];
$arr['self_intro']=$_POST['user_introduction'];
$res=$class_user->update($user_id,$arr);
if(strlen(trim($arr['user_name']))<=0||strlen(trim($arr['user_name']))>40)
{
   # code...
	$records['status']='error';
	echo json_encode($records);
}
else
{

$sql="UPDATE `idea_info` set user_name='".$arr['user_name']."' where user_id=".$user_id;

$class_idea->db->query($sql);
if($res==1)
{
	$records['status']='success';
	//$url="Location:".BASE_URL."person.php?user_id=".$user_id;
	//header($url);
	echo json_encode($records);
}
else {
	# code...
	$records['status']='error';
	echo json_encode($records);
}
}
?>