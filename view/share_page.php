<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>share</title>
    <?php include "top_css.php" ?>
    <link rel="stylesheet" type="text/css" href="css/redactor.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/redactor.js"></script>

    <script>
        if(!Array.indexOf)
        {
            Array.prototype.indexOf = function(obj)
            {
                for(var i=0; i<this.length; i++)
                {
                    if(this[i]==obj)
                    {
                        return i;
                    }
                }
                return -1;
            }
        }
        $(function()
        {
            $('#content').redactor();
        });
    </script>



</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="share">
            <div class="pic">
                <div class="picture">
                    <label>标题</label>
                    <img src="asset/14.png" alt="">

                </div>
                <p>*上述内容均为原创作品</p>
                <p>*上述内容均为现实可实现的</p>

            </div>
            <div class="form">
                <form action="javascript:void 0">
                    <label>标题</label>
                    <input type="text">
                    <label>作者<span>（选填）</span></label>
                    <input type="text">
                    <label>封面<span>（大图片建议尺寸 900像素*500像素）</span></label>
                    <div class="fileupload">
                        <div>上传</div>
                        <input type="file">
                    </div>
                    <input type="checkbox"><span>封面图片显示在正文中</span>
                    <a href="javascript:void 0" class="a1">添加摘要</a>
                    <label class="last">正文</label>
                    <div class="textdiv">
                        <textarea id="content"></textarea>
                    </div>

                </form>
            </div>
            <div class="submit">
                <div class="out">
                    <div>
                        <button class="save">保存</button>
                        <button class="view">预览</button>
                    </div>
                </div>
            </div>
            <br class="clear"/>
        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>
<script>


</script>
</body>
</html>