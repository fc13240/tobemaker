<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

/*
 * 用户邀请码类，实现了邀请码的增删除修改查询
 * 
 * 1. 邀请码的增删改查
 * 
 */

class class_findpassword
{
    private $db = null;
    
    function class_user(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
        
    }

    //添加找回码
    function add_code($user_email){
    	$code=rand(100000,1000000);
    	$sql="INSERT into `findpass_code`(`code`,`user_email`) values(".$code.",".$user_email.")";
    	$this->db->query($sql);
    	return $code;
    }


    //删除邀请码
    function delete_code($code){
    	//$code=rand(10000,100000);
    	$sql="DELETE from `findpass_code`where code=".$code;
    	$this->db->query($sql);
    }
    // 查询是否可用
    function check_code($code,$email){
    	$arr = array();
    	$sql="SELECT  * from `findpass_code`where code=".$code." and user_email='".$email."'";
    	$res=$this->db->get_results($sql,ARRAY_A);
    	if(count($res)==0)
    	{
    		return 0;
    	}
    	return 1;
    }


    function mark_used($code){
    	$sql="UPDATE`findpass_code`set `used`=1 where code=".$code;
    	$this->db->query($sql);
    }

}

?>    