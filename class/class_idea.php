<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";

class class_idea
{
    private $db = null;
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
    public function get_num_of_waiting(){
      $sql="SELECT * from idea_manage where idea_status=1";
      $result = $this->db->get_results($sql, ARRAY_A);
      $num=count($result);
      return $num;
    }
    
    public function insert($table_name,$array){
        $num=count($array);
        $value=null;
        $i=0;
        while ($num>0) {
                        # code...
                 $value=$value.$array[$i].",";
                          $i=$i+1;
                 $num=$num-1;
                                           
        }
        $value=rtrim($value,",");
        $sql="insert into".$table_name." values (".$value.")";
        $result = $this->db->query($sql);
        return $result;
    }
    
    
    private function update_one($table_name,$col_name,$value){
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    
    public function delete(){
    }
    
    public function get_idea_by_id($idea_id){
      $sql="SELECT * from idea_info where idea_id=".$idea_id;
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    


    public function get_all_waiting(){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=1 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`";
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result;
    }
    // 显示待审核想法
    //$num_of_get  
    public function get_waiting($begin,$num){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=1 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }
    
 
    // 显示审核通过想法
    public function get_passed($num_of_eachpage){
             //引入类
    
    //////////////////////////////////////////////////////////////////////
           $con = mysql_connect("localhost",DATABASE_USER,DATABASE_PASSWORD); 
           if (!$con)
           {
            die('Could not connect: ' . mysql_error());
           }
           mysql_select_db(DATABASE_NAME, $con);    //选取数据库
           $PAGE_SIZE=$num_of_eachpage;            //设置每页显示的数目
           $pageSupport = new PageSupport($PAGE_SIZE); //实例化PageSupport对象
           $current_page=$_GET["current_page"];//分页当前页数
           if (isset($current_page)) {
            $pageSupport->__set("current_page",$current_page);
           }
           else{
            $pageSupport->__set("current_page",1);
           }
           $pageSupport->__set("sql","select `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`;"); 
           $pageSupport->read_data();//读数据
           if ($pageSupport->current_records > 0) //如果数据不为空，则组装数据
           {
           return $pageSupport->result;// 返回二维数组result[i]['aa'] 
           }
           $pageSupport->standard_navigate(); //调用类里面的这个函数，显示出分页HTML
            mysql_close($con);

        
    }
    
    // 标记想法为审核通过
    public function mark_pass($idea_id,$reason=""){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $idea_id = $this->db->escape($idea_id);
      $reason=$this->db->escape($reason);
        $sql="update idea_info set `idea_status`=2 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="update idea_manage set `idea_status`=2 ,`reason`=\"".$reason."\",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
    }

    public function get_part_passed($begin,$num){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
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

}
