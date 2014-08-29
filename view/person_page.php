<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-mine</title>
    <?php include "top_css.php" ?>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="mine">
            <img id="userHead" src=<?php
            echo $user_info['head_pic_url'];
            ?>
             alt="头像读取错误">
                <a href="#" id="btn-upload" style="display: none;" data-url="<?=BASE_URL?>api/user.php" title="上传图片">
                    <form>
                    <input id="fileSelect" type="file" name="file" data-url="http://up.qiniu.com/" /><i class="fa fa-chevron-circle-up"></i>
                    <input id="head_pic_url" type="hidden" name="img_url" value=""/>
                    <input id="key" name="key" type="hidden" value=<?php
    echo "\"".$key."\"";

    ?>>
    <input name="token" type="hidden" value=<?php
    echo "\"".$upToken."\"";

    ?>>
                    </form>
                </a>
            <br/>
            <h2 id="userName"><?php
            echo $user_info['user_name'];
            ?></h2>
            <br/>
            <span id="userTitle"><?php
            echo $user_info['occupation'];
            ?></span>
            <br/>
            <p id="userIntroduction">
            <?php
            echo $user_info['self_intro'];
            ?>
            
            </p>
            <br/>
            <a id="btn-follow"><i class="fa fa-plus"></i></a>
            <a id="btn-msg"><i class="fa fa-envelope-o"></i></a>
            <a href="javascript:0" id="btn-modify"><i class="fa fa-pencil"></i></a>
            <a href="javascript:0" id="btn-comfirm" style="display: none;" data-url="<?=BASE_URL?>api/userinfo_change.php" ><i class="fa fa-check blue"></i></a>
            <a href="javascript:0" id="btn-cancle" style="display: none;" ><i class="fa fa-times red"></i></a>

        </div>
        <input type="hidden" id="user_id" name="user_id" value=<?php 
            echo $user_info['user_id']." />";
            ?>
    </div>
    <div class="middle-margin">
        <div class="minepro list">
            <dl>
                <dd><a href="item.html"><img src="asset/13.png" alt=""></a></dd>
            </dl>
            <dl>
                <dd><a href="item.html"><img src="asset/13.png" alt=""></a></dd>
            </dl>
            <dl>
                <dd><a href="item.html"><img src="asset/13.png" alt=""></a></dd>
            </dl>
            <dl>
                <dd><a href="item.html"><img src="asset/13.png" alt=""></a></dd>
            </dl>

            <div class="prev" id="minelistprev">
                <div><a href="#"></a></div>
            </div>
            <div class="next" id="minelistnext">
                <div><a href="#">></a></div>
            </div>

            <br class="clear"/>
        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>

<?php include "bottom_js.php" ?>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
    <script>
        function bottomBtnToggle(){
            
            $("#btn-follow").toggle();
            $("#btn-msg").toggle();
            $("#btn-modify").toggle();
            
            $("#btn-comfirm").toggle();
            $("#btn-cancle").toggle();
            
            $("#btn-upload").toggle();
        };
        
        function rollBack(){
            var head_url = $('#userHead').data('ori');
            var user_name = $('#userName input[name=user_name]').data('ori');
            var user_occupation = $('#userTitle input[name=user_occupation]').data('ori');
            var user_introduction = $('#userIntroduction input[name=user_introduction]').data('ori');

            $('#userHead').attr('src', head_url);
            $('#userName').html(user_name);
            $('#userTitle').html(user_occupation);
            $('#userIntroduction').html(user_introduction);
        }
        
        $(document).ready(function(){
            
            $("#btn-comfirm").hide();
            $("#btn-modify").show();
            
            $("#btn-modify").click(function(){
                var headUrl = $('#userHead').attr('src');
                $('#userHead').data('ori', headUrl);
                
                var data = $('#userName').text();
                $('#userName').html('<input type="text" name="user_name" value="'+data+'" data-ori="'+data+'" />');
                
                data = $('#userTitle').text();
                $('#userTitle').html('<input type="text" name="user_occupation" value="'+data+'" data-ori="'+data+'" />');
                
                data = $('#userIntroduction').text();
                $('#userIntroduction').html('<input type="text" name="user_introduction" value="'+data+'" data-ori="'+data+'" />');
                
                bottomBtnToggle();
                
            });
            
            $("#btn-comfirm").click(function(){
                var url = $(this).data('url');
                if($('#head_pic_url').val()==""){
                    var head_url = $('#userHead').data('ori');
                }
                else {var head_url=$('#head_pic_url').val();}
               // console.log(head_url);
                var user_name = $('#userName input[name=user_name]').val();
                var user_occupation = $('#userTitle input[name=user_occupation]').val();
                var user_introduction = $('#userIntroduction input[name=user_introduction]').val();
                var user_id = $('#user_id').val();
                console.log(head_url);

                
                $.post(url, {
                    'user_id':user_id,
                    'head_url':head_url,
                    'user_name':user_name,
                    'user_occupation':user_occupation,
                    'user_introduction':user_introduction
                    }, function(data, textStatus){
                    if (data.status == "success"){
                        $('#userName').html(user_name);
                        $('#userTitle').html(user_occupation);
                        $('#userIntroduction').html(user_introduction);

                    }else{
                        rollBack();
                        alert("个人信息修改失败");
                        
                    }
                },'json');
                
                bottomBtnToggle();
                
            });
            
            $("#btn-cancle").click(function(){
                
                rollBack();
                
                bottomBtnToggle();
                
            });
            
            $('#fileSelect').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.key == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        var url="http://yzzwordpress.qiniudn.com/"+ data.result.key;
                        console.log(url);
                        $("#userHead").attr('src', url);
                        $("#head_pic_url").val(url);
                    }
                },
                progress: function (e, data) {

                },
            });
            
        });
    </script>

</body>
</html>
