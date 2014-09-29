<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wb="http://open.weibo.com/wb" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
        <title>tobeMaker-item</title>
        <?php include "top_css.php" ?>
        <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
    </head>
    <body>
        <div id="top">
            <?php include "header.php" ?>
        </div>
        <div id="center">
            <div class="middle">
                <div class="item">
                    <a href="<?=$new_activity['activity_url'];?>">
                    <img src="<?=$new_activity['pic_url'];?>" style="width:1000px;height: auto;"/>
                    </a>
                    <div class="pendant left" style="height: 600px;">
                        <ul class="js-pin" style="margin-top: 200px;">
                            <li><a href="javascript:void 0" class="red" id="share">分&nbsp;&nbsp;&nbsp;&nbsp;享</a>
                                <div id="sharein"></div>
                            </li>
                            <li><a href="<?=$new_activity['qiu_piao_url'];?>">求票</a></li>
                        </ul>
                    </div>
                    <div class="pendant right">
                        <a href="#top" style="position: fixed;top: 190px;"><img src="asset/9.png" alt="" class="backtotop js-headno" style="display: none;"></a>
                    </div>
                </div>

            </div>
            <div id="footer">
                <?php include "footer.php" ?>
            </div>


            <?php include "bottom_js.php" ?>
            <script type="text/javascript" src="./js/jquery.qqFace.js"></script>
            <script type="text/javascript" src="./js/jquery-migrate-1.1.1.js"></script>
            <script type="text/javascript" src="./js/jQuery.pin.js"></script>
            <script type="text/javascript" src="./js/qrcode.min.js"></script>

            <script>
                $(function() {
                    $(".js-pin").pin({
                        //          minWidth : 1220,
                        containerSelector: ".pendant"
                    });

                });

                $(window).scroll(
                        function() {

                            var top = document.body.scrollTop || document.documentElement.scrollTop;

                            if (top < 100)
                                $(".js-headno").css("display", "none");
                            else
                                $(".js-headno").css("display", "inline");


                            //  		if($(".js-headno").scrollTop() == 0)
                            //  			$(".js-headno").css("display","none");
                            //  		else
                            //  			$(".js-headno").css("display","block");
                        }


                );
            </script>

    </body>
</html>
