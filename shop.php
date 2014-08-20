<?php

include_once "config.php";
include_once ROOT_PATH."class/class_product.php";

// 导航 当前页面控制
$current_page = 'shop';
$page_level = explode('-', $current_page);
// 获取商品目录
$strsql='select * from `product_category` ';
$category=empty($_GET["categoryID"])?0:$_GET["categoryID"];
$product=new class_product();
$categoryList=$product->select($strsql);

// 按目录抓取数据库商品信息

if(empty($category))
{
$strsql='select * from `product_info` where `product_info`.`pc_id`='.$categoryList[0]["pc_id"].' ';
$category=$categoryList[0]["pc_id"];
}
else
{
$strsql='select * from `product_info` where `product_info`.`pc_id`='.$category.' ';
}
//$strsql=$strsql.' order by `product_info`.`pf_id` '
$productList=$product->select($strsql);
//设置页面数量
$perPageCount=6;

$curPage=empty($_GET["curPage"])?1:$_GET["curPage"];


include 'view/shop_page.php';
