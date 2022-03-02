<?php
include("../functions.php");
if(isset($_POST['id'])){


$id = $_POST['id'];

$resp = curl_get("",$global_var->base_url."/community/get-community-members/".$id,"get",$global_var->getToken());

if($resp->success != "true")
{
    if($resp->error == "Invalid token")
    login();
     else 
    fatal_error("Enpoint Failure",$resp);
   

}else{
    foreach($resp->data->members as $row)
    {
        
?>

<div class="intro-y col-lg-12 md:col-span-12 lg:col-span-12 mb-5">
                        <div class="box">
                            <div class="flex items-start px-5 pt-5">
                                <div class="w-full flex flex-col lg:flex-row items-center">
                                   
                                <div class="w-16 h-16 image-fit">
                                        <img class="rounded-full" src="https://res.cloudinary.com/<?php echo $global_var->cloudinary_code;?>/image/fetch/c_fill,g_face,h_200,w_200/r_max/f_auto/<?php echo $circle->creator->image_path;?>">
                                </div>
                                  
                                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                        <a href="" class="font-medium"><?php echo $row->user_details->last_name . ' '. $row->user_details->first_name; ?></a> 
                                     <div class="text-gray-600 text-xs mt-0.5"><a  href="#"> Date Created: <?php echo date('Y-m-d H:i:s', strtotime($row->createdAt)); ?></a></div>
                                    </div>
                                </div>
                             
                            </div>
                            <div class="text-center lg:text-left p-5">
                                <div></div>
                                
                            </div>
                  
                        </div>
                    </div> 



<?php
       
    }
}

}else{
    echo "No parameter sent.";
}
?>