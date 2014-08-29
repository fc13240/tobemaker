<?php
require_once "config.php";
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");
require_once("qiniu/http.php");

$call_back_url="http://www.baidu.com";
$bucket = BUCKET;
$accessKey = ACCESS_KEY;
$secretKey = SECRET_KEY;


//$upToken = $putPolicy->Token(null);
//echo $upToken;


$key1 = "1234.png";
$key = "file_name1";


Qiniu_SetKeys($accessKey, $secretKey);
$client = new Qiniu_MacHttpClient(null);

$err = Qiniu_RS_Copy($client, $bucket, $key, $bucket, $key1);
echo "====> Qiniu_RS_Move result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    echo "Success!";
}

?>

