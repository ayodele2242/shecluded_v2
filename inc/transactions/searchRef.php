<?php
include("../functions.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['keyword'] != "") {

   $ref = $_POST['keyword'];
   $resp = curl_get("",$global_var->base_url."/incoming-transaction/get-transaction-details/".$ref,"get",$global_var->getToken());


//print_r($resp);
if($resp->success != "true" || $resp->success != 1){
	$output = array('data' => array());
	$output = array('nouser' => "");
	
	$output['data'] = array(
		'success' => "empty"
	);


	echo json_encode($output);
}else{
	$output = array('data' => array());
	$output = array('nouser' => "available");

    $user = $resp->data->user;
    $tnx = $resp->data->transaction;
    $card = $resp->data->card;

    //getting destination details . 
    $destn = curl_get("",$global_var->base_url."/account/account-details/".$tnx->destination,"get",$global_var->getToken());
    if($destn->success != "true")
    {
        $desn_name = "not found";
    }else {
        $desn_name = $destn->data->account->account_name ." (".$destn->data->account->account_no.")";

    }

    if($tnx->status == "successful"){
        $btn = "<button class=\"btn btn-rounded btn-success-soft w-24 mr-1 mb-2\">successful</button>";
    }else {
        $btn =  "<button class=\"btn btn-rounded btn-warning-soft w-24 mr-1 mb-2\">".$tnx->status."</button>";
    }
	
    $name = '<a href="#"  id="'.$user->id.'" data-name="'.$user->last_name." ". $user->first_name.'"  data-toggle="modal" data-target="#userModal" class="userInfo"><b>"'.$user->last_name." ". $user->first_name.'"</b></a>';

	
		$output['data'] = array(
			'name' => $name,
			'amount' => number_format($tnx->amount,2),
			'narration' => $tnx->narration,
			'status' => $btn,
			'date' => $tnx->updatedAt,
			'dest' => $desn_name
		);
	
		
	
	
	
	echo json_encode($output);
}

/*
*/
}


?>