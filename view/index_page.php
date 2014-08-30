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
			<input type="text" name="username" />
		</div>
		<div class="form-group">
			<label>密码</label>
			<input type="password" name="password" />
		</div>
		<input type="button" name="action" value="login" />
		
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
			<input type="password" name="passwordAgain" />
		</div>
		<div class="form-group">
			<label>邀请码</label>
			<input type="text" name="inviteCode" />
		</div>
		<input type="submit" name="action" value="register" />
	</form>
	<form id="forgetPassForm" action="" method="post">
		<div class="form-group">
			<label>邮箱</label>
			<input type="text" name="username" />
		</div>
		<input type="submit" name="login" value="发送" />
	</form>
            <form action="" method="post">
                <input type="submit" name="action" value="auto_login" />
            </form>
            <script src="./js/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#loginForm input[type=button]').click(function(){
                        alert('ok');
                        var url = $('#loginForm').data('url');
                        var user_email = $('#loginForm input[name=username]').val();
                        var password = $('#loginForm input[name=password]').val();
                        $.post(url, {
                            'action':'login', 
                            'user_email':user_email, 
                            'password':password
                            }, function(data, textStatus){
                            
                        }, 'json');
                    });
                });
            </script>
	</body>
</html>