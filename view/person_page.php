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
            <img id="userHead" class="circle" src="<?=$user_info['head_pic_url']?>"
             alt="头像读取错误">
                <a href="#" id="btn-upload" style="display: none;" data-url="<?=BASE_URL?>api/user.php" title="上传图片">
                    <form>
                    <input id="fileSelect" type="file" name="file" data-url="http://up.qiniu.com/" /><i class="fa fa-chevron-circle-up"></i>
                    <input id="head_pic_url" type="hidden" name="img_url" value=""/>
                   
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
			<a id="btn-cancel" class="delete" data-url="<?=BASE_URL?>api/attention.php" style="display:none">取消关注</a>
            <a id="btn-follow" class="add" data-url="<?=BASE_URL?>api/attention.php"><i class="fa fa-plus" ></i></a>
            <a id="btn-msg" href="<?=BASE_URL?>msg_send.php?userid=<?=@$user_info['user_id']?>"><i class="fa fa-envelope-o"></i></a>
            <a href="javascript:0" id="btn-modify"><i class="fa fa-pencil"></i></a>
            <a href="javascript:0" id="btn-comfirm" style="display: none;" data-url="<?=BASE_URL?>api/userinfo_change.php" ><i class="fa fa-check blue"></i></a>
            <a href="javascript:0" id="btn-cancle" style="display: none;" ><i class="fa fa-times red"></i></a>

        </div>
        <input type="hidden" id="user_id" name="user_id" value=<?php 
            echo $user_info['user_id']." />";
            ?>
			<input type="hidden" id="session_userid" name="session_userid" value="<?=@$_SESSION["user_id"]?>" />
    </div>
    <div class="middle-margin">
        <div class="minepro list">
            <dl>
                <dd><a href="item.html"><img src="asset/13.png" alt="" class="person-img__blur"><div class="person-img-shield">
                	<p class="state">集赞中</p>
                	<p class="title">可以唱歌的淋浴头</p>
                	<p class="justify"><i class="fa fa-info"></i>
                	                	<!--<i class="fa fa-pencil-square-o"></i>-->
                	                	<i class="fa fa-trash-o"></i>
                	                	</p class="justify">
                </div></a></dd>
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
			
			//注册关注事件
            $("#btn-follow").click(function(){
			var attention_userid = $('#user_id').val();
			var userid=$("#session_userid").val();
			var url=$(this).data('url');
			$.post(url, {
			        'action':'add',
                    'userid':userid,
                    'attention_userid':attention_userid
                    
                    }, function(data, textStatus){
                    if (data.status == "success"){
					var $control=$("#btn-follow");
                        $control.hide();
                      $("#btn-cancel").show();
                        alert('关注成功！');
                    }else{
                        //rollBack();
                        alert("关注失败");
                        
                    }
                },'json');
			});
			//注册取消关注事件
			 $("#btn-cancel").click(function(){
			var attention_userid = $('#user_id').val();
			var userid=$("#session_userid").val();
			var url=$(this).data('url');
			$.post(url, {
			        'action':'delete',
                    'userid':userid,
                    'attention_userid':attention_userid
                    
                    }, function(data, textStatus){
                    if (data.status == "success"){
					var $control=$("#btn-cancel");
                        $control.hide();
                        $("#btn-follow").show();
                        alert("取消成功")
                    }else{
                        //rollBack();
                        alert("取消关注失败");
                        
                    }
                },'json');
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
<?php
	//控制页面显示信息
	if(!array_key_exists('user_id',$_SESSION))
	{
	     echo '<script>$("#btn-follow").remove();$("#btn-msg").remove();</script>';
	}
if(!array_key_exists('user_id', $_GET)){

echo '<script>$("#btn-follow").remove();</script>';

}
elseif($_GET["user_id"]!=$_SESSION["user_id"])
{
   echo '<script>$("#btn-modify").remove();</script>';
   //获取用户是否被关注
$attention=new class_attention();
if($attention->checkunique($_SESSION["user_id"],$_GET["user_id"]))
{
echo '<script>$("#btn-follow").empty();$("#btn-folloy").removeClass();$("#btn-follow").addClass("delete");$("#btn-follow").append("取消关注")</script>';
    //将关注符号改为取消关注
}
}


	?>
</body>
</html>
