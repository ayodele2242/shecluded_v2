<?php
include("../functions.php");

if(!empty($_POST['id']) && !empty( $_POST['amount'])){


    $data = json_encode(array(
        "account"  => $_POST['id'],
        "approved_amount"  => (int)$_POST['amount'],
        "default_interest"  =>  $_POST['interest'],
        "repayment_type"  =>  $_POST['type']
        ));

       

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/loan/accept-loan',
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
     $done = "done";
     $removewp = preg_replace('~\x{00a0}~','', $done);
       echo $removewp;
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