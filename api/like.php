<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";
global $class_like;
global $class_idea;

function addlike($user_id,$idea_id){
	// 检测是否点赞

	$class_like=new class_like();
	$class_idea=new class_idea();

	$res=$class_like->get_like_info($idea_id,$user_id);
	if($res==1)
	{
	    $class_like->delet_like($idea_id,$user_id);
		return return_result(1);
	}
	else {
		# code...
		//点赞操作
		$aa=$class_like->add_like($idea_id,$user_id);
		if($aa==1){
			return return_result(2);
		}
		else{
			return return_result(3);
		}
	}
    //返回数据
}


function return_result($status){
	$arr=array();
	if($status==1){
		$arr['status']='like_delete';
	}
	elseif ($status==2) {
		# code...
		$arr['status']='success';
	}
	elseif ($status==3) {
		# code...
		$arr['status']='error';
	}
	echo json_encode($arr);
}

if(array_key_exists('idea_id',$_POST))
{
	
	addlike($_POST['user_id'],$_POST['idea_id']);
}