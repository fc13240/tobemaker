<?php

/*
前台项目展示接口

1，传入   $user_id start（开始位置），length（长度） type
       sort_rule:"new"/"hot"/"recommend"

user_id=-1  表示首页获取数据

type="pass" 获取集赞通过的数据
type="produce"  获取待生产的项目
type="pass_prduce" 获取集赞和待生产的项目

2，传出   
         num_of_all    符合条件总数
         data          数据数组
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";


    $class_idea=new class_idea();
    $class_like=new class_like();
    //如果发送了用户id，则获取是否喜欢的信息，否则默认不喜欢
    if(array_key_exists('user_id', $_POST))
    {
        $get_likeit=true;
        $user_id=$_POST['user_id'];
    }
    else{
        $get_likeit=false;
    }

   // echo $_POST['type'];
    $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:6;
    //装备参数

    if(array_key_exists('sort_rule', $_POST))
    {
        if($_POST['sort_rule']=='new')
        {
            $sort_rule='create_time';
        }
        elseif($_POST['sort_rule']=='hot')
        {
            $sort_rule='sum_like';
        }
        elseif($_POST['sort_rule']=='recommend')
        {
            $sort_rule='is_recommend';
        }
    }
    else{
        $sort_rule='is_recommend';
    }
        if($_POST['type']=="pass")
        {
            $status_id=4;


            if($sort_rule=='is_recommend'){

                $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and idea_status=4 and is_recommend>0";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4  and `idea_info`.`is_recommend`>0 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."`  desc limit ".$start.",".$length;

            $res=$class_idea->select($sql);

            }
            else{

            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4";


            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."`  desc limit ".$start.",".$length;

            $res=$class_idea->select($sql);
        }
            $i=0;
            $tmp=count($res);
            while ($i<$tmp) {
                # code...
                if($get_likeit==true){
                    $idea_id=$res[$i]['idea_id'];
                    $check_like=$class_like->get_like_info($idea_id,$user_id);
                    if($check_like==1)
                    {
                        $res[$i]['likeit']=1;
                    }
                    else{
                        $res[$i]['likeit']=0;
                    }
                    $i++;
                }
                else{
                    $res[$i]['likeit']=0;
                    $i++;
                }
            }
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();
        }

        //抓数据
        elseif ($_POST['type']=="produce") {
            # code...
            $status_id=5;
             if($sort_rule=='is_recommend'){
                $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and idea_status=5 and `idea_info`.`is_recommend`>0";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5  and `idea_info`.`is_recommend`>0 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."`  desc limit ".$start.",".$length;

            $res=$class_idea->select($sql);

            }
            else{
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."`  desc limit ".$start.",".$length;

            $res=$class_idea->select($sql);
        }
            $i=0;$tmp=count($res);
            while ($i<$tmp) {
                # code...
                if($get_likeit==true){
                    $idea_id=$res[$i]['idea_id'];
                    $check_like=$class_like->get_like_info($idea_id,$user_id);
                    if($check_like==1)
                    {
                        $res[$i]['likeit']=1;
                    }
                    else{
                        $res[$i]['likeit']=0;
                    }
                    $i++;
                }
                else{
                    $res[$i]['likeit']=0;
                    $i++;
                }

            }
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();
        }
        elseif ($_POST['type']=="pass_produce") {
            # code...

            //获取总共数量

            if($sort_rule=='is_recommend'){

                $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and idea_status=5 and `idea_info`.`is_recommend`>0";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`is_recommend`>0 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."`  desc limit ".$start.",".$length;

            $res=$class_idea->select($sql);

            }
            else{
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5)";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`".$sort_rule."` desc limit ".$start.",".$length;
            $res=$class_idea->select($sql);
        }
            $i=0;$num=count($res);
            while ($i<$num) {
                # code...
                if($get_likeit==true){
                    $idea_id=$res[$i]['idea_id'];
                    $check_like=$class_like->get_like_info($idea_id,$user_id);
                    if($check_like==1)
                    {
                        $res[$i]['likeit']=1;
                    }
                    else{
                        $res[$i]['likeit']=0;
                    }
                    $i++;
                }
                else{
                    $res[$i]['likeit']=0;
                    $i++;
                }
            }
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();

        }
 
    
?>

