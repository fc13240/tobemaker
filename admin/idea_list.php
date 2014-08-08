<?php



// 导航 当前页面控制
$current_page = 'idea-idea_list';
$page_level = explode('-', $current_page);

$page_level_style = '<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css"/>
';

$page_level_plugins = '<script type="text/javascript" src="assets/plugins/select2/select2.min.js" ></script>
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
';

$page_level_script = '<script src="assets/scripts/core/app.js"></script>
<script src="assets/scripts/custom/table-editable.js"></script>
<script>
jQuery(document).ready(function() {
   App.init();
   TableEditable.init();
});
</script>
';

include 'view/header.php';

include 'view/leftnav.php';

include 'view/idea_list.php';

include 'view/footer.php';