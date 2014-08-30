<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

/*
 * session类实现了
 * 
 * 1. Session的管理，用户登录与注销的操作
 * 2. 判断用户是否登录
 * 
 * 使用注意事项：
 * 1. 若要使用该类，要放在其他类实例化前实例化
 * 
 * 数据库说明：
 * user表，用户id字段user_id，用户名字段user_name，密码字段user_passcode，用户组字段user_group
 */

class class_session
{
    private $db = null;
    
    function class_session(){
        
        session_start();
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        
    }
    
    // 判断是否登录
    public function check_login(){
        
        if ( array_key_exists('is_login', $_SESSION) && $_SESSION['is_login'] === true ){
            return true;
        }else{
            return false;
        }
        
    }
    
    // 登录
    public function login($username = '', $password = ''){
        if ($username == ''){
            $username = $this->db->escape($_POST['user_email']);
        }
        if ($password == ''){
            $password = $this->db->escape(MD5($_POST['password']));
        }
        
        $result = $this->db->get_row("SELECT * from `user_info` where `user_activity`='Y' and`user_email`='".$username."'", ARRAY_A);
        
        if ( !is_null($result) && count($result) > 0&&$result['user_passcode']==$password){
            
            $_SESSION['is_login'] = true;
            $_SESSION['user_id'] = $result['user_id'];
            // TODO: 设置默认头像
            $_SESSION['head_url'] = array_key_exists('head_url', $result) ? $result['head_url'] : '';
            $_SESSION['user_name'] = array_key_exists('user_name', $result) ? $result['user_name'] : '';
            $_SESSION['group'] = $result['user_group'];
            $res['status']='success';
            
        }
        //密码错误
        elseif(!is_null($result) && count($result) > 0&&$result['user_passcode']!=$password){
            $res['status']='password_error';
        }
        // 不存在用户名
        else {
            $res['status']='no_user';
        }

        return $res;
    }
    
    // 登出
    public function logout(){
        
        session_destroy();
        
        return true;
        
    }

    // 检查权限
    // 判断当前用户是否具备执行操作action_name的权限
    // 权限管理采用用户组+权限矩阵的方式实现
    public function check_auth($action_name, $return_bool = true){

        // ------- 获取用户所在的权限组 -------
        // 权限组类型：anonymous(0) / none(-1) / "group name"

        $user_group = 0;

        // 判断用户是否登录
        if (!$this->check_login()){
            // 用户未登录，标记为匿名
            $user_group = 0;
        }else{
            //用户已登录，获取系统中的分组
            if (array_key_exists('group', $_SESSION) && $_SESSION['group'] != ""){
                $user_group = $_SESSION['group'];
            }else{
                $user_group = -1;
            }
        }

        // 判断用户所在组是否具有该权限
        // 查询二元组（用户组，权限）是否在数据库中
        $result = $this->db->get_row("SELECT * FROM `group_auth` WHERE `group_name` = '$user_group' AND `action_name` = '$action_name'", ARRAY_A);     
        
        if ( !is_null($result) && count($result) > 0){
            
            return true;
        }else{
            
            return false;
        }
    }

    function set_session(){
        $_SESSION['is_login'] = true;
        $_SESSION['user_id'] = 5;
        // TODO: 设置默认头像
        $_SESSION['head_url'] = 'http://localhost/tobemaker/asset/12.png';
        $_SESSION['group'] = 1;
        $_SESSION['user_name'] = "果壳";
    }
    
}