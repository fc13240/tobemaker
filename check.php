<?php

require 'config.php';
require ROOT_PATH.'include/ez_sql_core.php';
include ROOT_PATH.'include/ez_sql_mysql.php';


// 鉴别身份
function checkeruser(){
	//code

};
if (checkeruser()=='root') {
	//管理控制器
	show_idea_data();
}
else{
	exit("you are not allowed to do this");
}

function show_idea_data(){
	//coding....
	// 获取数据类容
  //获取的信息有：一张表：idea管理  包括idea的
  //  ID 审核状态 审核理由 审核人姓名
  //  第二张表： idea 表  包括idea ID 名称 作者

	$sqlcon=new ezSQL_mysql("DATABASE_USER", "DATABASE_PASSWORD", "idea");
    $sqlcon->quick_connect("DATABASE_USER", "DATABASE_PASSWORD", "idea");
}
?>
