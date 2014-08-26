<?php

/*
前台用户信息修改接口

1，传入   user_id  user_name  head_url  user_occupation  user_introduction

2，传出   status:success/error
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_idea.php";

$class_user=new class_user();
$class_idea=new class_idea();
$user_id=$_POST['user_id'];
$arr['user_name']=$_POST['user_name'];
$arr['head_pic_url']=$_POST['head_url'];
$arr['occupation']=$_POST['user_occupation'];
$arr['self_intro']=$_POST['user_introduction'];
$res=$class_user->update($user_id,$arr);

$sql="UPDATE `idea_info` set user_name='".$arr['user_name']."' where user_id=".$user_id;

$class_idea->db->query($sql);
if($res==1)
{
	$records['status']='success';
}
else {
	# code...
	$records['status']='error';
}
echo json_encode($records);
?>