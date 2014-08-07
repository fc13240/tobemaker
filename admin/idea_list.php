<?php



// 导航 当前页面控制
$current_page = 'idea-idea_list';
$page_level = explode('-', $current_page);

include 'view/header.php';

include 'view/leftnav.php';

include 'view/idea_list.php';

include 'view/footer.php';