<?php
require 'config.php';
include_once 'class/class_showsql.php';
header("Content-Type: text/html; charset=utf-8");
// 鉴别身份
function checkeruser($username="",$passcode=""){
	//code
	if(user_manager::check_user_login()){
		$group=$_SESSION['group'];
		if($group=='admin'){
			show_idea_data();
		}
		elseif ($group='formal_user') {
			# code...
			header("other");
		}
	}
	else{
		header("error_log");
	}
}

function show_idea_data(){
	
	$sqlcon=mysql_connect("localhost","root", "123456");
    mysql_query("SET NAMES 'utf8'"); 
    if(!$sqlcon){
        die('connect error');
    }
	mysql_select_db("idea");
   /* $sqlquery="SELECT * FROM idea_manage,idea_status where status_ID=idea_status"; 
    $result=mysql_query($sqlquery,$sqlcon);
    while($row = mysql_fetch_array($result)){
    	echo $row['status_name'].$row['status_ID']."<br/>";
    }*/
    $PAGE_SIZE=10;            //设置每页显示的数目
    
    ///////////////////////////////////////////////////////////////////////

    $pageSupport = new PageSupport($PAGE_SIZE); //实例化PageSupport对象
    
    $current_page="";//分页当前页数
    
    if (isset($current_page)) {
        
        $pageSupport->__set("current_page",$current_page);
        
    } else {
        
        $pageSupport->__set("current_page",1);
        
    }

    
    $pageSupport->__set("sql","SELECT `info`.`name`, `st`.`status_name`, `manage`.`idea_ID` FROM `idea_manage` as `manage`, `idea_info` as `info`, `idea_status` as `st` where `manage`.`idea_status` = `st`.`status_ID` and `manage`.`idea_ID` = `info`.`idea_ID`");     
    $pageSupport->read_data();//读数据
    echo $pageSupport->sql;
    
    if ($pageSupport->current_records > 0) //如果数据不为空，则组装数据
    {
        for ($i=0; $i<$pageSupport->current_records; $i++)
        {
            $title = $pageSupport->result[$i]["name"];
            $content= $pageSupport->result[$i]["status_name"];
            
            $part=substr($content,0,400);
            //循环输出每条数据
            echo '<div class="index_side">        
                <div class="index_title">'.$title.'</div>
                <div class="index_content">'.$part.'</div>
                <div class="index_button">
                   <a href="#">update</a>&nbsp;&nbsp;&nbsp;<a href="#">delet</a>
                </div>
            </div>';
               }
    }
    $pageSupport->standard_navigate(); //调用类里面的这个函数，显示出分页HTML
    //关闭数据库
    mysql_close($con);
}
show_idea_data();
?>


