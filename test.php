<?php
include_once "config.php";
include_once "class/class_qiniu.php";
$qiniu= new class_qiniu();
$token=$qiniu->get_token_to_upload_idea();

$qiniu->mv('1234.png','233.png');

?>
<form method="post" action="http://up.qiniu.com/"
 enctype="multipart/form-data">
  <input name="token" type="hidden" value=<?php
echo "\"".$token."\"";
  ?>>
  <input name="file" type="file" />
  <input name="submit" type="submit" />
</form>


