<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            <div class="ttl">
                <div class="title"><?php echo $item[0]['name'];?></div>
                <div class="author">
                    <a href="javascript:void 0"><img src="asset/15.png" alt=""></a>
                    <br />
					<input type="hidden" id="author_id" value="<?=@$item[0]["user_id"]?>">
					<input type="hidden" id="user_id" value="<?=@$user_id?>">
                    <a href="javascript:void 0"><a href="javascript:void 0"><?php echo $item[0]['user_name'];?></a>
                </div>
                <div class="subtitle"><?php echo $item[0]['tags'];?></div>
                <div class="emailme">
                    <a href="javascript:void 0" id="addAttention" data-url="<?=BASE_URL?>api/attention.php"><img src="asset/10.png" alt=""></a>
					<a href="javascript:void 0" id="deleteAttention" data-url="<?=BASE_URL?>api/attention.php" style="display:none">取消关注</a>
                    <a href="<?=BASE_URL?>msg_send.php?userid=<?=@$item[0]["user_id"]?>"><img src="asset/11.png" alt=""></a>
                </div>
                <br class="clear"/>
            </div>
            <div class="simditor" style="border: none;">
            	 <div class="atc simditor-body">
                <p><?php echo $item[0]['content'];?></p>
                <?php 
                if(isset($item[0]['cover_display'])&&intval($item[0]['cover_display'])==1){
                ?>
                <img src=<?php echo "\"".$item[0]['picture_url']."\""?> alt="图挂了">
                <?php
                }
                ?>
            </div>
            </div>
           
            <div class="commentbox">
                <form id="commentForm" action="<?=BASE_URL?>project.php" method="POST" >
                    <label>评论</label>
                    <textarea id="saytext" name="saytext"></textarea>
                    <a href="javascript:void 0" class="emotion">添加表情</a>
                    <input type="checkbox"><span>同时推荐该想法</span>
                    <input type="hidden" name="idea_id" value="<?=$idea_id?>"/>
                    <input class="sub_btn" type="submit" value="评论">
                    <p>个字符</p>
                    <em>2000</em>
                    <p>还可以输入</p>
                </form>


            </div>

        </div>
        <div class="comment">
            <h1>全部评论</h1>
            <ul id="comment-list-content">
                        <li>
                            <div class="commenter">
                                <a href="javascript:void 0"><img src="asset/15.png" alt=""></a>
                                <br />
                                <a href="javascript:void 0">评论者名称</a>
                            </div>
                            <div class="text">
                        评论内容
                        <img src="asset/17.png" alt="">
                            </div>
                        </li>
               
            </ul>
            <div id="comment-pagenum" class="pagenum" data-url="<?=BASE_URL?>api/get_comment.php">
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
        <div class="pendant left">
            <ul>
                <li><a href="javascript:void 0" class="red">分&nbsp;&nbsp;&nbsp;&nbsp;享</a></li>
                <li><a href="#commentForm">评&nbsp;&nbsp;&nbsp;&nbsp;论</a></li>
                <li><a id="like_btn" class="<?=($is_like_item==1?'red':'')?>" href="javascript:void 0" data-idea_id="<?=$idea_id?>" data-url="<?=BASE_URL."api/like.php"?>">超喜欢</a></li>
            </ul>
        </div>
        <div class="pendant right">
            <a href="#top"><img src="asset/9.png" alt="" class="backtotop"></a>
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

<script>
    
    var pageSize = 50;
    var pageNow = 1;
    var maxPageNo = 1;
    
    function loadIdeaPage(current_page){
        
        var start = (current_page - 1) * pageSize;
        var length = pageSize;
        var url = $('#comment-pagenum').data("url");
        var idea_id = <?=$idea_id?>;
        $.post(url, {"action":'get_comment' ,"start":start, "length":length, "idea_id":idea_id}, function(data, textStatus){
            console.log(data);
            
            // set up content
            var $container = $('#comment-list-content');
            $container.html('');
            
            for (var i=0; data.data != undefined && i<data.data.length; i++){
                var item = data.data[i];

                $container.append('\
            <li>\
                <div class="commenter">\
                    <a href="javascript:void 0"><img src="'+(item['head_pic_url']==undefined?'asset/15.png':item['head_pic_url'])+'" alt=""></a>\
                    <br />\
                    <a href="<?=BASE_URL.'person.php?user_id='?>'+item['sender_id']+'">'+item['user_name']+'</a>\
                </div>\
                <div class="text">'+item['context']+'\
                </div>\
            </li>');
            }
            
            // set up page nav
            var $pageNav = $('#comment-pagenum');
            $pageNav.html('');
            maxPageNo = Math.ceil( parseInt(data.num_of_all) / pageSize );
            for (var i=1; i<=maxPageNo && i<=9; i++){
                var pageNavClass = "";
                if (i == current_page){
                    pageNavClass = ' class="active" ';
                }
                $pageNav.append('<a href="#" '+ pageNavClass +' >'+ i +'</a>');
            }
            if (maxPageNo > 9){
                $pageNav.append('<a>...</a>');
            }
        },"json");
    }
    
    $("#comment-pagenum").on("click","a",function(){
        var current_page = parseInt( $(this).text() );
        pageNow = current_page;
        loadIdeaPage(pageNow);
    });
    //注册关注事件
            $("#addAttention").click(function(){
			var attention_userid = $('#author_id').val();
			var userid=$("#user_id").val();
			var url=$(this).data('url');
			$.post(url, {
			        'action':'add',
                    'userid':userid,
                    'attention_userid':attention_userid
                    
                    }, function(data, textStatus){
                    if (data.status == "success"){
					var $control=$("#addAttention");
                        $control.hide();
                      $("#deleteAttention").show();
                        alert('关注成功！');
                    }else{
                        //rollBack();
                        alert("关注失败");
                        
                    }
                },'json');
			});
			//注册取消关注事件
			 $("#deleteAttention").click(function(){
			var attention_userid = $('#author_id').val();
			var userid=$("#user_id").val();
			var url=$(this).data('url');
			$.post(url, {
			        'action':'delete',
                    'userid':userid,
                    'attention_userid':attention_userid
                    
                    }, function(data, textStatus){
                    if (data.status == "success"){
					var $control=$("#deleteAttention");
                        $control.hide();
                        $("#addAttention").show();
                        alert("取消成功")
                    }else{
                        //rollBack();
                        alert("取消关注失败");
                        
                    }
                },'json');
			});
    function replace_em(str){
        str = str.replace(/\</g,'&lt;');
        str = str.replace(/\>/g,'&gt;');
        str = str.replace(/\n/g,'<br/>');
        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="asset/arclist/$1.gif" border="0" />');
        return str;
    }
    
    $(function(){
        $('.emotion').qqFace({
            id : 'facebox',
            assign:'saytext',
            path:'asset/arclist/'	//表情存放的路径
        });
        $(".sub_btn").click(function(){
            var str = $("#saytext").val();
            $("#saytext").val(replace_em(str));
    //        alert(replace_em(str));
//           $("#show").html(replace_em(str));
        });
        $(".pendant").pin({
            minWidth : 1220
        });

        $("#like_btn").click(function(){
            var url = $(this).data("url");
            var idea_id = $(this).data("idea_id");
            //TODO:从当前登录用户信息中获取用户id
            var user_id = 1;
            $.post(url, {'idea_id':idea_id, 'user_id':user_id}, function(data,textStatus){
                var status = data['status'];
                if (status == "success"){
                    $("#like_btn").addClass("red");
                }else if (status == "error"){
                    alert("系统错误，请联系管理员");
                }else if (status == "like_already"){
                    alert("已标记喜欢，请勿重复提交");
                }
            },'json');
        });
        
        pageNow = 1;
        loadIdeaPage(pageNow);

    });
</script>

</body>
</html>
