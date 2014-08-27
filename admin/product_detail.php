<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
// 导航 当前页面控制
$current_page = 'product-product_detail';
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
	$(\'#fileSelect\').fileupload({
            dataType: \'json\',
            done: function (e, data) {
                if (data.result.url == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    //$("#coverPreview").attr(\'src\', data.result.url);
                    $("#fileurl").val(data.result.url);
					$("#image").attr(\'src\', data.result.url);
                }
            },
            progress: function (e, data) {

            },
        });
});
</script>
';
//参数错误检测
if(empty($_GET["productID"])||empty($_GET["action"]))
{

echo '<script language="javascript">alter("参数传递错误！");history.go(-1);</script>';
}
//获取商品目录
$product=new class_product();
$strsql='select * from `product_category`';
$categoryList=$product->select($strsql);
$file=new class_file();
//获取商品详情
$productID=$_GET["productID"];
$strsql='select * from `product_info` where `product_info`.`pf_id`='.$productID;
$productInfo=$product->select($strsql);
//判断状态（编辑/查看）并绑定数据
if(array_key_exists('action',$_GET))
{

	//绑定数据
	$action=$_GET["action"];
	$strDisplay='';
	if($action=='view')
    $strDisplay=' disabled="disabled" ';
	
}

include 'view/header.php';

include 'view/leftnav.php';

include 'view/product_detail_page.php';

include 'view/quick_bar.php';

include 'view/footer.php';
// 表单处理
if(array_key_exists('name',$_POST))
{
if($_POST["status"]=='删除')
{
    $product->delete_product($_POST["pf_id"]);
}
else
{
$imgUrl='';
if(!empty($_POST["img_url"]))
  $imgUrl=$file->save($_POST["img_url"]);
  if(!empty($imgUrl))
  $arr=array("pf_name"=>$_POST["name"],"pf_image"=>$imgUrl,"pf_link"=>$_POST["link"],
             "pf_label"=>$_POST["label"],"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			 "pf_status"=>$_POST["status"]);
  else
  $arr=array("pf_name"=>$_POST["name"],"pf_link"=>$_POST["link"],
             "pf_label"=>$_POST["label"],"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			 "pf_status"=>$_POST["status"]);
  $result=$product->update_product($_POST["pf_id"],$arr);
  
  //成功信息
}
}