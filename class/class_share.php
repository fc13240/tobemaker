<?php
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_sysinfo.php";
include_once ROOT_PATH."phpqrcode/phpqrcode.php";
/*******
分享类
主要功能：
1，创建，获取分享记录

********************/

class class_share
{
    private $db = null;

    function class_share(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
    }
    public function add_share(){

    }
    //获取分享信息，传入查看的idea_ id,有结果输出结果，没有结果返回0
    public function get_share_info_by_id($idea_id){

    	$sql="SELECT * FROM idea_share where idea_id=".$idea_id." order by share_time desc";
    	$result=$this->db->get_results($sql,ARRAY_A);
    	if(count($result)>0){
    		return $return;
    	}
    	else{
    		return 0;
    	}
    }



    //  微信分享生成二维码 返回二维码路径
    public function get_share_qrcode(){
    //获取完整的url
    	$url='http://'.$_SERVER['HTTP_HOST'].'handle_share.php?url=http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

    	$errorCorrectionLevel = "L";
    	$matrixPointSize = "4";
    	$filename = $errorCorrectionLevel.'|'.$matrixPointSize.'.png';
    	QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize);
    	return $filename;
    }


    public function share_by_wechat($idea_id,$user_id){
    	// 第一步，取得idea_id 对应的想法名称
    	$sql_query="select * from idea_info where idea_id=".$idea_id;
    	$result=$this->db->get_results($sql_query,ARRAY_A);
    	$idea_name=$result[0]["name"];
    	//第二步 ，更新idea_share  信息
    	$sql="INSERT into idea_share(`share_id`,`idea_id`,`idea_name`,`share_user_id`,`share_time`,`share_method`) values('',".$idea_id.",".$idea_name.",".$user_id.",now(),'wechat')";
    	$this->db->query($sql);
    	$sql="UPDATE idea_info set sum_share=sum_share+1 where idea_id=".$idea_id;
    	$this->db->query($sql);
    }
    //微博分享修改数据
    public function share_by_weibo($idea_id,$user_id){

    	//
    	$sql_query="select * from idea_info where idea_id=".$idea_id;
    	$result=$this->db->get_results($sql_query,ARRAY_A);
    	$idea_name=$result[0]["name"];
    	//第二步 ，更新idea_share  信息
    	$sql="INSERT into idea_share(`share_id`,`idea_id`,`idea_name`,`share_user_id`,`share_time`,`share_method`) values('',".$idea_id.",".$idea_name.",".$user_id.",now(),'weibo')";
    	$this->db->query($sql);
    	$sql="UPDATE idea_info set sum_share=sum_share+1 where idea_id=".$idea_id;
    	$this->db->query($sql);
    }
}