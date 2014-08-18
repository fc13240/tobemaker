<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
$class_idea=new class_idea();
$iTotalRecords =$class_idea->get_all_idea_num();

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}
function get_detail_by_idea_id($idea_id)
{

  //获取数据
  $requests=$class_idea->get_idea_by_id($idea_id);

  //组织数据
  $cords = array();

  //返回数据
  echo json_encode($cords);
}

function update_one_idea( $idea_id,$arr){
  $class_idea->update_idea($idea_id,$arr);
  // 返回数据
  $res= array();
  $res['status']='success';
  echo json_encode($res);
}

$status_list = array(

  array("notready" => "等待完善"),
  array("newidea" => "新建想法"),
  array("warning" => "等待审核"),
  array("danger" => "已拒绝"),
  array("success" => "已批准")
);
//如果是修改请求
//则做出相应修改
if(isset($_POST["action"])&&isset($_POST["ideaId"])){
  $act=$_POST["action"];
  $idea_id=$_POST["ideaId"];
  $num=count($idea_id);
  $i=0;

  if($act=="idea_pass")
  {
    while ( $i< $num) {
      # code...
      $class_idea->mark_pass($idea_id[$i]);
      $i=$i+1;
    }
      $res= array();
      $res['status']='success';
      echo json_encode($res);
     // exit();
  }
  elseif ($act=="idea_reject") {
    # code...
    while ( $i< $num) {
      # code...
      $class_idea->mark_fail($idea_id[$i]);
      $i=$i+1;
    }
     $res= array();
     $res['status']='success';
     echo json_encode($res);
  }
}

elseif(isset($_POST["action"])&&empty($_POST["ideaId"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
}

else {
  # code...
// 总项目数
// 当前显示数量
$iDisplayLength = intval($_REQUEST['length']);
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 

// 开始位置

$iDisplayStart = intval($_REQUEST['start']);

// Draw counter. 
// This is used by DataTables to ensure that the Ajax 
// returns from server-side processing requests are drawn 
// in sequence by DataTables (Ajax requests are asynchronous 
// and thus can return out of sequence). This is used as part 
// of the draw return parameter.
$sEcho = intval($_REQUEST['draw']);

$records = array();
$records["data"] = array(); 

$end = $iDisplayStart + $iDisplayLength;
$end = $end > $iTotalRecords ? $iTotalRecords : $end;
$real_length=$end-$iDisplayStart;

 // 获取数据

$datalist=$class_idea->get_part_ideas($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
    $status = $status_list[$datalist[$i]["idea_status"]];
  $id = $datalist[$i]["idea_id"];
  $records["data"][] = array(
    '<input class="checkboxes" type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    $datalist[$i]["name"],
    $datalist[$i]["user_name"],
    $datalist[$i]["brief"],
    '<span class="label label-sm label-'.(key($status)).' idea-status">'.(current($status)).'</span>',
    '<a href="javascript:;" class="btn btn-xs blue idea-pass"><i class="fa fa-search"></i>批准</a>'
      . '<a href="javascript:;" class="btn btn-xs red idea-reject"><i class="fa fa-search"></i>拒绝</a>'
      . '<a href="./idea_detail.php?ideaId='.$id.'" class="btn btn-xs default idea-view"><i class="fa fa-search"></i>查看</a>',
  );
}


if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);
}
