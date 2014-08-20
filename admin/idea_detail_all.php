<?php

include_once '../config.php';
include_once ROOT_PATH.'class/class_idea.php';
//include_once ROOT_PATH.'';
header("Content-Type: text/html; charset=utf-8");
// 获取数据开始
$idea=new class_idea();
//如果是修改请求
if(isset($_POST["idea_id"]))
{
	$id=$_POST["idea_id"];
	$arr=$_POST;
	//var_dump($arr);
	$idea->update_idea($id,$arr);
	$url="Location:".HOSTNAME."/admin/idea_detail_all.php?idea_id=".$id;
	header($url);
	exit();
}


//如果是请求数据
elseif(isset($_GET["idea_id"]))
{
	$idea_id=$_GET["idea_id"];
	$idea_list=$idea->get_idea_by_id($idea_id);
	//var_dump($idea_list);
}

else{
	echo "error";
	exit();
}
//
// 导航 当前页面控制
$current_page = 'idea-idea_detail_all';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
';

$page_level_script = '
<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/admin/pages/scripts/form-samples.js"></script>
<script>
jQuery(document).ready(function() {    
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
   FormSamples.init();
});
</script>

';

include 'view/header.php';

include 'view/leftnav.php';

include 'view/idea_detail_all.php';

include 'view/quick_bar.php';

include 'view/footer.php';