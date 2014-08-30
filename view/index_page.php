<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>tobeMaker</title>
	</head>
	<body>
            <form id="loginForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?>">
		<div class="form-group">
			<label>用户名（邮箱）</label>
			<input type="text" name="username" value="test" />
		</div>
		<div class="form-group">
			<label>密码</label>
			<input type="password" name="password" value="123" />
		</div>
		<input type="button" name="action" value="login" />
		
	</form>
	<form id="regForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?> ">
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
			<input type="password" name="passwordAgain" />
		</div>
		<div class="form-group">
			<label>邀请码</label>
			<input type="text" name="inviteCode" />
		</div>
		<input type="button" name="action" value="register" />
	</form>
	<form id="forgetPassForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?>>
		<div class="form-group">
			<label>邮箱</label>
			<input type="text" name="username" />
		</div>
		<input type="button" name="login" value="发送" />
	</form>
            <form action="" method="post">
                <input type="submit" name="action" value="auto_login" />
            </form>
            <script src="./js/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#loginForm input[type=button]').click(function(){
                        var url = $('#loginForm').data('url');
                        var user_email = $('#loginForm input[name=username]').val();
                        var password = $('#loginForm input[name=password]').val();
                        $.post(url, {
                            'action':'login', 
                            'user_email':user_email, 
                            'password':password
                            }, function(data, textStatus){
                            if (data['status'] != 'success'){
                                alert(data['status']);
                            }else{
                                location.href = 'project_list.php';
                            }
                        }, 'json');
                    });
                    $('#regForm input[type=button]').click(function(){
                        var url = $('#regForm').data('url');
                        var user_email = $('#regForm input[name=username]').val();
                        var password = $('#regForm input[name=password]').val();
                        var passwordAgain = $('#regForm input[name=passwordAgain]').val();
                        var inviteCode = $('#regForm input[name=inviteCode]').val();
                        if (password != passwordAgain){
                            alert('两次输入的密码不一致');
                            return;
                        }
                        $.post(url, {
                            'action':'register', 
                            'user_email':user_email, 
                            'password':password,
                            'invite_code':inviteCode,
                            }, function(data, textStatus){
                            if (data['status'] != 'success'){
                                alert(data['status']);
                            }else{
                                location.href = 'person.php';
                            }
                        }, 'json');
                    });
                });
            </script>
	</body>
</html>