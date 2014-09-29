<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');


 class class_Activity
{
    private $db = null;
    private $db_agent = null;

    function __construct(){
        
        // Initialise database object
        $this->db_agent = class_Db::GetInstance();
        $this->db = $this->db_agent->db;
    }
    
    function add_activity($arr)
    {
        $this->db_agent->update_array('idea_activity',$arr,1);
        return;
    }
    
    function get_activity()
    {
        $sql="select * from `idea_activity`";
        $res=$this->db->get_results($sql,ARRAY_A);
        return $res[0];
    }
    
}