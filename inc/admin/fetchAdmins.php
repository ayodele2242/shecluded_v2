<?php
include("../functions.php");


$resp = curl_get("",$global_var->base_url."/user/fetch-admins","get",$global_var->getToken());
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
foreach($resp->data->admins as $admin)
{
    if($admin->status == 'active'){
        $sta = "checked";
    }else{
        $sta = "";
    }


   $btn = '<input type="checkbox" class="form-check-switch ustaDetails" '.$sta.' id="'.$admin->id.'"></td>';
    $actionButton = '
	<a type="button" title="Edit" id="'.$admin->id.'" data-id="'.$admin->id.'" data-lname="'.ucwords($admin->last_name).'" data-fname="'.ucwords($admin->first_name).'"  data-email="'.$admin->email.'" data-role="'.$admin->role.'" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="btn btn-primary btn-sm btn-float btn-round btn-float-sm userInfo" > <span class="w-4 h-4 fa fa-edit"></span></a>
	<!--<a type="button" title="Delete" data-toggle="modal" data-target="#delete-confirmation-modal" class="btn btn-danger btn-sm" onclick="removeUser('.$admin->id.')"> <i class="w-4 h-4 fa fa-trash"></i> </a>	-->    
	';
    $output['data'][] = array(
		$x,
		$admin->last_name,
		$admin->first_name,
		$admin->email,
        $admin->role,
        $btn,
		$actionButton
	);

	$x++;

}

echo json_encode($output);

}

?>