
<?php
include_once "config.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_session.php";
$class_user=new class_user();
$class_session=new class_session();
$warning=null;
//登录请求

if(array_key_exists("action",$_POST)&&$_POST['action']=='register')
{

    //  组织数据
    $arr=array();

    $arr['user_passcode']=md5($_POST['password']);

   // $arr['real_name']=$_POST['real_name'];
    $arr['user_email']=$_POST['username'];
    //$arr['user_mobile']=$_POST['mobile'];
    //检测用户数据
    $checkres=$class_user->select_by_email($array['user_email']);
    if(count($checkres)>0){
        //存在该用户名

        $warning="存在用户名，请直接登录";
    }

   
    else{
        //插入数据库
        $class_user->insert_user('user_info',$arr);
    // 跳转到登录页面
        
    }

}
elseif(array_key_exists("action",$_POST)&&$_POST['action']=='login'){
    

    $result=$class_session->login();


    //没有错误  登录成功
    if($result['status']=='success'){
        //url=
        echo "1";
        //处理session

    }
    //没有该用户
    elseif($result['status']=='no_user'){
        //显示用户名错误
        echo "2";
    }

    //密码错误
    elseif ($result['status']=='password_error') {
        # code...
        //显示密码错误
        echo "3";

    }  
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>tobeMaker</title>
	</head>
	<body>
	<form id="loginForm" action="" method="post">
		<div class="form-group">
			<label>用户名（邮箱）</label>
			<input type="text" name="username" />
		</div>
		<div class="form-group">
			<label>密码</label>
			<input type="password" name="password" />
		</div>
		<input type="submit" name="login" value="登录" />
		
	</form>
	<form id="regForm" action="" method="post">
		<div class="form-group">
			<label>用户名（邮箱）</label>
			<input type="text" name="username" />
		</div>
		<div class="form-group">
			<label>密码</label>
			<input type="password" name="password" />
		</div>
		<div class="form-group">
			<label>确认密码</label>
			<input type="passwordAgain" name="passwordAgain" />
		</div>
		<div class="form-group">
			<label>邀请码</label>
			<input type="text" name="inviteCode" />
		</div>
		<input type="submit" name="reg" value="注册" />
	</form>
	<form id="forgetPassForm" action="" method="post">
		<div class="form-group">
			<label>邮箱</label>
			<input type="text" name="username" />
		</div>
		<input type="submit" name="login" value="发送" />
	</form>
	<a href="project_list.php"><button>自动登录（调试）</button></a>
	</body>
</html>