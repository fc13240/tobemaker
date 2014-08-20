<?php

/*
前台项目展示接口

1，传入   start（开始位置），length（长度）

2，传出   num_of_currentpage  当前页面结果数量
         num_of_all    符合条件总数
         data          数据数组
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";
	$class_idea=new class_idea();

	$start=isset($_POST['start'])?$_POST['start']:0;
	$length=isset($_POST['length'])?$_POST['length']:6;
	$res=$class_idea->get_passed();
	$num=count($res);
	$res=array_slice($res,$start,$length);
	$records=array();
	$records['data']=array();
	$records['data']=$res;
	$records['num_of_currentpage']=count($res);
	$records['num_of_all']=$num;
	echo json_encode($records);
?>

