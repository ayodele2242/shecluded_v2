<?php
include("../functions.php");


$resp = curl_get("",$global_var->base_url."/insurance/get-insurance-plans","get",$global_var->getToken());


if($resp->success != "true")
{
   
    $output = array('data' => "");

 
}else{
$output = array('data' => array());
$output = array('lastkey' => "", 'success' => true);
foreach($resp->data->insurancePlans as $insure)
{
	
      if($insure->status == 'active'){
        $sta = "checked";
      }else{
          $sta = "";
      }
    
    $switch = '
    <label for="checkbox">
    <input type="checkbox" id="'.$insure->id.'" class="ustaDetails switchery" '.$sta.'/>
    </label>';

    $actionButton = '<a href="javascript:;" id="'.$insure->id.'" data-title="'.$insure->name.'"  data-descr="'.$insure->description.'" class="btn btn-warning btn-sm btn-float btn-round btn-float-sm editDetils"> <i class="fa fa-edit"></i></a> 
    <a href="javascript:;" id="'.$insure->id.'" data-title="'.$insure->name.'" class="btn btn-primary btn-sm btn-float btn-round btn-float-sm viewPackages"> <i class="fa fa-eye"></i></a>';

   $output['data'][] = array(
       $insure->name,
       $insure->description,
       $switch,
       $actionButton
	);

	

}

}
echo json_encode($output);









?>