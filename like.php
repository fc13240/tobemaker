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
      $file_instance = new class_file();
      $url="http://www.cc.com/tmp/6e2ff003b54437.jpg";
      $file_instance->save($url);

      //$db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
      //$db->query("SET NAMES 'utf8'");
    //  $sql_query="SELECT `idea_comment`.`id`,`idea_comment`.`context`,`idea_comment`.`comment_time`,`idea_comment`.`sender_id`,`idea_comment`.`receiver_id`,`idea_info`.`name`,`user_info`.`user_name` from `idea_comment`,`idea_info`,`user_info` where `idea_comment`.`idea_id`=`idea_info`.`idea_id` and `idea_comment`.`sender_id`=`user_info`.`user_id` and `idea_comment`.`idea_id`=1 order by `idea_comment`.`comment_time` desc";
    //  $res=$db->get_results($sql_query);
      //$db->vardump($res);
      /*$i=2;
      while ($i<20) {
            $cont="不是沙发".$i;
            # code...
            $ii=$i+3;
             $ins="INSERT into idea_comment(`idea_id`,`context`,`comment_time`,`sender_id`) values (2,\"".$cont."\",now(),".$ii.")";
             echo $ins;
             echo "<br/>";
             $db->query($ins);
             $i++;
      }
      
      $idea_id=3;
      $arry=array(
        "kk"=>"ff",
        "iiii"=>"asfads"
        );
      $idea=new class_idea();
      $idea->update_idea($idea_id,$arry);
      */


?>
