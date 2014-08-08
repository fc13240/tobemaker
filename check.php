<?php
require 'config.php';
include_once 'class/class_showsql.php';
include_once 'view/check_form.html';
header("Content-Type: text/html; charset=utf-8");
// 鉴别身份
function checkeruser($username="",$passcode=""){
	//code
	if(user_manager::check_user_login()){
		$group=$_SESSION['group'];
		if($group=='admin'){
			show_idea_data();
		}
		elseif ($group='formal_user') {
			# code...
			header("other");
		}
	}
	else{
		header("error_log");
	}
}
function manage_post()
{
	# code...
	$idea_id=$_POST['idea_id'];
	$idea_ch_status=$_POST['idea_ch'];
	$admin_id=$_SESSION['user_id'];
	$reason=$_POST['reson'];
	$sql="update table idea_manage set idea_status=".$idea_ch_status.",checker_id=".$user_id.",reason=".$reason."where idea_ID=".$idea_id;
	mysql_query($sql);
}
show_idea_data();
?>


