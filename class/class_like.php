<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
class class_like
{
	private $db = null;

    function class_like(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
    }
     public function add_like($idea_id,$user_id=null)
    {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
        $idea_id = $this->db->escape($idea_id);
      $user_id=$this->db->escape($user_id);
        $sql="select * from idea_like where `idea_id`=".$idea_id." and `user_id`=".$liker_id;
        // 有过点赞记录直接返回
        if(count($this->db->get_results($sql))>0)
        {
            return true;
        }
        //增加点赞
        else{
            $tmp=$this->db->get_results("SELECT * FROM idea_info WHERE `idea_id` = ".$idea_id,ARRAY_A);
            $idea_name=$tmp[0]["name"];
            $sql="insert into idea_like(`idea_id`,`liker_id`,`idea_name`,`like_time`) values (".$idea_id.",".$user_id.",".$idea_name.", now()";
            $this->db->query($sql);
            $sql="update idea_info set sum_like=sumlike+1";
            $this->db->query($sql);
            return true;
        }
    }

// 取消点赞
    public function delet_like($idea_id,$user_id)
    {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
        $idea_id = $this->db->escape($idea_id);
        $user_id=$this->db->escape($user_id);
        $sql="select * from idea_like where `idea_id`=".$idea_id." and `user_id`=".$liker_id;
        // 没有过点赞记录直接返回
        if(count($this->db->get_results($sql))==0)
        {
            return true;
        }
        //取消点赞
        else{
            $tmp=$this->db->get_results("SELECT * FROM idea_info WHERE `idea_id` = ".$idea_id,ARRAY_A);
            $idea_name=$tmp[0]["name"];
            $sql="delete * from idea_like where idea_id=".$idea_id." and liker_id=".$user_id;
            $this->db->query($sql);
            $sql="update idea_info set sum_like=sumlike-1";
            $this->db->query($sql);
            return true;
        }
    }
    public function get_sum_like($idea_id){
        $idea_id = $this->db->escape($idea_id);
    	$sql="select sum_like from idea_info where `idea_id`=".$idea_id;
    	$result=$this->db->get_results($sql,ARRAY_A);
    	if($result[0]["sum_like"]>0){
    		return $result[0]["sum_like"];
    	}
    	else {
    		return 0;
    	}
    }
}