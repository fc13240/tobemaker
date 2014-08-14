<?php

include 'config.php';

// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);


include 'view/share_page.php';
