<?php

require_once '../config.php';

// 引用与实例化示例 start
require_once ROOT_PATH.'class/class_ad.php';

$a = new class_ad();
// 引用示例与声明示例 end


// 导航 当前页面控制
$current_page = 'dashboard';
$page_level = explode('-', $current_page);

$page_level_style = '';

$page_level_plugins = '
<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>';

$page_level_script = '<script>
      jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
      });
   </script>';

include 'view/header.php';

include 'view/leftnav.php';

include 'view/dashboard.php';

include 'view/quick_bar.php';

include 'view/footer.php';