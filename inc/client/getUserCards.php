<?php
require_once '../admins.php';

$id = $_POST['id'];
$key = rand();
$string = $id."&lastKey=".$key;

$uresp = curl_get("",$global_var->base_url."/user/get-user-details/".$id,"get",$global_var->getToken());
$userdetails = $uresp->data->userDetails;

$resp = curl_get("",$global_var->base_url."/card/user-cards/".$id,"get",$global_var->getToken());

if($resp->success == true)
{
   

$output = array('data' => array());
$x = 1;

foreach($resp->data->cards as $card)
{

    $card_info = curl_get("",$global_var->base_url."/card/get-card-details/".$card->id,"get",$global_var->getToken());
    if($card_info->data->card->status == "active"){
    $actionButton = '<a href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal-"'.$card->id.'"><button class="btn btn-sm btn-outline-success w-24 inline-block mr-1 mb-2">active</button></a>';
    }else{
        $actionButton = '<a href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal-"'.$card->id.'"><button class="btn btn-sm btn-outline-danger w-24 inline-block mr-1 mb-2">disabled</button></a>';
   
    //$actionButton '<a href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#delete-confirmation-modal-"'.$card->id.'\"><button class=\"btn btn-sm btn-outline-danger w-24 inline-block mr-1 mb-2\">disabled</button></a>';
    }        

    $output['data'][] = array(
		$x,
		$card->first_six_digit."******".$card->last_four_digit,
		$card->card_type,
		$card->expiry_date,
		$actionButton
	);

	$x++;

}

echo json_encode($output);

}

?>