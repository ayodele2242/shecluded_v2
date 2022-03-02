<?php
include("../functions.php");

if(isset($_POST['email']) && isset($_POST['last_name']) && isset($_POST['first_name'])){


    $data = json_encode(array(
        "email"  => $_POST['email'],
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "phone_no" => $_POST['phone_no'],
        "role" => $_POST['role']
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/user/create-admin/',
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
       foreach($results['data']['error'] as $key => $value)
        {
        echo $value;
        }
   }

}else{
    echo "All inputs are required.";
}

?>