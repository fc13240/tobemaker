<?php
      function getip(){
      	if(getenv('HTTP_CLIENT_IP')) { 
      		$onlineip = getenv('HTTP_CLIENT_IP');
      	} 
      	elseif(getenv('HTTP_X_FORWARDED_FOR')) { 
      		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
      	} elseif(getenv('REMOTE_ADDR')) { 
      		$onlineip = getenv('REMOTE_ADDR');
      	} else { 
      		$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
      	}
      	return $onlineip;
      }

/*
 *判断是否点过赞，并且修改数据库信息
 *
 */
function add_like(){
      //获取相关信息
      $user_ip='\''.getip().'\''; 
      $idea_id=$_GET["idea_id"];
      $user=$_GET["user_id"];


      //  执行相关操作
      $sqlcon=mysql_connect('127.0.0.1','root','123456');
      mysql_select_db('idea',$sqlcon);
      $sql_query="select * from idea_like where idea_id=".$idea_id." and likefrom_id=".$user.' and like_from_ip='.$user_ip;
      $result=mysql_query($sql_query);
      echo $sql_query;
      echo mysql_num_rows($result);

      if(mysql_num_rows($result)>0){
      	echo "yizhan";  //存在记录  显示已赞
      }
      else{
      //  写入两条记录，一条idea_info赞树加1 
      //  一条idea_写入日志
      	$sql_query='update idea_info set like_count=like_count+1 where idea_id='.$idea_id;
      	mysql_query($sql_query);
      	$sql_query='insert into idea_like values('.$idea_id.' ,'.$user.' ,'.$user_ip.')';
      	mysql_query($sql_query);
      	echo "okk";

      }
}
/*
 *
 *写入评论记录
 *
 *
 *
 */
function get_comment_by_id($idea_id){
            $sqlcon=mysql_connect('127.0.0.1','root','123456');
            mysql_select_db('idea',$sqlcon);
            $sql_query="select * from idea_comment where idea_id=".$idea_id;
            $result=mysql_query($sql_query);
            if(mysql_num_rows($result)>0){
                  $num_comment=mysql_num_rows($result);
                  while ($rows=mysql_fetch_array($result)){
                      # code...
                      echo $rows['comment']." by  ".$row['user_name'];
                        
                  }
            }
            else{
                  echo "no result";
            }
      }

?>
