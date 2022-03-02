<?php
include("../functions.php");



    $name = $_POST['name'];
   
    $desc = $_POST['desc'];
    $id = $_POST['pid'];

    if(empty($name) || empty($desc))
    {
        echo "Empty or invalid fields detected";
    }else{
      
        $payload = array("id" => $id, "name" => $name, "description" => $desc);

        $resp = curl_get($payload,$global_var->base_url."/insurance/edit-insurance-plan","post",$global_var->getToken());

        if($resp->success == "true")
        {
           echo "done";
          

        }else {
           echo "error ;".$resp->message;
        }


      



    }


?>