<?php

/*
文件名 get_comment

项目列表查询
传入

action='get_comment'
start
length
idea_id 

start（开始位置），length（长度）
idea_id=  当前项目id


返回

data（数组），其中每个元素需要包括：user_id,head_pic_url,user_name,context,comment_time
num_of_all：项目总数
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_comment.php";


    $class_idea=new class_idea();
    $class_comment=new class_comment();
    //如果发送了用户id，则获取是否喜欢的信息，否则默认不喜欢
    if(array_key_exists('action', $_POST))
    {
       if($_POST['action']=='get_comment')
       {
        $start=isset($_POST['start'])?$_POST['start']:0;
        $length=isset($_POST['length'])?$_POST['length']:10;
        $idea_id=$_POST['idea_id'];
        $num=$class_comment->get_num_of_comment($idea_id);
        $data=$class_comment->get_part_comment_by_ideaid($idea_id,$start,$length);
        $arr['num_of_all']=$num;
        $arr['data']=$data;
        echo json_encode($arr);
        exit();
       }

       
    }
