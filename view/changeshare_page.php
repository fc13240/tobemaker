<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>share</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/redactor.css">

    

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
                    <img id="coverPreview" src=<?php
                    echo "\"".$idea_info['picture_url']."\"";
                    ?> alt="封面">

                </div>
                <p>*上述内容均为原创作品</p>
                <p>*上述内容均为现实可实现的</p>

            </div>
            <div class="form">
                <form id="idea-form" method="POST">
                    <label>标题</label>
                    <input name="title" type="text" value=<?php echo $idea_info['name'];?>>
                    <label>作者<span>（选填）</span></label>
                    <input name="author" type="text" value=<?php echo $idea_info['user_name'];?>>
                    <label>封面<span>（大图片建议尺寸 900像素*500像素）</span></label>
                    <div class="fileupload">
                        <div>上传</div>
                        <input id="fileSelect" type="file" name="file" data-url="<?= BASE_URL ?>api/tmpfileupload.php">
                        <input id="fileurl" type="hidden" name="img_url" value=""/>
                    </div>
                    <input name="cover-display" type="checkbox" value="1"><span>封面图片显示在正文中</span>
                    <a href="javascript:void 0" class="a1">添加摘要</a>
                    <label class="last">正文</label>
                    <div class="textdiv">
                        <textarea name="content" id="content"><?php echo $idea_info['content'];?></textarea>
                    </div>
                    <?php echo $idea_info['content'];?>

                    <input type="hidden" name="act" value="change_share" />
                    <input type="hidden" name="user_id" value="2" />

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
    <script src="js/jquery.min.js"></script>
    <script src="js/redactor.js"></script>
    <!--<script src="admin/assets/global/plugins/jquery-1.11.0.min.js" />-->
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
<script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>

<script>
$(document).ready(function(){
    console.log("hi");
    $('#content').redactor();
    
    $('#fileSelect').fileupload({
        dataType: 'json',
        done: function (e, data) {
            if (data.result.url == null){
                alert("错误：" + data.result.err_msg);
            }else{
                $("#coverPreview").attr('src', data.result.url);
                $("#fileurl").val(data.result.url);
            }
        },
        progress: function (e, data) {
            
        },
    });
    
    
    $('button.save').click(function(){
        //$('#idea-form').submit();
        $('#idea-form').action="../changeshare.php";
        $('#idea-form').submit();
    });
    
    $('button.view').click(function(){
       // alert('结果预览');
       var formData = $('#idea-form').serialize();
        $.post('project.php', formData, function(data, textStatus){
            var win=window.open("about blank");
            win.document.write(data);
        });
    });
    
});

</script>
</body>
</html>