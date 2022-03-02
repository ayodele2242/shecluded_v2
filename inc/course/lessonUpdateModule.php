<?php
include("../functions.php");



if(empty($_POST['title']) || empty($_POST['cat_id'])){
    echo "Kindly provide all fields with valid data";
}else {


    $name = $_POST['title'];
    $course_id = $_POST['cat_id'];
    $order = $_POST['order'];
    $thumb = $_POST['thumbnail'];
    $id = $_POST['pid'];
    
    $details = array();
    
     if(!empty($_POST['details'])){
        $rowCount = count($_POST['details']);
        for($i = 0; $i < $rowCount; $i++)
        { 		
          $note =  array();
          $module  =  $_POST['details'][$i];
          $note['notes'] = $module;
          $details[] = (object) $note;
        }
      }else{
        $note =  array();
        $note['notes'] = "";
        $details[] = (object) $note;

      }

     
  
    $data = json_encode(array(
    "course_id" => $course_id,
    "thumbnail" => $thumb,
    "order_number" => $order,
    "title" => $name,
    "sections" => $details
    ));

   

    $curl = curl_init();

   curl_setopt_array($curl, array(
        CURLOPT_URL => $global_var->base_url.'/course/update-lesson/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
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

?>
    
