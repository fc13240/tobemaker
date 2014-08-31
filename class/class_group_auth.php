<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";

 class class_group_auth
{
    private $db = null;
    public $num_of_waiting;

    function class_group_auth(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }

    // ---------  增删改查基本操作 - 开始
    public function select($sql_select){
        $result = $this->db->get_results($sql_select, ARRAY_A);  
        if(count($result)>0) 
        {return $result;
        }
        else{
          return false;
        }
    }
   

   // 在表中增加数据  输入表名和数组字段

     function insert($group_id,$action_name){
	
	     if(!$this->check_is_unique($group_id,$action_name))
            {
			     $sql='insert into `group_auth` (`group_name`,`action_name`) values('.$group_id.',\''.$action_name.'\')';
				 $result = $this->db->get_results($sql, ARRAY_A);  
                    return $result; 
			}		 
        else
		{
		     return true;
		}
        //return $result;
    }
    
    // 更新表中某个字段
    private function update_one($table_name,$col_name,$value){
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    //删除某个id的 权限
    public function delete_auth($auth_id){
	$sql='delete from `group_auth` where `auth_id`='.$auth_id;
	$this->db->query($sql);
    }
	// 删除某个组的某个权限
     public function delete_group_auth($group_id,$action_name)
	 {
	    $sql='delete from `group_auth` where `group_name`='.$group_id.' and `action_name`=\''.$action_name.'\'';
		$this->db->query($sql);
	 }
    
  
	
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
    
	 public function get_all_auth($group_id)
	 {
	 
        $sql='SELECT  `group_auth`.`action_name` from `group_auth` where `group_name`='.$group_id;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
	 }
   
    //验证是否重复
    public function check_is_unique($group_id,$action_name)
	{
	   $sql='select * from `group_auth` where `group_name`='.$group_id.' and `action_name`=\''.$action_name.'\'';
	    $result = $this->db->get_results($sql,ARRAY_A);
		return count($result);
	}
   

   
     

    //
}
