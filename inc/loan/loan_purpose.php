<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/loan/loan-purposes","get",$global_var->getToken());
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
foreach($resp->data->loanPurposes as $purpose)
{
    if($purpose->status == 'active'){
        $sta = "checked";
    }else{
        $sta = "";
    }
  
    $cdate=date_create($purpose->createdAt);
    $udate=date_create($purpose->updatedAt);

   $btn = '<input type="checkbox" class="form-check-switch ustaDetails" '.$sta.' id="'.$purpose->id.'"></td>';
    $actionButton = '
	<a type="button" title="Edit" id="'.$purpose->id.'" data-id="'.$purpose->id.'"  data-name="'.$purpose->name.'" data-rate="'.$purpose->interest_rate.'"  data-descr="'.$purpose->description.'"   data-toggle="modal" data-target="#superlarge-modal-size-preview" class="btn btn-primary btn-sm btn-float btn-round btn-float-sm updateInfo" > <span class="w-4 h-4 fa fa-edit"></span></a>
	<!--<a type="button" title="Delete" data-toggle="modal" data-target="#delete-confirmation-modal" class="btn btn-danger btn-sm" onclick="removeUser('.$purpose->id.')"> <i class="w-4 h-4 fa fa-trash"></i> </a>	-->    
	';
    $output['data'][] = array(
		$purpose->name,
		$purpose->description,
        $purpose->interest_rate,
		date_format($cdate,"Y-m-d H:i:s"),
        date_format($udate,"Y-m-d H:i:s"),
        $btn,
        $actionButton
	);

	//$x++;

}

echo json_encode($output);

}

?>