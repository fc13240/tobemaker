<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";

class class_idea
{
    public $db = null;
    public $num_of_waiting;

    function class_idea(){
        
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

    public function insert($table_name,$array){
        $num=count($array);
        $keys=array_keys($array);
        $values=array_values($array);
        $aa=null;
        $bb=null;
        $i=0;
        while ($i<$num) {
                        # code...
                 $aa=$aa."`".$keys[$i]."`,";
                 if($values[$i]!='now()'){
                 $bb=$bb."'".$values[$i]."',";
               }
               else{
                $bb=$bb.$values[$i].",";
               }
                          $i=$i+1;         
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into ".$table_name."(".$aa.") values(".$bb.")";
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];
    }
    
    // 更新表中某个字段
    private function update_one($table_name,$col_name,$value){
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    

    // 增加改动信息
  
    public function delete(){
    }
    // 获取某个id详细信息
    public function get_idea_by_id($idea_id){
      $sql="SELECT * from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_id`=".$idea_id;
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }

   //通过idea_info字段更新数据  传入修改的id和字段=》值 数组实现更新 
   
     public function update_idea($idea_id,$arr)
    {
      $keys=array_keys($arr);
      $values=array_values($arr);
      $num_a=count($keys);
      $i=0;
      $aa="";
      $bb="";
      while ($i<$num_a) {
        # code...
        if($arr[$keys[$i]]!=""){
        $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE idea_info SET ".$aa." where idea_id=".$idea_id;
      //echo $sql;
      $this->db->query($sql);
    }


    function search_by_key_word($key_word,$start,$length)
    {
      $key_word="%".$key_word."%";
      $sql="SELECT * from `idea_info` where `idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' limit ".$start.",".$length;
      //echo $sql;
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }

    function search_all_by_key_word($key_word)
    {
      $key_word="%".$key_word."%";
      $sql="SELECT * from `idea_info` where `idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."'";
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
    //获取所有项目数量
    public function get_all_idea_num(){
       
        $sql="SELECT * from `idea_info`";
        $result = $this->db->get_results($sql,ARRAY_A);
        return count($result);
    }

   //获取部分项目
     public function get_part_ideas($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }
     // 获取所有待审核项目
    public function get_all_waiting(){
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`";
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result;
    }

   

   //------------------- 待审核项目操作

    //获取待审核项目的数目
    public function get_num_of_waiting(){
      $sql="SELECT * from idea_info where idea_status=2";
      $result = $this->db->get_results($sql, ARRAY_A);
      $num=count($result);
      return $num;
    }
    // 获取部分待审核想法
    //传入起点和读取的数目
    //
    public function get_waiting($begin,$num){
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result;
    }
    

    //------------------- 审核通过项目操作

    //获取审核通过项目的数目
    public function get_num_of_passed(){
      $sql="SELECT * from idea_info where idea_status=4";
      $result = $this->db->get_results($sql, ARRAY_A);
      $num=count($result);
      return $num;
    }
    
    //显示部分审核通过的项目
    public function get_part_passed($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=4 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }

    // 显示审核通过想法
    public function get_passed($num_of_eachpage){
      $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=4 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`)";
      $result = $this->db->get_results($sql, ARRAY_A);
    }
    


//--------------------------几类标记

    // 标记想法为审核通过
    public function mark_pass($idea_id,$reason=""){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $idea_id = $this->db->escape($idea_id);
      $reason=$this->db->escape($reason);
        $sql="update idea_info set `idea_status`=4 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="update idea_manage set `idea_status`=4 ,`reason`=\"".$reason."\",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        return $result;
    }



    // 标记审核不通过
    public function mark_fail($idea_id,$reason=""){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $idea_id = $this->db->escape($idea_id);
      $reason=$this->db->escape($reason);
        $sql="UPDATE idea_info set `idea_status`=3 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="UPDATE idea_manage set `idea_status`=3 ,`reason`=\"".$reason."\",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
    }
    //
}
