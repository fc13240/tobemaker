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