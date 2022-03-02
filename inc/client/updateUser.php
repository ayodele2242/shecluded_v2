<?php
require_once "../admins.php";




if(isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone'])){

  $date= $_POST['dob'];
  if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
    $new_date = $_POST['dob'];
  }else{
  $date= date_create_from_format('j F, Y', $date);
  $new_date = date_format($date, "Y-m-d");
  }

    $data = json_encode(array(
        "first_name"  => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "date_of_birth" => $new_date,
        "phone_no" => $_POST['phone'],
        "id" => $_POST['user_id'],
        ));

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $global_var->base_url.'/user/update-user-details/',
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