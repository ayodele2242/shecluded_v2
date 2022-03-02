<?php
require_once '../admins.php';


$global_var = new global_var(getenv('APP_ENV'),getenv('ENC_KEY'));
$id = $_POST['id'];
$key = rand();
$string = $id."&lastKey=".$key;


$uresp = curl_get("",$global_var->base_url."/user/get-user-details/".$id,"get",$global_var->getToken());
$userdetails = $uresp->data->userDetails;

$resp = curl_get("",$global_var->base_url."/insurance/get-insurance-purchase-by-user/".$id,"get",$global_var->getToken());

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

foreach($resp->data->insurance_purchases as $insurance)
{
	           if($insurance->status == "active")
                {
                    $actionButton = '
                    <button class="btn btn-sm btn-success w-24 inline-block mr-1 mb-2">active</button>
                <a href="../insure/manual?user='.$id.'&package_id='.$insurance->id.'&meta="'.base64_encode($insurance->amount_left.'+'.$insurance->insurancePlan->name.'+'.$userdetails->last_name .' '.$userdetails->first_name).'><button class="btn btn-sm btn-outline-primary w-24 inline-block mr-1 mb-2">Post Payment</button>';
                
                }
                 elseif($insurance->status == "completed")
                 $actionButton = '<button class="btn btn-sm btn-outline-dark w-24 inline-block mr-1 mb-2">completed</button>';
                 else
                 $actionButton = '<button class="btn btn-sm btn-outline-danger w-24 inline-block mr-1 mb-2">"'.$insurance->status.'"</button>';
                 


    $output['data'][] = array(
		$x,
		$insurance->insurance->name,
		$insurance->insurancePlan->name,
		number_format($insurance->amount_paid,2),
		number_format($insurance->insurance->amount,2),
		number_format($insurance->amount_left,2),
		$insurance->createdAt,
		$insurance->updatedAt,
		$actionButton
	);

	$x++;

}

echo json_encode($output);

}

?>