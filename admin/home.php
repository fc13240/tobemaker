<?php

require_once '../config.php';

// 引用与实例化示例 start
require_once ROOT_PATH.'class/class_ad.php';

$a = new class_ad();
// 引用示例与声明示例 end


// 导航 当前页面控制
$current_page = 'dashboard';
$page_level = explode('-', $current_page);

include 'view/header.php';

include 'view/leftnav.php';

include 'view/dashboard.php';

include 'view/footer.php';