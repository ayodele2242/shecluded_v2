<?php
require_once '../admins.php';



$id = $_POST['id'];
$key = rand();
$string = $id."&lastKey=".$key;





$resp = curl_get("",$global_var->base_url."/loan/get-loans-by-user?userId=".$id,"get",$global_var->getToken());

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

foreach($resp->data->loanAccounts as $loan)
{
	$acc_base = base64_encode("Loan (".$loan->loan_details->purpose.")");

	if($loan->loan_details->status == "active")
	$actionButton = "<button class=\"btn btn-sm btn-outline-success w-24 inline-block mr-1 mb-2\">active</button>";
	elseif($loan->loan_details->status == "rejected")
	$actionButton = "<button class=\"btn btn-sm btn-outline-danger w-24 inline-block mr-1 mb-2\">".$loan->loan_details->status."</button>";
	elseif($loan->loan_details->status == "completed")
	$actionButton = "<button class=\"btn btn-sm btn-outline-primary w-24 inline-block mr-1 mb-2\">".$loan->loan_details->status."</button>";
	elseif($loan->loan_details->status == "cancelled")
	$actionButton = "<button class=\"btn btn-sm btn-outline-dark w-24 inline-block mr-1 mb-2\">".$loan->loan_details->status."</button>";
	elseif($loan->loan_details->status == "pending")
	$actionButton = "<button class=\"btn btn-sm btn-outline-warning w-24 inline-block mr-1 mb-2\">".$loan->loan_details->status."</button>";
    elseif($loan->loan_details->status == "approved")
	$actionButton = "<button class=\"btn btn-sm btn-outline-info w-24 inline-block mr-1 mb-2\">".$loan->loan_details->status."</button>";
    else
	$actionButton = "";
	if(($loan->loan_details->status !== "rejected") && ($loan->loan_details->status !== "cancelled"))
	{
    //$trx = '<a target=_blank class="flex items-center mr-3" href="../clients/history?account_id='.$loan->id.'&user_id='. $id.'&bio='.base64_encode($userdetails->last_name ." ".$userdetails->first_name).'&base='.$acc_base.'"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> txn info </a>';
	$trx = "";        
	}else{
		$trx = "";
	}

    $output['data'][] = array(
		$x,
		$loan->loan_details->purpose,
		number_format($loan->loan_details->loan_amount,2),
		$loan->loan_details->interest_rate,
		$loan->loan_details->start_date,
		$loan->loan_details->end_date,
		$loan->loan_details->repayment_frequency,
		number_format($loan->amountPaid,2),
		number_format($loan->loanBalance,2),
		$actionButton,
		$trx
	);

	$x++;

}

echo json_encode($output);

}

?>