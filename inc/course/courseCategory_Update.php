<?php
include("../functions.php");


if(empty($_POST['name'])){
    echo "Kindly provide all fields with valid data";
}else {

  $name = $_POST['name'];
  $cat_id = $_POST['cat_id'];
  $id = $_POST['pid'];
  $descr = $_POST['descr'];
   
  $data = json_encode(array(
    "id" => $id,
    "name" => $name,
    "description" => $descr
    
));

    

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/course/edit-course-category',
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

     //print_r($results);
     
    if($results['success'] == true){
         echo "done";
     }else{
      echo  $results['data']['error'][0]['msg'];
     }


}
    