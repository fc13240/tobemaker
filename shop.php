<?php

include_once "config.php";
include_once ROOT_PATH."class/class_product.php";
// 导航 当前页面控制
$current_page = 'shop';
$page_level = explode('-', $current_page);
// 获取商品目录
$strsql='select * from `product_category` ';
$category=empty($_POST["categoryID"])?0:$_POST["categoryID"];
$product=new class_product();
$categoryList=$product->select($strsql);

// 按目录抓取数据库商品信息

if(empty($category))
{
$strsql='select * from `product_info` where `product_info`.`pc_id`='.$categoryList[0]["pc_id"].'';
}
else
{
$strsql='select * from `product_info` where `product_info`.`pc_id`='.$category.'';
}
$productList=$product->select($strsql);



include 'view/shop_page.php';
