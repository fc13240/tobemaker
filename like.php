<?php
include_once "./config.php";
include_once ROOT_PATH."class/class_like.php";
header("Content-type: text/html; charset=utf-8");
  $class_idea=new class_idea();
  $num=$class_idea->get_num_of_passed();
  echo $num;
  $current_page=$_POST['current_page'];
  $start=($current_page-1)*6;
  $res=$class_idea->get_part_passed($start,6);
  $records=array();
  $records['data']=array();
  $records['data']=$res;
  $records['current_page']=$current_page;
  $records['num_of_currentpage']=count($res);
  echo json_encode($records);
?>
