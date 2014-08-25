<?php
/*
api功能  获取某个用户所有项目信息
传入  user_id  start length type
传出  data[]  num_of_all

*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
    $class_idea=new class_idea();
    $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:6;

    if ($_POST['user_id']>0) {
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