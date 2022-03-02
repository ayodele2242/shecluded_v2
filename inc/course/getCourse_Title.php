<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/course/get-course-topics","get",$global_var->getToken());

if($resp->success != "true")
{
   
    $output = array('data' => "");

 
}else{
$output = array('data' => array());
$output = array('lastkey' => "", 'success' => true);
foreach($resp->data->data as $row)
{
	
    $img = '<img src="'.$row->thumbnail.'" width="50" height="50" />';
    $actionButton = '<a href="#" id="'.$row->id.'" data-title="'.$row->title.'" data-keywords="" data-descr="'.$row->description.'" data-img="'.$row->thumbnail.'" class="btn btn-warning btn-sm btn-float btn-round btn-float-sm editDetils"> <i class="fa fa-edit"></i></a> ';

   $output['data'][] = array(
       'img' => $img,
       'title' => $row->title,
       'descr' => $row->description,
       'btn' => $actionButton
	);

	

}

}
echo json_encode($output);
?>