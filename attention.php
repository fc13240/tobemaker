<?php

include_once "config.php";
include_once ROOT_PATH."class/class_attention.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
// 导航 当前页面控制

$current_page = 'attention';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./admin/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./admin/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./admin/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
';

$page_level_script = '<script src="./admin/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./admin/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./admin/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./admin/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./admin/assets/user/pages/scripts/attention.js"></script>
<script>
jQuery(document).ready(function() {       
    //Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    //TableManaged.init();
	divManaged.init();
});
</script>
';
//判断是否登陆
$user=new class_user();
$user_session=new class_session();
if(!$user_session->check_login())
{
   echo '<script>alert("您尚未登录请登陆！");window.location.href="index.php";</script>';
}
//获取用户信息
$userid=$_SESSION["user_id"];
$userInfo=$user->select($userid);

include 'view/attention_page.php';
