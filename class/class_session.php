<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

class class_session
{
    
    private $login_page_url = 'mg_admin/login.php';
    private $logout_page_url = 'mg_admin/logout.php';
    private $db = null;
    
    function class_session(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        
    }
    
    public function check_login(){
        
        if ( isset($_SESSION['is_login']) && $_SESSION['is_login'] === true ){
            return true;
        }else{
            return false;
        }
        
    }
    
    private function login_url($redirect_url = null){
        
        $url = BASE_URL.$this->login_page_url;
        
        if ( !is_null($redirect_url) ){
            $url .= '?redirect_url='.urlencode($redirect_url);
        }
        
        return $url;
    }
    
    private function logout_url($redirect_url = null){
        
        $url = BASE_URL.$this->logout_page_url;
        
        if ( !is_null($redirect_url) ){
            $url .= '?redirect_url='.urlencode($redirect_url);
        }
        
        return $url;
    }
    
    public function logout_direct_back(){
        
        $this_page_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $url = $this->logout_url($this_page_url);
        return $url;
    }


    public function check_login_jump($url = null){
        if ($this->check_login()){
            return true;
        }else{
            // jump to $url
            
            if ( is_null($url) ){
                $this_page_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
                $url = $this->login_url($this_page_url);
            }else{
                $url = $this->login_url($url);
            }
            
            header("Location: $url");
        }
    }
    
    public function login(){
        $username = $this->db->escape($_POST['username']);
        $password = $this->db->escape(MD5($_POST['password']));
        
        
        $result = $this->db->get_row("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'", ARRAY_A);
        
        if ( !is_null($result) && count($result) > 0){
            
            $_SESSION['is_login'] = true;
            $_SESSION['username'] = $username;
            
            if (isset($_POST['redirect_url'])){
                $url = urldecode($_POST['redirect_url']);
                
                header("Location: $url");
            }
            
            return true;
        }else{
            
            return false;
        }
    }
    
    public function logout(){
        
        session_destroy();
        
        if (isset($_GET['redirect_url'])){
            $url = urldecode($_GET['redirect_url']);

            header("Location: $url");
        }
        
    }
}