<?php

      include "./config.php";
      include ROOT_PATH."/class/class_idea.php";
      include ROOT_PATH."/class/class_comment.php";
      include ROOT_PATH."/class/class_file.php";

        //获取数据


      //  执行相关操作
      header("Content-type: text/html; charset=utf-8"); 
      include_once ROOT_PATH."include/ez_sql_core.php";
      include_once ROOT_PATH."include/ez_sql_mysql.php";

      static $aa=2;
      function sss()
      {
        # code...
        echo $aa;
      }

      sss();
?>
