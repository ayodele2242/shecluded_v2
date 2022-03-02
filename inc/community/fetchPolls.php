<?php
include("../functions.php");
if(isset($_POST['id'])){

$id = $_POST['id'];

$resp = curl_get("",$global_var->base_url."/community/get-community-poll/".$id,"get",$global_var->getToken());

if($resp->success != "true")
{
    if($resp->error == "Invalid token")
    login();
     else 
    fatal_error("Enpoint Failure",$resp);
   

}else{
    foreach($resp->data->polls as $poll)
    {
?>




<?php
    }
}

}else{
    echo "No parameter sent.";
}
?>