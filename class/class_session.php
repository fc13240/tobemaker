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
    
    public function check_login(){
        
        if ( array_key_exists('is_login', $_SESSION) && $_SESSION['is_login'] === true ){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function login(){
        $username = $this->db->escape($_POST['username']);
        $password = $this->db->escape(MD5($_POST['password']));
        
        $result = $this->db->get_row("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'", ARRAY_A);
        
        // debug
        var_dump($result);
        
        if ( !is_null($result) && count($result) > 0){
            
            $_SESSION['is_login'] = true;
            $_SESSION['userid'] = $username;
            $_SESSION['group'] = 1;
            
            return true;
        }else{
            
            return false;
        }
    }
    
    public function logout(){
        
        session_destroy();
        
        return true;
        
    }
}