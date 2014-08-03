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
show_idea_data();
?>


