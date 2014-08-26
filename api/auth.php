<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_auth.php";
include_once ROOT_PATH."class/class_group_auth.php";
$group_auth=new class_group_auth();
$auth=new class_auth();



//如果是修改请求
//则做出相应修改

if(isset($_POST["action"])&&isset($_POST["auths"])){
  $act=$_POST["action"];
  $auths=$_POST["auths"];
  $group_id=$_POST["groupid"];
  $num=count($auths);
  $i=0;
  
if($act=='auth_update')
{
var_dump($_POST);
    while($i<$num)
	{
	    $group_auth->insert($group_id,$auths[$i]);
	    $i++;
	}
	 $res= array();
      $res['status']='success';
      echo json_encode($res);
}
  else
  {
     $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
}

elseif(isset($_POST["action"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
}

if (array_key_exists('draw', $_REQUEST)){
// 请求来自dataTable

        // 设置总用户条数，用于计算分页数量
        $iTotalRecords =$auth->get_action_num();

        // 当前显示数量
        $iDisplayLength = intval($_REQUEST['length']);
        // lenth = -1, 表示显示全部信息
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


        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        $real_length=$end-$iDisplayStart;

        $action_list = $auth->get_action_name_list();


        $records = array();
        $records["data"] = array(); 
        $keys=array_keys($action_list);
		//获取用户拥有的权限
		
		
		
       for($i=0;$i<count($action_list);$i++){
		
           
            $records["data"][] = array(
                '<input class="checkboxes" type="checkbox" name="id['.$action_list[$keys[$i]].']" id="id['.$action_list[$keys[$i]].']" value="'.$action_list[$keys[$i]].'" />',
                $action_list[$keys[$i]]
                
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
}


 