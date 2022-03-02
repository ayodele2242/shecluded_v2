<?php
include("../functions.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['keyword'] != "") {

   $keyword = $_POST['keyword'];
   $resp = curl_get("",$global_var->base_url."/user/get-user-by-email/".$keyword,"get",$global_var->getToken());


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
	
	$x = 1;

	//print_r($resp->data->user);

//$user = $resp->data->user;


//$userEmployment = $resp->data->userDetails->employment_details;
	
	foreach($resp->data as $user)
	{
		$details = $user->user_details;
		$myDateTime = date_create($details->date_of_birth);
		$dob = date_format($myDateTime, 'Y-m-d');
	
		
		
		$actionButton = '
		<a type="button" id="'.$user->id.'" data-name="'.ucwords($user->last_name .' '.$user->first_name).'" title="Top Up"  class="btn btn-primary btn-sm btn-float btn-round btn-float-sm topUp mr-1" > <span class="w-4 h-4 fa fa-credit-card"></span></a>
		<a type="button" id="'.$user->id.'" data-name="'.ucwords($user->last_name .' '.$user->first_name).'" title="'.$user->last_name .' '.$user->first_name.' Details"  class="btn btn-default btn-float btn-round btn-sm userInfo" > <span class="w-4 h-4 fa fa-search"></span></a>
		<a type="button" title="Edit" id="'.$user->id.'" data-id="'.$user->id.'" data-lname="'.ucwords($user->last_name).'" data-fname="'.ucwords($user->first_name).'" data-phone="'.ucwords($user->phone_no).'" data-dob="'.$dob.'"  class="btn btn-warning btn-float btn-round btn-sm edituserInfo ml-1" > <span class="w-4 h-4 fa fa-edit"></span></a>
		';
	
		
	
	
	
		$output['data'][] = array(
			'last_name' => $user->last_name,
			'first_name' => $user->first_name,
			'email' => $user->email,
			'phone' => $user->phone_no,
			'dob' => $dob,
			'btn' => $actionButton
		);
	
		$x++;
	
	}
	
	echo json_encode($output);
}

/*
*/
}


?>