<?php
include("../functions.php");


    $name = $_POST['name'];
    $plan_id = $_POST['plan_id'];
    $desc = $_POST['desc'];
    $installment = $_POST['installment'];
    $amount = $_POST['amount'];

    $packageid = $_POST['packageid'];


    if(empty($name) || empty($plan_id) || empty($desc) || empty($amount) || empty($installment) || (!ctype_digit($installment)) || (!ctype_digit($amount)))
    {
      
        echo "Empty or invalid fields detected";
    }
else
    {
        $payload = array("name" => $name, "description" => $desc, "insurancePlanId" => $plan_id, "insurancePackageId" => $packageid, "amount" => (int)$amount, "installment_month" => (int)$installment);

$resp = curl_get($payload,$global_var->base_url."/insurance/edit-insurance-package","post",$global_var->getToken());

if($resp->success == "true")
{
    echo "done";
    
    

}else {
    
   echo "error ;".$resp->message;
}

    }


?>