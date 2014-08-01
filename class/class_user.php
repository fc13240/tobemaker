<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
/**
* user 相关操作的类
*/
class user_manager
{
	
	function check_user_login($username="")
	{
		# code...
	}
	static function get_user_group($username="",$passcode=""){
		//return admin or formaluser
	}
	function get_user_ID(){

	}

}

