<?php
$current_page = 'project';
$page_level = explode('-', $current_page);


include_once "config.php";
include ROOT_PATH."/class/class_idea.php";
include_once ROOT_PATH."/class/class_comment.php";
        //获取数据
$class_comment=new class_comment();
        
//如果有评论
    if(array_key_exists('saytext', $_POST)){
       
       $class_comment->add_comment($_POST["idea_id"],$_POST["user_id"],$_POST["saytext"]);
       $url="Location:".BASE_URL."project.php?idea_id=".$_POST["idea_id"];

       header($url);
       exit();
    }

    //预览页面
    elseif(array_key_exists('title', $_POST)){
      $item[0]['name']=$_POST['title'];
      $item[0]['content']=$_POST['content'];
      $item[0]['picture_url']=$_POST['img_url'];
      $item[0]['user_id']=3;
      if(isset($_POST['cover_display'])){
      $item[0]['cover_display']=$_POST['cover_display'];
      }

      //brief暂时无需获取
      // $$item[0]['user_name']通过session或者cookie获取，预留
      $item[0]['brief']="123123";
      $item[0]['user_name']="asdf";
      $comment_list=array();


      include 'view/project_page.php';
      exit();

    }
    if(empty($_GET["idea_id"])){   // 默认显示主页

    	header('Location: '.BASE_URL);
    }


    //有id 则请求id对应详细
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
