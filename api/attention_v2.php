<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

class attention_v2{
    
    function index(){
        
    }
    
    // select
    function to_me($user_id){
        $class_attention = new class_Attentionv2();
        
        $result = $class_attention->select_to_me($user_id);
        
        return array(
            'status' => 'success',
            'amount' => count($result),
            'data' => $result,
        );
    }
    
    function from_me($user_id){
        
        $class_attention = new class_Attentionv2();
        
        $result = $class_attention->select_from_me($user_id);
        
        return array(
            'status' => 'success',
            'amount' => count($result),
            'data' => $result,
        );
        
        
    }
    
    function count($user_id){
        
        $class_attention = new class_Attentionv2();
        $result_from_me = $class_attention->select_from_me($user_id);
        $result_to_me = $class_attention->select_to_me($user_id);
        
        return array(
            'status' => 'success',
            'to_me_count' => count($result_to_me),
            'from_me_count' => count($result_from_me),
        );
        
    }
}