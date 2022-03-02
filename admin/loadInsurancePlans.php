<?php
include("../inc/functions.php");
?>


<label for="vertical-form-2" class="form-label animated fadeIn">Target Plan</label>
<select  name="plan_id" class="form-control animated fadeIn" aria-label=".form-select-lg example">
  <?php
  
$resp = curl_get("",$global_var->base_url."/insurance/get-insurance-plans","get",$global_var->getToken());

foreach($resp->data->insurancePlans as $plan)
{
    
    if(($plan->id == $_GET['planid']))
    {

    echo "<option selected value=\"".$plan->id."\">".$plan->name."</option>";

    }else {
        echo "<option value=\"".$plan->id."\">".$plan->name."</option>";
    }

}
?>
</select>