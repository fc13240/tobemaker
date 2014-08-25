<?php

include_once "config.php";

// 导航 当前页面控制
$current_page = 'person';
$page_level = explode('-', $current_page);


include 'view/person_page.php';
