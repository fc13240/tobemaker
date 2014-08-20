<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
$class_idea=new class_idea();
$num_of_all=null;

if(array_key_exists('q', $_GET)){
	$key_word=$_GET['q'];

		# code...
		$data=$class_idea->search_all_by_key_word($key_word);
		$num_of_all=count($data);
		$start=$_GET['start'];
		$length=$_GET['length'];
		$data=array_slice($data,$start,$length);

		$result['num_of_all']=$num_of_all;
		$result['num_of_currentpage']=count($data);
		$result['data']=$data;
		echo json_encode($result);
}

else{
	echo "no key_word";
}

?>