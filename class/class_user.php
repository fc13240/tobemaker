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
        
    }
    
    // 添加用户
    function insert($data){
        $result = $this->db->query("INSERT INTO `user_info` (`img_url`, `link`, `ad_show`) VALUES ('$img_url', '$link', $ad_show) ");
        
        $result = $this->db->get_results();
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
        
        $result = $this->db->get_results("SELECT * FROM `user_info` WHERE `user_id` = $userid ORDER BY `create_datetime` DESC LIMIT "
                .intval($max_num), ARRAY_A);
        
        return $result;
    }
    
    // 获取用户列表
    function get_user_list(){
        
    }    
    
    
}