<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');


 class class_Attentionv2
{
    private $db = null;
    private $db_agent = null;

    function __construct(){
        
        // Initialise database object
        $this->db_agent = class_Db::GetInstance();
        $this->db = $this->db_agent->db;
    }
    
}