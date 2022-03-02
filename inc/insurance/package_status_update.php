<?php
include("../functions.php");


if (isset($_POST['packageid']) and isset($_POST['sta'])){
    $packageid = $_POST['packageid'];
    $planid = $_POST['planid'];
    $sta = $_POST['sta'];


if($sta == 1){
       $data = json_encode(array(
        "insurancePlanId" => $planid,
        "insurancePackageId" => $packageid
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/insurance/disable-insurance-package',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>  $data,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$global_var->getToken(),
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    $results = json_decode($response, true);
    
    curl_close($curl);
   
   if($results['success'] == true){
       echo "done";
   }else{
    echo  $results['data']['error'][0]['msg'];

   }

}else if($sta == 0){

    $data = json_encode(array(
        "insurancePlanId" => $planid,
        "insurancePackageId" => $packageid
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/insurance/disable-insurance-package',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>  $data,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$global_var->getToken(),
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    $results = json_decode($response, true);
    
    curl_close($curl);
   
   if($results['success'] == true){
    echo "d";
   }else{
    echo  $results['data']['error'][0]['msg'];
   }



}

}