<?php
require_once "config.php";
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");

$call_back_url="http://www.baidu.com";
$bucket = BUCKET;
$accessKey = ACCESS_KEY;
$secretKey = SECRET_KEY;

Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);

$upToken = $putPolicy->Token(null);
//echo $upToken;

?>

<form method="POST" enctype="multipart/form-data" action="http://up.qiniu.com/">
    <input name="key" type="hidden" value="aaa/1234.jpg">
    <input name="token" type="hidden" value=<?php
    echo "\"".$upToken."\"";

    ?>>
    <input name="file" type="file" />
    <input type="submit" value="Upload File" />
</form>