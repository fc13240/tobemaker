<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_page_support.php";

class class_idea
{
    private $db = null;

    function class_idea(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
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
    
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
    // 显示待审核想法
    //$num_of_get  
    public function get_waiting($num_of_eachpage)
    {
        
           $con = mysql_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD); 
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
           $pageSupport->__set("sql","select `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=0 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`;"); 
           $pageSupport->read_data();//读数据
           if ($pageSupport->current_records > 0) //如果数据不为空，则组装数据
           {
           return $pageSupport->result;// 
           //返回二维数组result[i]['aa']  表示第i条记录中字段｀aa｀的值
          // 提取的字段包括：idea_id user idea_name idea_status status_name reason 
        /********
        *
        *显示用例
        *

        for ($i=0; $i<$pageSupport->current_records; $i++)
        {
            $title = $pageSupport->result[$i]["title"];
            $content = $pageSupport->result[$i]["content"];
            
            $part=substr($content,0,400);
            //循环输出每条数据
            echo '<div class="index_side">        
                <div class="index_title">'.$title.'</div>
                <div class="index_content">'.$part.'</div>
                <div class="index_button">
                   <a href="#">update</a>&nbsp;&nbsp;&nbsp;<a href="#">delet</a>
                </div>
            </div>';
        }
        */
            }
            $pageSupport->standard_navigate(); //调用类里面的这个函数，显示出分页HTML
                mysql_close($con);
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
    public function mark_pass($idea_id,$reason){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
        $sql="update idea_info set `idea_status`=2 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="update idea_manage set `idea_status`=2 ,`reason`=".$reason.",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
    }
    
    // 标记审核不通过
    public function mark_fail($idea_id,$reason){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
        $sql="update idea_info set `idea_status`=3 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="update idea_manage set `idea_status`=3 ,`reason`=".$reason.",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
    }
     //  点赞
    public function add_like($idea_id,$user_id)
    {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
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

    // 添加评论记录，返回是否添加成功
    public function add_comment($user_id,$idea_id,$comment_text){
      //  修改两张表：idea_comment
      //  idea_info 中的sum_count 字段
      $sql="update idea_info set sum_commment=sum_comment+1";
      $this->db->query($sql);
      $sql="insert into idea_comment values(".$idea_id.",".$user_id.",".$comment_text.",0,now(),null)";
      $this->db->query($sql);


    }
    //  获取某个想法所有评论 按时间排序
    public function get_comment($idea_id){
      $sql="select * from idea_comment where idea_id=".$idea_id."order by comment_time";
      $res=$this->db->get_results($sql,ARRAY_A);
      return $res;
    }

}