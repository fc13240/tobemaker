<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

class class_idea
{
    private $db = null;

    function class_idea(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
    }

    // ---------  增删改查基本操作 - 开始
    public function select(){
        
        
    }
    
    public function insert(){
        
        
    }
    
    
    private function update(){
        
        
    }
    
    public function delete(){
        
        
    }
    
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
    // 显示待审核想法
    public function get_waiting(){
        
    }
    
    // 显示审核通过想法
    public function get_passed(){
        
    }
    
    // 标记想法为审核通过
    public function mark_pass(){
        
    }
    
    // 标记审核不通过
    public function mark_fail(){
        
    }
    
    // ---------  审核相关操作 - 开始
}