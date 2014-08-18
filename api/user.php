<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_user.php";

// 常亮设置
$status_list = array(
  array("success" => "正常"),
  array("danger" => "屏蔽")
);

$user=new class_user();

// 判断是否为dataTable数据请求
if (array_key_exists('draw', $_REQUEST)){
        // 请求来自dataTable

        // 设置总用户条数，用于计算分页数量
        $iTotalRecords =$user->get_num_of_user();

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

        $user_result = $user->get_user_list($iDisplayStart, $real_length);


        $records = array();
        $records["data"] = array(); 

        foreach($user_result as $user_item){
            $status = $status_list[0];
            $records["data"][] = array(
                '<input class="checkboxes" type="checkbox" name="id[]" value="'.$user_item['user_id'].'"/>',
                $user_item['user_id'],
                $user_item['user_name'],
                $user_item['occupation'],
    //            $user_item['self_intro'],
                $user_item['last_login_time'],
                '<span class="label label-sm label-'.(key($status)).' idea-status">'.(current($status)).'</span>',
                '<a href="javascript:;" class="btn btn-xs red user-block"><i class="fa fa-search"></i>屏蔽用户</a>'
                . '<a href="./user_detail.php?userId='.$user_item['user_id'].'" class="btn btn-xs default user-view"><i class="fa fa-search"></i>查看</a>',
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
}
