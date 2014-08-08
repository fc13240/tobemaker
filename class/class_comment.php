<?php
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
/*******
评论类
主要功能：
1，创建，获取一级评论
2，创建回复，获取回复
3，数据库字段设计：

********************/

class class_comment
{
    private $db = null;

    function class_comment(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
    }

    public function get_reply_by_comment_id($comment_id){
    }

    //根据某个评论，获得其回复的评论对象，若没有，则返回0
    ///  有评论时候返回的是二维数组，result[i]['aa']表示第i条记录的aa字段值
    public function get_all_comment_by_ideaid($idea_id){
         $idea_id = $this->db->escape($idea_id);
    	
    	$sql="SELECT `idea_comment`.`id`,`idea_comment`.`context`,`idea_comment`.`comment_time`,`idea_comment`.`sender_id`,`idea_comment`.`receiver_id`,`idea_info`.`name`,`user_info`.`user_name` from `idea_comment`,`idea_info`,`user_info` where `idea_comment`.`idea_id`=`idea_info`.`idea_id` and `idea_comment`.`sender_id`=`user_info`.`user_id` and `idea_comment`.`receiver_id`=`user_info`.`user_id` order by `idea_comment`.`commnet_time` desc";
    	$result=$this->db->get_results($sql);
    	if(count($result)>0)
    	{
    		return $result;
    	}
    	else{
    		return 0;
    	}

    }
    // 一级评价  传进idea_id，评论者id和评论类容
    //  修改两张表： idea_info 和 idea_comment
    public function add_comment($idea_id,$user_id,$context){
         $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $context=$this->db->escape($context);

    	$sql="update idea_info set sum_comment=sum_comment+1";
        $this->db->query($sql);
    	$sql="select user_id from idea_info where idea_id=".$idea_id;
    	$result=$this->db->get_results($sql);
    	$receiver_id=$result['user_id'];
    	$sql="insert into idea_comment values('$idea_id','$context','0',now(),null,'','$user_id','$receiver_id',0)";
    	$result=$this->db->query($sql);

    }


    //  添加回复  
    //  需要参数  a回复b的评论，需要b的评论事件id，a的id和回复内容
  //    修改一张表：idea_comment 
    public function add_reply($comment_id,$user_id,$context){
    	// 第一步，获取主题id
         $comment_id = $this->db->escape($comment_id);
        $user_id = $this->db->escape($user_id);
        $context=$this->db->escape($context);
    	$sql="select idea_id from idea_comment where id=".$comment_id;
    	$result=$this->db->get_results($sql);
    	$idea_id=$result['idea_id'];

    	// 第二步：添加回复记录
    	$sql="insert into idea_comment values('$idea_id','$context','1',now(),null,'','$user_id','$receiver_id',0)";
    	$result=$this->db->query($sql);
    	//第三步，关联回复对象和本次回复记录
    	$sql="select * from idea_comment where idea_id=".$idea_id." and context=".$context;
    	$result=$this->db->get_results($sql);
    	$id=$result[0]["id"];
    	$sql="update idea_comment set son_id=".$id;
        $this->db->query($sql);

    }

    public function delete_comment(){

    }


}


?>
