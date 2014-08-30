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

class class_invitation_code
{
    private $db = null;
    
    function class_user(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
        
    }

    //添加邀请码
    function add_code(){
    	$code=rand(10000,100000);
    	$sql="INSERT into `invitation_code`(`code`) values(".$code.")";
    	$this->db->query($sql);
    	return $code;
    }


    //删除邀请码
    function delete_code($code){
    	//$code=rand(10000,100000);
    	$sql="DELETE from `invitation_code`where code=".$code;
    	$this->db->query($sql);
    }
    // 查询是否可用
    function check_code($code){
    	$arr = array();
    	$sql="SELECT  * from `invitation_code`where code=".$code;
    	$res=$this->db->get_results($sql,ARRAY_A);
    	if(count($res)==0)
    	{
    		$arr['status']='no_code';
    	}
    	elseif ($res[0]['used']==1) {
    		# code...
    		$arr['status']='used';
    	}
    	elseif ($res[0]['used']==0) {
    		# code...
    		$arr['status']='unused';
    	}
    	return $arr;
    }


    function mark_used($code){
    	$sql="UPDATE`invitation_code`set `used`=1 where code=".$code;
    	$this->db->query($sql);
    }

}

?>    