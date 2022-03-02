<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/course/get-course-categories","get",$global_var->getToken());

if($resp->success != "true")
{
   
    $output = array('data' => "");

 
}else{
$output = array('data' => array());
$output = array('lastkey' => "", 'success' => true);
foreach($resp->data->data as $row)
{

  if($row->status == 'active'){
    $sta = "checked";
  }else{
      $sta = "";
  }

     $switch = '
     <label for="checkbox">
     <input type="checkbox" id="'.$row->id.'" class="ustaDetails switchery" '.$sta.'/>
     </label>';
   
     $actionButton = '
     <a href="#" id="'.$row->id.'" data-topicId="'.$row->topic_id.'" data-name="'.$row->name.'"   class="btn btn-warning btn-sm btn-float btn-round btn-float-sm mr-1 editDetils"> <i class="fa fa-edit"></i></a>
     <!--<a href="#" data-toggle="modal" data-target="#deleteModal" id="'.$row->id.'"  data-name="'.$row->name.'" class="btn btn-danger btn-sm btn-circle delMe waves-effect waves-light bg-red z-depth-4 btn-small mr-1" data-placement="left" title="" data-original-title="Delete" data-toggle="tooltip">
     <i class="fa fa-trash col-white"></i></a> -->
     ';

   $output['data'][] = array(
      
		'name'   => $row->name,
    'status' => $switch,
		'btn'    => $actionButton
    

	);

	

}

}
echo json_encode($output);
?>