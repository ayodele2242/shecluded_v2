<?php
include("../functions.php");



if(empty($_POST['id'])){
    echo "Kindly provide all fields with valid data";
}else {

   
    $id = $_POST['id'];
   
   
    $file = $_FILES["image_file"]["name"];
    //echo "Type: " . $_FILES["image_file"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["image_file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/
  
    $details = array('file'=> new CURLFILE($file));
   
    $data = json_encode(array(
        $details
    ));

   

    $curl = curl_init();

   curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/course/upload-lesson-file/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>  $details,
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$global_var->getToken(),
          'Content-Type: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      $results = json_decode($response, true);
      
      curl_close($curl);

     //print_r($results);
     
     if($results['error'] == 'unauthenticated'){
       echo $results['error'];
     }else{
    if($results['success'] == true){
         echo "done";
     }
     else if(!empty($results['data']['error'][0]['msg'])){
      echo  $results['data']['error'][0]['msg'];
     }else{
      echo  $results['data']['error'][0];
     }
    }


}
    