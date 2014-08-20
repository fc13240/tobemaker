<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-shop</title>
    <?php include "top_css.php" ?>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="shop">
            <div class="menu">
                <ul>
                    <li class="active"><div>家居</div></li>
                    <li><div>手工艺课程</div></li>
                    <li><div>T恤</div></li>
                </ul>
            </div>
            <div class="goods">
                <div class="left">
                    <div><a href="javascript:void 0"><img src="asset/19.png" alt=""><span>$199.00</span></a></div>
                    <div><a href="javascript:void 0"><img src="asset/20.png" alt=""><label>SALE</label><span>$56.00<b>$70.00</b></span></a></div>
                    <div><a href="javascript:void 0"><img src="asset/19.png" alt=""><span>$199.00</span></a></div>
                </div>
                <div class="right">
                    <div><a href="javascript:void 0"><img src="asset/20.png" alt=""><label>SALE</label><span>$56.00<b>$70.00</b></span></a></div>
                    <div><a href="javascript:void 0"><img src="asset/19.png" alt=""><span>$199.00</span></a></div>
                    <div><a href="javascript:void 0"><img src="asset/20.png" alt=""><label>SALE</label><span>$56.00<b>$70.00</b></span></a></div>
                </div>
                <br class="clear"/>

                <div class="pagenum">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">7</a>
                    <a href="#">8</a>
                    <a href="#">9</a>

                </div>


            </div>

            <br class="clear"/>

        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>

<?php include "bottom_js.php" ?>
    
<script>
    $(function(){
        $(".menu li").click(function(){
            $(this).siblings().removeClass("active").end().addClass("active");
        })
    })
</script>
</body>
</html>