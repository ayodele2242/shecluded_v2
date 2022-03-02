<?php
include("../functions.php");

if(empty($_POST['title']) || empty($_POST['description'])){
    echo "Kindly provide all fields with valid data";
}else {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $keywords = $_POST['keywords'];
    $img = $_POST['thumbnail'];

   
    $array = explode(",", $keywords);
    

   
    $data = json_encode(array(
        "title" => $title, 
        "description" => $desc,
        "thumbnail" => $img,
        "search_keywords" => $array,
    ));

    

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/course/create-course-topic',
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
    