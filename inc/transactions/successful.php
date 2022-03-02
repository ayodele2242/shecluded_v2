<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/incoming-transaction/get-transactions?status=successful","get",$global_var->getToken());

if(empty($resp))
{
	header("../admin/logout");
}else if($resp->success != "true"){

	$output = array('success' => false, 'lastkey' => "" );
 

}else{
$output = array('data' => array());
$output = array('success' => true);
$x = 1;
$json = [];

foreach($resp->data->transactions as $txn)
{
 

    $actionButton = '<a type="button" id="'.$txn->transaction_ref.'" title="Details"  class="btn btn-primary btn-sm btn-float btn-round btn-float-sm detail mr-1" > <span class="w-4 h-4 fa fa-search"></span></a>';

        if(!empty($txn->narration)){
            $trx = $txn->narration; 
        }else{
            $trx = "";
        }

		$newDate = date("Y-m-d H:i:s", strtotime($txn->createdAt));



    $output['data'][] = array(
		'ref' => $txn->transaction_ref,
		'amount' => number_format($txn->amount,2),
		'narration' => $trx,
		'date' => $newDate,
		'btn' => $actionButton
	);

	$x++;

}

echo json_encode($output);

}

?>