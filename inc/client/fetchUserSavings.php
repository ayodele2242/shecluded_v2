<?php
require_once '../admins.php';





$id = $_POST['id'];

$sresp = curl_get("",$global_var->base_url."/group-saving/get-group-saving-details/Travelling/".$id,"get",$global_var->getToken());


$groupDetails = $sresp->data->groupData->groupDetails;
  

//print_r($sresp);

if($sresp->success != "true" || $sresp->success == "")
{


}else{
$x=1;
$output = array('data' => array());



foreach($sresp->data->groupData->members as $details){

    $topSavers = $details->topSavers; 
    $group = $details->groupSavingsAccount;   

    $targetSaving = $group->target_savings;

    print_r($targetSaving);



    /*if($details->status == "active")  { 
        $btn1 = '<button class="btn btn-elevated-success w-24 mr-1 mb-2">Active</button>'; 
    }else { 
        $btn1 = '<button class="btn btn-elevated-danger w-24 mr-1 mb-2">Inactive</button>'; 
    } 

    $output['data'][] = array(
		$x,
        $details->savings_category,
		$details->account_name,
		number_format($details->target_amount),
        $details->description,
        $details->start_date,
        $details->end_date,
		$btn1
	);*/

	$x++;



}

}


?>