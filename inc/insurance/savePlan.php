<?php
include("../functions.php");



    $name = $_POST['name'];
   
    $desc = $_POST['desc'];

    if(empty($name) || empty($desc) || empty($_FILES['image']))
    {
        echo "Empty or invalid fields detected";
    }else{
       
        $imgFile =$_FILES['image']['name'];
        $file_size=$_FILES['image']['size'];
        $file_tmp= $_FILES['image']['tmp_name'];

    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpg','jpeg','png','gif');
        // rename uploading image
        $pic = rand(1000,1000000).".".$imgExt;
      
    

   


      if (!in_array($imgExt, $valid_extensions)) {
        echo "Invalid file type detected ; supported 'jpg','jpeg','png','gif'";
      }else{
        $payload = array("name" => $name, "description" => $desc, "image" => $pic);

        $resp = curl_get($payload,$global_var->base_url."/insurance/create-insurance-plan","post",$global_var->getToken());

        if($resp->success == "true")
        {
           echo "done";
          

        }else {
           echo "error ;".$resp->message;
        }


      }



    }


?>