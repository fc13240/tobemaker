<?php
$current_page = 'project';
$page_level = explode('-', $current_page);


include_once "config.php";
include ROOT_PATH."/class/class_idea.php";
include_once ROOT_PATH."/class/class_comment.php";
        //获取数据
$class_comment=new class_comment();
        
//如果有评论
    if(isset($_POST["saytext"])){
       
       $class_comment->add_comment($_POST["idea_id"],$_POST["user_id"],$_POST["saytext"]);
       $url="Location:http://www.cc.com/project.php?idea_id=".$_POST["idea_id"];

       header($url);
       exit();
    }
    else{
    }
    if(empty($_GET["idea_id"])){   // 默认显示主页
    	header('Location: http://www.cc.com');
    }
    else{
    	$idea_id=$_GET["idea_id"]; //有请求的idea
    	// 调用view来显示
    	$class_idea=new class_idea();
        $item=$class_idea->get_idea_by_id($idea_id);
      //$class_comment=new class_comment();
        $comment_list=$class_comment->get_all_comment_by_ideaid($idea_id);
    	include 'view/project_page.php';  
    }

// 导航 当前页面控制
