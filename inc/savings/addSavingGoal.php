<?php
include("../functions.php");

$desc = $_POST['desc'];
$title = $_POST['title'];

if(empty($title) || empty($desc)){
    echo "Kindly provide all fields with valid data";
}else {
   
    $data = json_encode(array(
        "name" => $title, 
        "description" => $desc
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/target-saving/create-target-saving-category',
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
        // var_dump($results['data']['error']);
        //Value are stored in array object inside an array, let's loop through it
        $results['data']['error'][0]['msg'];
     }


}
    