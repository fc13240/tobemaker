<?php



// 导航 当前页面控制
$current_page = 'idea-idea_recommend';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>

';

$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/idea_detail.js"></script>
<script>
jQuery(document).ready(function() {       
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    FormWizard.init();
});
</script>
';
include_once '../config.php';
include_once ROOT_PATH.'class/class_idea.php';
$class_idea=new class_idea();


if(array_key_exists('change_recommend', $_POST)){
$num_of_change=count($_POST)-1;
$keys=array_keys($_POST);
$change_recommend=array_values($_POST);
	$i=0;
	while ($i<$num_of_change) {
		# code...
		$idea_id=$keys[$i];
		$change=$change_recommend[$i];
		//echo $change;

		$sql="UPDATE `idea_info` SET `is_recommend`=".$change." where idea_id=".$idea_id;
		//echo $sql;
		$class_idea->db->query($sql);
		$i++;
		
	}
}

$sql='SELECT * from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_info`.`is_recommend`>0 order by `idea_info`.`is_recommend` desc';
$item_list=$class_idea->select($sql);
$num=count($item_list);



include 'view/header.php';

include 'view/leftnav.php';

include 'view/idea_recommend.php';

include 'view/quick_bar.php';

include 'view/footer.php';