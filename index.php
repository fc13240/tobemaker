<?php
include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

if ($class_session->check_login()){
    header("Location: ".BASE_URL."project_list.php");
}

$msg = array(
    'login' => '',
    'register' => '',
);

//登录请求
if(array_key_exists("action",$_POST) && $_POST['action']=='register'){
    
    // 处理注册请求
    $arr=array();
    $arr['user_passcode']=md5($_POST['password']);
    $arr['user_email']=$_POST['username'];
    
    //检测用户数据
//    $checkres=$class_user->select_by_email($array['user_email']);
    $checkers = 0;
    if(count($checkres)>0){
        //存在该用户名
        $msg['register'] = "用户名已存在";
    }else{
        //插入数据库
        $class_user->insert_user('user_info',$arr);
    }
    // 首次登录，跳转到个人信息页面
    header("Location: ".BASE_URL."person.php");

}elseif(array_key_exists("action",$_POST)&&$_POST['action']=='login'){
    
    // 处理登录请求
    $result=$class_session->login();

    if($result['status']=='success'){
        
        $msg['login'] = '登录成功';
        
    }elseif($result['status']=='no_user' || $result['status']=='password_error'){
        
        $msg['login'] = '用户名或密码错误';
        
    }
    // 登录后跳转到项目列表页面
    header("Location: ".BASE_URL."project_list.php");
}elseif (array_key_exists("action",$_POST)&&$_POST['action']=='auto_login'){
    $class_session->set_session();
    header("Location: ".BASE_URL."project_list.php");
}
var_dump($msg);
include "view/index_page.php";