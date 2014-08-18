<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";
$class_idea=new class_idea();

function addlike($user_id,$idea_id){
	// 检测是否点赞
	if(checklike($user_id,$idea_id)){
		return return_result(1);
	}
	else {
		# code...
		//点赞操作
		$class_like=new class_like();

		$aa=$class_like->add_like($idea_id,$user_id);
		if($aa){
			return return_result(2);
		}
		else{
			return return_result(3);
		}

	}

    //返回数据
}

function checklike($user_id,$idea_id){
	$res=$class_idea->get_like_info($idea_id,$user_id);
	if($res)
	{
		return true;
	}
	else{
		return false;
	}
}


function return_result($status){
	$arr=array();
	if($status==1){
		$arr['status']='like_already';
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