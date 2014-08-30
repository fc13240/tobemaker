<?php
require_once "config.php";
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");
require_once("qiniu/http.php");
require_once("class/class.smtp.php");

$smtp= new SMTP();
$host='smtp.163.com';

$aa=$smtp->Connect($host);
if($aa){
	echo "aa";
}
else {
	# code...
	echo "not";
}

?>

