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
                    <a href="<?= $new_activity['activity_url']; ?>">
                        <img src="<?= $new_activity['pic_url']; ?>" style="width:1000px;height: auto;"/>
                    </a>
                    <div class="pendant left" style="height: 600px;">
                        <ul style="margin-top: 100px;">
                            <li><a href="javascript:void 0" class="red" id="share">分&nbsp;&nbsp;&nbsp;&nbsp;享</a>
                                <div id="sharein"></div>
                            </li>
                            <li><a href="<?= $new_activity['qiu_piao_url']; ?>">求票</a></li>
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

            <div class="login hide" id="weixin">
                <div class="form border dark">
                    <div class="weixin">
                        <div id="qrcode"></div>
                        <p>用微信<span>扫一扫</span>上方的二维码，
                            <br/>
                            即可分享给您的微信好友或朋友圈。</p>
                        <p>
                            <wb:share-button id="weibo_true_body" style="width:95px;position: relative;left: 20px;" appkey="4SkNjA" addition="number" type="button" ralateUid="5144427096" default_text="ToBeMaker平台上发布了一个新活动“<?= $new_activity['activity_name']; ?>”" pic="<?= $new_activity['pic_url']; ?>"></wb:share-button>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <?php include "bottom_js.php" ?>

        <script type="text/javascript" src="./js/jquery.qqFace.js"></script>
        <script type="text/javascript" src="./js/jquery-migrate-1.1.1.js"></script>
        <script type="text/javascript" src="./js/jQuery.pin.js"></script>
        <script type="text/javascript" src="./js/qrcode.min.js"></script>

        <script>


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

            $(function() {

                

                var qrcode = new QRCode(document.getElementById("qrcode"), {width: 150,
                    height: 150
                });

                function makeCode() {

                    var url = '<?= BASE_URL ?>activity.php?from=qrcode';

                    qrcode.makeCode(url);
                }

                $("#share").click(function() {
                    $("#weixin").removeClass("hide");
                    $("#weixin").siblings("div").addClass("blur");
                    makeCode();
                });

                function hideAll() {
                    $(".login").addClass("hide");
                    $("#weixin").siblings("div").removeClass("blur");
                }
                $(document).keydown(function(event) {

                    if (event.keyCode == 27) {
                        hideAll();
                    }
                });

                $('#weixin').click(function() {
                    hideAll();
                });

                $('#weibo').click(function() {
                    hideAll();
                });

                $('.weibo').click(function(event) {
                    event.stopPropagation();
                });

            });
        </script>

    </body>
</html>
