<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/account/get-account-by-account-type?accountType=loan","get",$global_var->getToken());

if($resp->success != "true")
{
	$output = array('success' => 'failed');
 
}else{
$output = array('data' => array());
$x = 1;

$repay = array('schedule' => array());

$array = json_decode(json_encode($resp->data->accounts), true);



foreach($array as $loan)
{
$userid = $loan['user_id'];
$loan_details = $loan['loan_details'];
$repayment_schedule = $loan_details['repayment_schedule'];




/*if(!empty($loan_details['repayments'])){
 
	//$stuff = array('principal' => 'Joe', 'email' => 'joe@example.com');

	foreach($loan_details['repayments'] as $pay){
		$output['schedule'][] = array(
		'principal' => $pay['principal'],
		'default_interest_rate' => $pay['default_interest_rate'],
		'interest' => $pay['interest'],
		'payment_date' => $pay['payment_date'],
		'status' => $pay['status'],
		);
	}
}else{
	$output['schedule'] = array(
		'principal' => "",
		'default_interest_rate' => "",
		'interest' => "",
		'payment_date' => "",
		'status' => "",
		);
	
}*/



$resps = curl_get("",$global_var->base_url."/user/get-user-details/$userid","get",$global_var->getToken());
$name = $resps->data->userDetails;

    if($loan_details['status'] == "active"){
	$actionButton = '
	<button class="btn btn-sm btn-outline-success  mr-1 ">active</button>
	<a href="javascript:;" id="'.$loan['id'].'" data-uid="'.$userid.'" data-amount="'.number_format($loan_details['loan_amount'],2).'" data-array=""  data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="Loan Payment Schedule" data-toggle="modal" data-target="#detail-Modal" class="btn btn-sm loandetails" style="background: #0D47A1; color: #fff;" >DETAILS</a>
	';
	
	}else if($loan_details['status'] == "rejected"){
	$actionButton = "<button class=\"btn btn-sm btn-danger  mr-1 \">".$loan_details['status']."</button>";
	}else if($loan_details['status'] == "approved"){
        $actionButton = "<button class=\"btn btn-sm btn-outline-success  mr-1 \">".$loan_details['status']."</button>";
        }else if($loan_details['status'] == "completed"){
	$actionButton = "<button class=\"btn btn-sm btn-success  mr-1 \">".$loan_details['status']."</button>";
	}elseif($loan_details['status'] == "cancelled"){
	$actionButton = "<button class=\"btn btn-sm btn-dark  mr-1 \">".$loan_details['status']."</button>";
	}elseif($loan_details['status'] == "pending"){
	$actionButton = '
	<a href="javascript:;"  id="'.$loan['id'].'" data-interest="'.$repayment_schedule['interest'].'" data-principal="'.$repayment_schedule['principal'].'" data-amount="'.$loan_details['loan_amount'].'" data-frequency="'.$loan_details['repayment_frequency'].'" data-rate="'.$loan_details['interest_rate'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="Pre-Approve Loan" data-toggle="modal" data-target="#preapprovepModal" class="btn btn-primary btn-sm pre_approve" >PRE-APPROVE</a>
	<a href="javascript:;"  id="'.$userid.'" data-uid="'.$userid.'"  data-amount="'.$loan_details['loan_amount'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="USer Info" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm userInfo mr-1 ml-1" >USER INFO</a>
	<a href="javascript:;"  id="'.$loan['id'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="'.$name->last_name .' '.$name->first_name.' Details" data-toggle="modal" data-target="#reject-Modal" class="btn btn-danger btn-sm rejectIt" > REJECT</a>
	';
	}elseif($loan_details['status'] == "pre-approved"){
		$actionButton = '
		<a href="javascript:;" id="'.$loan['id'].'"  data-amount="'.$loan_details['loan_amount'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="Approve Loan" data-toggle="modal" data-target="#approve-Modal" class="btn btn-warning btn-sm approveMe" >APPROVE</a>
		<!--<a href="javascript:;" id="'.$userid.'" data-uid="'.$userid.'"  data-amount="'.$loan_details['loan_amount'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="USer Info" data-toggle="modal" data-target="#userModal" class="btn btn-primary btn-sm userInfo" >USER INFO</a>	-->
		';
	}elseif($loan_details['status'] == "accepted-offer"){
		$actionButton = '
		<a href="javascript:;" id="'.$loan['id'].'" data-amount="'.$loan_details['loan_amount'].'" data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="Disburse Loan" data-toggle="modal" data-target="#disburse-Modal" class="btn btn-sm disburseMe mr-1" style="background: #4A148C; color: #fff;" >DISBURSE</a>
		<!--<a href="javascript:;" id="'.$loan['id'].'" data-uid="'.$userid.'" data-array=""  data-name="'.ucwords($name->last_name .' '.$name->first_name).'" title="Loan Payment Schedule" data-toggle="modal" data-target="#detail-Modal" class="btn btn-sm loandetails" style="background: #0D47A1; color: #fff;" >DETAILS</a>-->
		';
	}else{
		$actionButton = "";
	}
	/*if(($loan_details['status'] !== "rejected") && ($loan_details['status'] !== "cancelled"))
	{
   // $trx = '<a target=_blank class="flex items-center mr-3" href="../clients/history?account_id='.$loan['id'].'&user_id='. $id.'&bio='.base64_encode($userdetails->last_name ." ".$userdetails->first_name).'&base='.$acc_base.'"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> txn info </a>';
                   
	}else{
		$trx = "";
	}*/

$img = '<a href="'.$loan_details['bank_statement'].'" target="_blank"><i class="fa fa-file-pdf" style="font-size:36px;color:red"></i></a>';

if(!empty($loan_details['approved_amount'])){
	$appro = number_format($loan_details['approved_amount'],2);
}else{
	$appro = "";
}

   $output['data'][] = array(
		$actionButton,
		$name->last_name,
		$name->first_name,
		number_format($loan_details['loan_amount'],2),
		$appro,
		$loan_details['interest_rate'],
		$loan_details['repayment_frequency'],
		$loan_details['tenor'],
		number_format($repayment_schedule['principal'],2),
		number_format($repayment_schedule['interest'],2),
		$loan_details['start_date'],
		$repayment_schedule['repayment_date'],
		$img,
		ucwords($loan_details['status'])
		
	);

	

}

}

echo json_encode($output);
?>