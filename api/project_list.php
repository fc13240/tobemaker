<?php

/*
前台项目展示接口

1，传入   $user_id start（开始位置），length（长度） type

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
    $class_idea=new class_idea();
    $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:6;
    if($_POST["user_id"]==-1)
    {
        //装备参数
        if($_POST['type']=="pass")
        {
            $status_id=4;
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and idea_status=4";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and `idea_info`.`user_id`=`user_info`.`user_id` limit ".$start.",".$length;

            $res=$class_idea->select($sql);
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
            $status_id=4;
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`user_id`=5";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and `idea_info`.`user_id`=`user_info`.`user_id` limit ".$start.",".$length;

            $res=$class_idea->select($sql);
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
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (idea_status=4 or idea_status=5)";

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=`user_info`.`user_id` limit ".$start.",".$length;

            $res=$class_idea->select($sql);
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();

        }
    }

    elseif ($_POST['user_id']>0) {
        # code...
        //装备参数
        $user_id=$_POST['user_id'];

        if($_POST['type']=="pass")
        {
            //获取总共数量
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and user_id=".$user_id;

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and `idea_info`.`user_id`=`user_info`.`user_id` and `idea_info`.`user_id`=".$user_id." limit ".$start.",".$length;

            $res=$class_idea->select($sql);
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();
        }


        if($_POST['type']=="produce"){
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and user_id=".$user_id;

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and `idea_info`.`user_id`=`user_info`.`user_id` and `idea_info`.`user_id`=".$user_id." limit ".$start.",".$length;

            $res=$class_idea->select($sql);
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();
        }

        if($_POST['type']=="pass_produce"){
            $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=".$user_id;

            $res=$class_idea->select($sql);
            $num=$res[0]['count(*)'];

            // 获取数据
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=`user_info`.`user_id` and `idea_info`.`user_id`=".$user_id." limit ".$start.",".$length;

            $res=$class_idea->select($sql);
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();
        }
    }
    
?>

