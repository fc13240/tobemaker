<?php
include_once "../config.php";
include_once ROOT_PATH."class/user.php";
include_once "config.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_invitation_code.php";
$class_user=new class_user();
$class_session=new class_session();
$class_findpassword=new class_findpassword();
	//处理找回密码请求
function check_change(){
	$mail=$_POST['user_email'];
	if(array_key_exists('oldpassword', $_POST)){
		$res=$class_user->select_by_mail($mail);
		if(count($res)==0)
		{
			$result['status']='no_user';
			echo json_encode($result);
			exit();
		}
		else {
			# code...
			$password=md5($_POST['oldpassword']);
			if($res[0]['user_passcode']==$password)
				{
					return 1;
				}
			else {
				return 0;
			}

		}

	}
	elseif (array_key_exists('reset_code', $_POST)) {
		# code...
		$res=$findpassword->scheck_code($_POST['reset_code'],$mail);
		if($res==0)
		{
			$result['status']='no_user';
			echo json_encode($result);
			exit();
		}
		else{
			$res=$class_user->select_by_mail($mail);

			$user_id=$res[0]['user_id'];
			$change_arr=array();
			$password=md5($_POST['new_password']);
			$change_arr['user_passcode']=$password;
			$class_user->update($user_id,$change_arr);

		}

	}
}

function mail_code($target_mail,$content){

}


if(array_key_exists("action",$_POST)&&$_POST['action']=='findpass')
{
	//获取信息
	$mail=$_POST['user_mail'];

	 $checkres=$class_user->select_by_email($mail);
     if(count($checkres)==0){
        //不存在该用户名

       $result['status']='no_user';
	    echo json_encode($result);
	    exit();
    }
	//生成验证码
	//$code=rand(100000,1000000);
	$code=$class_findpassword->add_code($mail);

	// 发送邮件
	mail_code($mail,$code);
	//返回信息
	$result['status']='success';
	echo json_encode($result);
	exit();

}

// 重置密码

if(array_key_exists("action",$_POST)&&$_POST['action']=='resetpass')
{

	//检测修改权限
	//检测是否需要验证码以及验证码是否合格
	
	$res=check_invitation_code($_POST['invite_code']);
	if($res==0){
		$result['status']='error';
		 echo json_encode($result);
	}

    //  组织数据
    $arr=array();

    $arr['user_passcode']=md5($_POST['password']);
   // $arr['invite_code']=$_POST[]

    $arr['user_email']=$_POST['username'];
    //$arr['user_mobile']=$_POST['mobile'];
    //检测用户数据
    $checkres=$class_user->select_by_email($array['user_email']);
    if(count($checkres)>0){
        //存在该用户名

       $result['status']='user_exist';
	    echo json_encode($result);
    }

   
   
    else{
        //插入数据库
        $class_user->insert_user('user_info',$arr);

        $result['status']='success';
        //验证码不可用
        $class_invitation_code->delete_code($_POST['code']);

	   echo json_encode($result);
        
    }

	//更新密码
}
?>