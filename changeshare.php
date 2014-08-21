<?php

include 'config.php';
include_once ROOT_PATH."class/class_file.php";
include_once ROOT_PATH."class/class_idea.php";


/*
  前台修改控制器，目前存在bug：
  1，图片显示与上传修改逻辑暂时无法调试

  待完善：
  1，用户信息cookie或者session获取

*/
// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);
$new_idea= new class_idea();

//保存提交的修改
if(array_key_exists('img_url',$_POST))
{
	//保存图片
    $tmp_url=$_POST['img_url'];
    if (strpos($tmp_url,"tmp")){
	$file_instance = new class_file();
    $pic_url=$file_instance->save($tmp_url);
    }
    else{
        $pic_url=$tmp_url;
    }
	// 保存其他信息  预留字段user_id 和user_name
	$arr= array();
	$arr['name']=$_POST['title'];
	$arr['content']=$_POST['content'];
	$arr['picture_url']=$pic_url;
    
	//$arr['user_name']=$_POST['user_id'];
	$arr['user_id']=3;
    $idea_id=7;
    if(array_key_exists('cover-display', $_POST))
    {
        $arr['cover_display']=1;
    }

  //  var_dump($arr);
    $new_idea_id=$new_idea->update_idea($idea_id,$arr);

    //注册修改事件
    $change_info=array();
    $change_info['user_id']=1;  //admin 的id
    $change_info['idea_id']=$_POST['idea_id'];
    $change_info['idea_status']=2;
    $change_info['last_change_time']='now()';
    $new_idea->insert("idea_manage",$change_info);
    
	$url="Location:".BASE_URL."project.php?idea_id=".$idea_id;
	header($url);
}
if(array_key_exists('idea_id',$_GET)){
    $idea_infolist=$new_idea->get_idea_by_id($_GET['idea_id']);
    $idea_info=$idea_infolist[0];
    //var_dump($idea_info);
    include 'view/changeshare_page.php';
}
else{
    echo "no info";
}
