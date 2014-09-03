<?php

include_once '../config.php';
include_once '../class/class_group_auth.php';
include_once ROOT_PATH."class/class_invitation_code.php";
$code=new class_invitation_code();
//判断权限
$class_group_auth=new class_group_auth();
if(!$class_group_auth->check_auth("admin"))
  {
  $url="Location:".BASE_URL."error.php";
  header($url);
    //echo '<script>alert("对不起，您没有权限！");history.go(-1);</script>';
	//die('对不起，您没有权限！请登录或联系管理员！');
	//return;
  }
// 导航 当前页面控制
$current_page = 'invote-invote_code';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
';

$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    //TableManaged.init();
});
</script>
<script>
	$("#btn_create").click(function(){
	var $url=$("#btn_create").data(\'url\');
	$.post($url, $.param({\'action\':\'create\'}), function(data, textStatus){
                
               $("#code").text(data.code);
            },\'json\');
	});
	</script>
';


include 'view/header.php';

include 'view/leftnav.php';

include 'view/invote_code.php';

include 'view/quick_bar.php';

include 'view/footer.php';


