<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";
$class_like=new class_like();
$class_idea=new class_idea();
$num_of_all=null;


/*

前台搜索api
传入:

q(关键字)
user_id start（开始位置），length（长度） type

user_id=  当前访问者的id(用于获取是否喜欢)

type: 3类，第一类：查询集赞中，第二类：查询待产，第三类：同时查询集赞和待产 (需要限制该接口只能查询集赞中和待产这两类)

type="pass" 获取集赞通过的数据

type="produce"  获取待生产的项目

type="pass_prduce" 获取集赞和待生产的项目
传出

num_of_all

data[]

*/



if(array_key_exists('user_id', $_POST))
    {
        $get_likeit=true;
        $user_id=$_POST['user_id'];
    }
    else{
        $get_likeit=false;
    }


if(array_key_exists('q', $_POST)){
	$key_word="%".$_POST['q']."%";
	$type=$_POST['type'];
	if($type=='pass'){
		$rule=' `idea_info`.`idea_status`=4 ';
	}
	elseif ($type=='produce') {
		# code...

		$rule=' `idea_info`.`idea_status`=5 ';

	}
	elseif ($type=='all') {
		# code...

		$rule=' ((`idea_info`.`idea_status`=4) or (`idea_info`.`idea_status`=5))';
	}

		# code...

	    $sql="SELECT count(*) from `idea_info` where ".$rule." and (`idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."')";

		$data=$class_idea->select($sql);
		$num_of_all=$data[0]['count(*)'];
		//echo $num_of_all;
		$start=isset($_POST['start'])?$_POST['start']:0;
        $length=isset($_POST['length'])?$_POST['length']:6;

		$sql="SELECT * from `idea_info` where ".$rule." and (`idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."') limit ".$start.",".$length;
		
        $data=$class_idea->select($sql); 


        //

        $i=0;$tmp=count($data);
            while ($i<$tmp) {
                # code...
                if($get_likeit==true){
                    $idea_id=$data[$i]['idea_id'];
                    $check_like=$class_like->get_like_info($idea_id,$user_id);
                    if($check_like==1)
                    {
                        $data[$i]['likeit']=1;
                    }
                    else{
                        $data[$i]['likeit']=0;
                    }
                    $i++;
                }
                else{
                    $data[$i]['likeit']=0;
                    $i++;
                }

            }

        // 
		$result['num_of_all']=$num_of_all;
		$result['num_of_currentpage']=count($data);
		$result['data']=$data;
		echo json_encode($result);
}

else{
	echo "no key_word";
}

?>