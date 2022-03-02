<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/target-saving/get-target-saving-categories","get",$global_var->getToken());
//print_r($resp);
if($resp->success != "true")
{
    if($resp->error == "Invalid token")
    login();
     else 
    fatal_error("Enpoint Failure",$resp);
   
    $e = 1;
 
}else{
$output = array('data' => array());
$x = 1;
foreach($resp->data->targetCategories as $category)
{
    if($category->status == 'active'){
        $sta = "checked";
    }else{
        $sta = "";
    }
  
    $date=date_create($category->updatedAt);

   $btn = '<input type="checkbox" class="form-check-switch ustaDetails" '.$sta.' id="'.$category->id.'"></td>';
    $actionButton = '
	<!--<a type="button" title="Edit" id="'.$category->id.'" data-id="'.$category->id.'"  data-nname="'.ucwords($category->name).'"   data-toggle="modal" data-target="#superlarge-modal-size-preview" class="btn btn-primary btn-sm btn-float btn-round btn-float-sm userInfo" > <span class="w-4 h-4 fa fa-edit"></span></a>
	<a type="button" title="Delete" data-toggle="modal" data-target="#delete-confirmation-modal" class="btn btn-danger btn-sm" onclick="removeUser('.$category->id.')"> <i class="w-4 h-4 fa fa-trash"></i> </a>	-->    
	';
    $output['data'][] = array(
		$category->name,
		$category->description,
		date_format($date,"Y-m-d H:i:s"),
        $btn
	);

	//$x++;

}

echo json_encode($output);

}

?>