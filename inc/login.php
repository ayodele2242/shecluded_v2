<?php
require_once 'functions.php';


if(empty($_POST['email']) || empty($_POST['password'])){
    echo "Username and Password cannot be empty";
}else{

    $email = trim($_POST['email']);
    $pwd = $_POST['password'];

    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    echo "This email address isn't valid";
}else{

    $resp = curl_get(array("email"=> $_POST['email'], "password" => $_POST['password']),$global_var->base_url."/auth/login","post",$global_var->getToken());

    if($resp->message == 'Internal server error'){
        echo "Internal server error occured. Please contact the back-end developers for a resolution";
    }else{

    if($resp->success != "true")
    {
     echo "invalid credentials provided";

    }else if($resp->data->isVerified != "true")
    {
       echo "account is unverified";

    }else{

         //getting token
         if($global_var->environment == "dev")
         {
             echo "ok";
             $_SESSION['accessToken'] = $resp->data->accessToken;
             $_SESSION['email'] = $_POST['email'];
             $_SESSION['role'] = $resp->data->role;
             $_SESSION['name'] = $resp->data->lastName .' '.$resp->data->firstName;
            
         }
         else 
         {
             echo "ok";
             $_SESSION['accessToken'] = $resp->data->accessToken;
             $_SESSION['email'] = $_POST['email'];
             $_SESSION['role'] = $resp->data->role;
             $_SESSION['name'] = $resp->data->lastName .' '.$resp->data->firstName;
         
         
       }


    }

}


}

}

?>