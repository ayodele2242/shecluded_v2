<?php 
session_start();
//shared configuration file . 
class global_var{

    public $base_url = "";// "http://shecluded-api.herokuapp.com/api/v2/admin";
    public $suite_name = "Shecluded";
    public $environment = ""; 
    private $user = "";
    private $enc_key = "";
    public $cloudinary_code = "Shecluded";

       // constructor with environment
       public function __construct($envn,$key){
        $this->environment = $envn; 
        $this->enc_key = $key;
        if($envn == "dev")
        $this->base_url = "https://3kspcuk0ui.execute-api.eu-west-2.amazonaws.com/dev/api/v2/admin";
        else 
        $this->base_url = "https://w97d018sk6.execute-api.eu-west-2.amazonaws.com/prod/api/v2/admin";

    }

    function getEncryptionKey()
    {
        return $this->enc_key;
    }

    function getCloudinary()
    {
        return $this->cloudinary_code;
    }

    
    function getLoggedInUser()
    {
        return $this->user;
    }
    
    function getToken()
    {

       if( !empty($_SESSION['accessToken']) )
        {
            return  $_SESSION['accessToken'];
        }else {
            return "404";
        }
    }
    
    function searchAccountTypeByIDs($obj,$value)
    {
        foreach($obj->data->accountTypes as $accountType)
        {
        
            if($accountType->id == $value)
            {
                return $accountType->name;
            }
        }
    }
    function access()
    {
  
      
        //checking for access . 
        if( $_SESSION['accessToken'])
        {
           //cookie exists . checking cookie for settings

           if($_COOKIE[$this->suite_name."_config"])
           {
               $cookie_config = json_decode($_SESSION['accessToken'."_config"]);
               $this->user = $cookie_config;
               $cookie_xpire = $cookie_config->xpire;
               if($cookie_xpire < time())
               {
                   //cookie has expired .. call for re-authentication by redirect and pass in the email
                   redirect("Location: ../auth");
                  // die();
               }else {
    
               }

           }else {
               
           }


        }else {
            //no token found.. aborting 
        }
    }
}