<?php
include("../functions.php");


if (isset($_POST['id']) and isset($_POST['sta'])){
    $id = $_POST['id'];
    $sta = $_POST['sta'];


if($sta == 1){
    $data = json_encode(array(
        "id"  => $id
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/target-saving/change-target-saving-category-status',
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
        echo $results['message'];
      // var_dump($results['data']['error']);
      //Value are stored in array object inside an array, let's loop through it
       /*foreach($results['data']['error'] as $key => $value)
        {
        echo $value;
        }*/
   }

}else if($sta == 0){

    $data = json_encode(array(
        "id"  => $id
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/target-saving/change-target-saving-category-status',
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
    
      //Value are stored in array object inside an array, let's loop through it
       foreach($results['data']['error'] as $key => $value)
        {
        echo $value;
        }
   }



}

}