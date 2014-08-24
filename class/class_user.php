<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

/*
 * 用户管理类，实现了
 * 
 * 1. 用户信息的增删改查
 * 2. 与session类配合实现用户登录
 * 
 */

class class_user
{
    private $db = null;
    
    function class_user(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
        
    }
    
    // 添加用户
    function insert($data){
        
        $username = $this->db->escape($data['username']);
        $password = $this->db->escape($data['password']);
        
        $result = $this->db->query("INSERT INTO `user_info` (`user_name`, `user_passcode`, `user_group`) VALUES ('$username', md5('$password'), 'default') ");
        
        return true;
    }
    // 根据数组字段插入数据
    public function insert_user($table_name,$array){
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

    public function userlogin($username,$password){
        $sql="SELECT * from `user_info` where `user_name`='".$username."'";

        $res=$this->db->get_results($sql,ARRAY_A);
        // 不存在用户名
        if(count($res)==0){
            $result['status']='no_user';
            return $result;
        }

        //密码错误
        elseif ($res['pass_code']!=$password) {
            # code...
            $result['status']='password_error';
            return $result;

        }
        //成功登录
        elseif ($res['pass_code']==$password) {
            # code...
            $result['status']='success';
            $result['data']=$res[0];
            return $result;
        }
    }

    // 删除用户
    function delete($userid){
        $userid = $this->db->escape($userid);
        
        $result = $this->db->query("DELETE FROM `user_info` WHERE `user_id` = '$userid' ");
        
        return true;
    }
    
    // 更新用户信息
    function update($userid, $data){
        
    }
    
    // 获取用户信息
    function select($userid){
        
        $result = $this->db->get_results("SELECT * FROM `user_info` WHERE `user_id` = $userid ", ARRAY_A);
        
        return $result;
    }
    
    // 获取用户列表
    function get_user_list($start, $length){
        
        $result = $this->db->get_results("select * from `user_info` limit $start,$length", ARRAY_A);
        
        return $result;
        
    }    
    
    function get_num_of_user(){
        $result = $this->db->get_results("select count(`user_id`) from `user_info`", ARRAY_N);
        return $result[0][0];
        
    }
    
}