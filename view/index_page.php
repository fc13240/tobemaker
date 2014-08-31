
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker</title>
    <link rel="stylesheet" type="text/css" href="css/style-index.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css">

    
</head>
<body class="index">
<div id="index">
    <div class="main">
        <img src="asset/index.jpg" alt="" class="background">
        <div id="fullpage" class="front">
            <div class="section" id="section1">
                <div class="loginbtn">
                    <a href="#" id="login"><img src="asset/7.png" alt=""></a>
                    <a href="#" id="register"><img src="asset/8.png" alt=""></a>
                    <a href="#" id="godown"><img src="asset/27.png" alt=""></a>
                </div>

            </div>
            <div class="section">
                <div class="flow">
                    <label>众造模式</label>
                    <ul>
                        <li>
                            <img src="asset/21.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li>
                            <img src="asset/22.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li>
                            <img src="asset/23.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li>
                            <img src="asset/24.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li>
                            <img src="asset/25.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li>
                            <img src="asset/26.png" alt="">
                            <p>分享创意</p>
                        </li>

                        <br class="clear"/>
                    </ul>
                    <p>在这里，自由分享你创意与设计，说不定她会让大家的生活更便利。</p>
                    <a href="#" id="goup"><img src="asset/28.png" alt=""></a>

                </div>
            </div>
        </div>
    </div>

</div>
<div id="login_form" class="login hide">
    <div class="form">
        <form id="loginForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?>">
            <input type="text" name="username" placeholder="tobeMaker邮箱" value="test">
            <input type="password" name="password" placeholder="密码" value="123">
            <input type="button" value="登录">
            <div>
                <a href="#" id="forget">忘记密码>></a>
                <span>还没有账号？</span>
                <a href="#" id='reg_btn'>立即注册></a>
            </div>
        </form>
    </div>
</div>
<div id="register_form" class="login hide">
    <div class="form">
        <form id="regForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?> ">
            <input type="text" name="username" placeholder="tobeMaker邮箱">
            <input type="text" name="password" placeholder="密码">
            <!--<input type="password" name="passwordAgain" placeholder="确认密码">-->
            <input type="text" name="inviteCode" placeholder="邀请码">
            <input type="checkbox"><span>我已经认真阅读并同意《使用协议》</span>
            <input type="button" value="注册">
        </form>
        <p>关注微信公众号：sidarsm，回复邮箱，获取邀请码</p>
    </div>
</div>

<div id="forget_form" class="login hide">
    <div class="form">
        <form id="forgetPassForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?>" >
            <input type="text" name="username" placeholder="tobeMaker邮箱" id="forget_email">
            <input type="button" value="发送">
            <div>
                <a href="#" id="login2">又想起来了>></a>
            </div>
        </form>
    </div>
</div>
    
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/jquery.fullPage.min.js"></script>
<script src="js/placeholder.js"></script>

<script>
    $(function(){
        $('#fullpage').fullpage();
        if(navigator.userAgent.indexOf("MSIE 8.0")>0||navigator.userAgent.indexOf("MSIE 9.0")>0){
            placeholderGray();
        }
    });
    $("#godown").click(function(){
        $("#fullpage").fullpage.moveSectionDown();
    });
    $("#goup").click(function(){
        $("#fullpage").fullpage.moveSectionUp();
    });
    $("#login").click(function(){
        $(".login").addClass("hide");
        $("#login_form").removeClass("hide");
        blur();
    });
    $("#login2").click(function(){
        $(".login").addClass("hide");
        $("#login_form").removeClass("hide");
        blur();
    });
    $("#register,#reg_btn").click(function(){
        $(".login").addClass("hide");
        $("#register_form").removeClass("hide");
        blur();
    });
    $("#forget").click(function(){
        $(".login").addClass("hide");
        $("#forget_form").removeClass("hide");
        blur();
    });

    function blur(){
        if(navigator.userAgent.indexOf("Firefox") != -1){
            $("#index").addClass("blur");
        }
        else{
            $(".background").addClass("blur");
            $(".section").addClass("blur");
        }
    }
    $(document).keydown(function(event){ 
        
        if (event.keyCode == 27){
            $(".login").addClass("hide");
            $("#index").removeClass("blur");
            $(".background").removeClass("blur");
            $(".section").removeClass("blur");
        }
    });
        
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
//            var passwordAgain = $('#regForm input[name=passwordAgain]').val();
            var inviteCode = $('#regForm input[name=inviteCode]').val();
//            if (password != passwordAgain){
//                alert('两次输入的密码不一致');
//                return;
//            }
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