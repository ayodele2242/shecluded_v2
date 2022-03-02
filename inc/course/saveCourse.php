<?php
include("../functions.php");


if(empty($_POST['name']) || empty($_POST['cat_id']) || empty($_POST['topic_id']) || empty($_POST['is_paid'])){
    echo "Kindly provide all fields with valid data";
}else {

    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $cat_id = $_POST['cat_id'];
    $topic_id = $_POST['topic_id'];
    $type = $_POST['media_type'];
    $is_paid = (boolean)$_POST['is_paid'];
    $thumb = $_POST['thumbnail'];

  
    $data = json_encode(array(
    "title" => $name,
    "description" => $desc,
    "category" => $cat_id,
    "content_type" => $type,
    "thumbnail" => $thumb,
    "topic_id" => $topic_id,
    "is_paid" => $is_paid
    ));

    

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/course/create-course',
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

    // print_r($results);
     
    if($results['success'] == true){
         echo "done";
     }
     else if(!empty($results['data']['error'][0]['msg'])){
      echo  $results['data']['error'][0]['msg'];
     }else{
      echo  $results['data']['error'][0];
     }


}
    