<?php
require_once '../admins.php';

if(isset($_POST['id'])){
$id = $_POST['id'];
$key = rand();
$string = $id."&lastKey=".$key;
function searchAccountTypeByID($obj,$value)
{
    foreach($obj->data->accountTypes as $accountType)
    {
     
        if($accountType->id == $value)
        {
            return $accountType->name;
        }
    }
}


$uresp = curl_get("",$global_var->base_url."/user/get-user-details/".$id,"get",$global_var->getToken());
$userdetails = $uresp->data->userDetails;

try {
    $accountObj = curl_get("",$global_var->base_url."/account-type/fetch-account-types","get",$global_var->getToken());

        }
        catch(Exception $e)
        {
        if($accountObj->error == "Invalid token"){

        }
        
        else{ 
        fatal_error("Enpoint Failure",$accountObj);
        }

}


$resp = curl_get("",$global_var->base_url."/account/get-user-accounts/".$id,"get",$global_var->getToken());




if($resp->success != "true" || $resp->success == "")
{
   
 
}else{
    $output = array('data' => array());
    $x= 1;
    foreach($resp->data->accounts as $account)
    {
        //$count++;
        $acc_type = searchAccountTypeByID($accountObj,$account->account_type_id);
        $acc_base = base64_encode($acc_type." (".$account->account_no.")");

        if($account->status == "active")  { 
            $btn1 = '<button class="btn btn-elevated-success w-24 mr-1 mb-2">active</button>'; 
        }else { 
            $btn1 = '<button class="btn btn-elevated-danger w-24 mr-1 mb-2">inactive</button>'; 
        } 



	          
                    $actionButton = '
                    <a class="flex items-center mr-3" href="#../clients/history?account_id='.$account->id .'&user_id='. $userdetails->id.'&bio='.base64_encode($userdetails->last_name .' '.$userdetails->first_name).'&base='. $acc_base.'> <i class="fas fa-info-circle w-4 h-4 mr-1"></i> details </a>
                                        
                    ';
                
               


    $output['data'][] = array(
		$x,
		$account->account_name,
		$account->account_no,
		$acc_type,
		$btn1,
		""
	);

	$x++;

}

}

echo json_encode($output);
}else{
    echo "Nothing send";
}


?>