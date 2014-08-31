<?php
require_once "config.php";
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");
require_once("qiniu/http.php");
require_once("class/class.smtp.php");

//require("smtp.php"); 
########################################## 
$smtpserver = MAIL_HOST;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail = MAIL_ADDRESS;//SMTP服务器的用户邮箱 
$smtpemailto = "1020378873@qq.com";//发送给谁 
$smtpuser = MAIL_USER;//SMTP服务器的用户帐号 
$smtppass = MAIL_PASS;//SMTP服务器的用户密码 
$mailsubject = "中文";//邮件主题 
$mailbody = "<h1>中文</h1>新年感";//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug = false;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 

?>

