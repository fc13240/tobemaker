<?php
/*
user相关操作接口说明
登录
传入

action = 'login'
user_email 
password
返回

status = 'no_user'/'error_pasword'/'success'
注册用户
传入

action = 'register'
user_email
password
invite_code
返回

status = 'user_exist'/'success'/'error'
注销
传入

action='logout'
返回

status='success'/'error'
-找回密码

传入

action='findpass'
user_email
传出

status＝'no_user'/'success'
-检测用户是否已经存在 传入

action='checkuser'
user_email
传出

status＝'user_exist'/'available'

*/
?>
<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
//include_once ROOT_PATH."class/class_invitation_code.php";
$class_session=new class_session();
$class_user=new class_user();
//$class_invitation_code=new class_invitation_code();
function check_invitation_code($invitation_code){
	//检测是否需要验证码
	
	//检测验证码是否合格
	$res=$class_invitation_code->check_code($invitation_code);
	if($res['status']=='used'||$res['status']=='nocode')
	{
		return 0;
	}
	else {
		return 1;
	}
}

// 注册

if(array_key_exists("action",$_POST)&&$_POST['action']=='register')
{
	//检测是否需要验证码以及验证码是否合格
	/*
	$res=check_invitation_code($_POST['invite_code']);
	if($res==0){
		$result['status']='error';
		 echo json_encode($result);
	}
    */
    //  组织数据
    $arr=array();

    $arr['user_passcode']=md5($_POST['password']);

    $arr['user_email']=$_POST['user_email'];
    
    $arr['user_name'] = $arr['user_email'];
    
    //检测用户数据
    $checkres=$class_user->select_by_email($arr['user_email']);
    if(count($checkres)>0){
        //存在该用户名

       $result['status']='user_exist';
	    echo json_encode($result);
    }

   
    else{
        //插入数据库
        $class_user->insert_user('user_info',$arr);
        
        // 登录
        $class_session->login($arr['user_email'], $arr['user_passcode']);
        
        $result['status']='success';
        //验证码不可用
       // $class_invitation_code->delete_code($_POST['code']);

	   echo json_encode($result);
        
    }


}

    //登录


elseif(array_key_exists("action",$_POST)&&$_POST['action']=='login'){
    

    $result=$class_session->login();
    //没有错误  登录成功
    echo json_encode($result);
}

elseif(array_key_exists("action",$_POST)&&$_POST['action']=='logout'){
	# code...

	$class_session->logout();
	$result['status']='success';
	echo json_encode($result);
}


?>


