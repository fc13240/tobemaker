<?php //检测帐号是否被注册的AJAX部分


//控制器  处理用户信息  
// 包括用户注册，登录，修改
header("Content-type:text/html;charset=UTF-8");
 $class_user=new class_user();

if($_POST['act']=='register')
{

	//  组织数据
	$arr=array();
	$arr['user_name']=$_POST['username'];

    $arr['passcode']=$_POST['password'];

    $arr['real_name']=$_POST['real_name'];
    $arr['user_email']=$_POST['email'];
    $arr['user_mobile']=$_POST['mobile'];

   //插入数据库
    $class_user->insert_user('user_info',$arr);

    // 跳转到登录页面

}
elseif($_POST['act']=='login'){
	$arr['username']=$_POST['username'];

    $arr['passcode']=$_POST['password'];

    $result=$class_user->userlogin($arr['username'],$arr['passcode']);


    //没有错误  登录成功
    if($result['status']=='success'){
    	//url=

    	//处理session

    }
    //没有该用户
    elseif($result['status']=='no_user'){
    	//显示用户名错误

    }

    //密码错误
    elseif ($result['status']=='password_error') {
    	# code...
    	//显示密码错误

    }  
}

elseif($_POST['act']=='change_info'){
	// 处理图片
    
	//处理文字信息
}
?>