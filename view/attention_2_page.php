<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-attention</title>
    <?php include "top_css.php" ?>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="mine" id="info">
            <input type="hidden" id="userid" value="<?=@$userid?>"/>
            <img src="<?=@$userInfo[0]["head_pic_url"]?>" alt="" id="avatar" class="small circle">
            <br/>
            <a href="javascript:void 0" class="active">关注我的</a>
            <span class="line">|</span>
            <a href="javascript:void 0">我关注的</a>
        </div>
        <div class="mine slide">
            <ul>
                <li page="0"></li>
                <li page="1">
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <div class="user"><img src="asset/18.png" alt=""><a href="">贞子丹</a></div>
                    <br class="clear"/>
                </li>
                <li page="2"></li>
            </ul>
        </div>
        <div class="mine pageturn">
            <a href="javascript:void(0)" id="prev"><</a>
            <a href="javascript:void(0)" id="next">></a>
        </div>

    </div>
</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>

<?php include "bottom_js.php" ?>

<script>
    $("#info a").click(function(){
        $(this).siblings("a").removeClass("active").end().addClass("active");
    });
    var htm = $("[page='1']").html();
    var flag = 0;
    $("#prev").click(function(){
        if(flag==0){
            $("[page='0']").html(htm);//在这拉取数据填充进li里
            flag = 1;
            $(".slide ul").animate({left:0},1000,
                    function(){
                        $("[page='1']").remove();
                        $("[page='0']").attr("page",1);
                        $(".slide ul li:first-child").before("<li page='0'></li>");
                        $(".slide ul").attr("style","left:-1020px");
                        flag = 0;
                    });
        }
    });
    $("#next").click(function(){
        if(flag==0){
            $("[page='2']").html(htm);
            flag = 1;
            $(".slide ul").animate({left:"-2040px"},1000,
                    function(){
                        $("[page='1']").remove();//在这拉取数据填充进li里
                        $("[page='2']").attr("page",1);
                        $(".slide ul").append("<li page='2'></li>");
                        $(".slide ul").attr("style","left:-1020px");
                        flag = 0;
                    });
        }
    });
</script>

</body>
</html>