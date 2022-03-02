<?php
include("../functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['id'] != "") {

   $id = $_POST['id'];
   $resp = curl_get("",$global_var->base_url."/loan/loan-repayments/".$id,"get",$global_var->getToken());


//print_r($resp);
if($resp->success != "true" || $resp->success == "" || $resp->message == "Error" ){
	$output =  array(
		'success' => "false", 
		'msg' => trim($resp->data->error[0])
	);;
		
	echo json_encode($output);
}else{
	$output = array('data' => array());
	$output = array('success' => "true", 'msg' => "");
	
	$x = 1;
	//$loan = $resp->data->loanAccounts->loan_details;

	


	if(!empty($resp->data->data)){
	foreach($resp->data->data as $loan)
	{
	
		if($loan->status == "pending"){
			$actionButton = '
			<a href="javascript:;" type="button" class="btn btn-warning btn-sm " >Pending</a>
			';
		}else{
			$actionButton = '
			<a href="javascript:;" type="button" class="btn btn-default btn-sm " >'.ucwords($loan->status).'</a>
			';
		}

		$output['data'][] = array(
			'id' => $x,
			'principal' => number_format($loan->principal, 2),
			'interest' => number_format($loan->interest, 2),
			'rate' => $loan->default_interest_rate,
			'date' => $loan->payment_date,
			'status' => $actionButton
		);
	
		$x++;
	
	}
}else{
	$output = array('msg' => "Empty value(s) returned from end-point for this user");
}
	
	echo json_encode($output);
} 

/*
*/
}


?>