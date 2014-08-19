<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
$class_idea=new class_idea();
$sum_of_all=null;
$current_page=null;

$res['sum_of_all']=null;
if(array_key_exists('q', $_GET)){
	$key_word=$_GET['q'];
	if(isset($sum_of_all)){
	}

	else{
		# code...
		$data=$class_idea->search_all_by_key_word($key_word);
		$sum_of_all=count($data);
	}
		$start=$_GET['start'];
		$length=$_GET['length'];
		$data=$class_idea->search_by_key_word($key_word,$start,$length);
		//var_dump($data);

		$result['sum_of_all']=$sum_of_all;
		$result['num_of_currentpage']=count($data);
		$result['data']=$data;

		echo json_encode($result);

}

?>