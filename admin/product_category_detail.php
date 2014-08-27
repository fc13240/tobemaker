<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
// 导航 当前页面控制
$current_page = 'product-product_category_detail';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
';

$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/product_list.js"></script>
   <script src="./assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
<script src="./assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	
});
</script>
';
//参数错误检测
if(empty($_GET["productID"])||empty($_GET["action"]))
{

echo '<script language="javascript">alert("参数传递错误！");history.go(-1);</script>';
}
//获取商品目录
$product=new class_product();

$category=$product->get_category_by_id($_GET["productID"]);




	//绑定数据
	$action=$_GET["action"];
	$strDisplay='';
	if($action=='view')
    $strDisplay=' disabled="disabled" ';
	

// 表单处理
if(array_key_exists('name',$_POST))
{
//下线处理验证】
$isContain=null;
 if($_POST["status"]=='下线'||$_POST["status"]=='删除')
 {
  $strsql='select * from `product_info` where `pc_id`='.$_POST["pc_id"];
  $isContain=$product->select($strsql);
 }
 if(!$isContain)
 {
 if($_POST["status"]=='删除')
{
    $product->delete_category($_POST["pc_id"]);
}
else
{
  $arr=array("pc_name"=>$_POST["name"],"pc_id"=>$_POST["pc_id"],"pc_status"=>$_POST["status"]);
  
  $result=$product->update_category($_POST["pc_id"],$arr);
  
}
  }
  else
  {
  //提示目录下含有商品
  echo '<script type="text/javascript"> alert("目录下含有商品，不能执行删除和下线操作")</script>';
  }
  
  //成功信息
}
include 'view/header.php';

include 'view/leftnav.php';

include 'view/product_category_detail_page.php';

include 'view/quick_bar.php';

include 'view/footer.php';