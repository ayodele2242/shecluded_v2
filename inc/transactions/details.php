<?php
include("../functions.php");

$tnx = $_POST['id'];

$resp = curl_get("",$global_var->base_url."/incoming-transaction/get-transaction-details/".$tnx,"get",$global_var->getToken());
//print_r($resp);
$resp->data->error[0];

if($resp->data->error[0] == 'Transaction not found'){
?>
<div class="alert alert-danger">
   <?php echo $resp->data->error[0]; ?>

</div>
<div class="form-actions center">
    <button type="button" class="btn btn-danger mr-1 cancelit">
        <i class="feather icon-x"></i> Close
    </button>
    
    
</div>
<?php
}else{


if($resp->success != "true" || $resp->success =="")
{
    $output = array('success' => false);
}
else{
$detailsUser = $resp->data->user;
$detailsCard = $resp->data->card;
$detailsTransaction = $resp->data->transaction;
?>


<table class="table"> 

 
 <tbody> 
 <tr class="hover:bg-gray-200">

 <td class="border" width="30%">Txn State</td>
 <td class="border"><?php 
 if($detailsTransaction->status == "successful")
 
 {
echo "<font class=\"text-success\"><b>".$detailsTransaction->status."</b></font>";
 }else if($detailsTransaction->status == "processing"){
echo "<font class=\"text-warning\"><b>".$detailsTransaction->status."</b></font>";
 }if($detailsTransaction->status == "failed")
 
 {
echo "<font class=\"text-danger\"><b>".$detailsTransaction->status."</b></font>";
 }else {
    echo "<font class=\"text-info\"><b>".$detailsTransaction->status."</b></font>";
 }
 ?>
 </td>

 </tr> 
 
 <tr class="hover:bg-gray-200">

<td class="border" width="30%">Date</td>
<td class="border"><?php echo $detailsTransaction->createdAt; ?></td>

</tr> 

<tr class="hover:bg-gray-200">

<td class="border" width="30%">Date (Modified)</td>
<td class="border"><?php echo $detailsTransaction->updatedAt; ?></td>

</tr> 

<tr class="hover:bg-gray-200">

<td class="border" width="30%">Client</td>
<td class="border"><i data-feather="link"></i>  <a target=_blank href="../clients/360?client_id=<?php echo $detailsUser->id;  ?>"><?php echo $detailsUser->last_name." ".$detailsUser->first_name; ?> </a></td>

</tr> 


<tr class="hover:bg-gray-200">

<td class="border" width="30%">Amount</td>
<td class="border"><?php echo number_format($detailsTransaction->amount,2); ?></td>

</tr> 


<tr class="hover:bg-gray-200">

<td class="border" width="30%">Payment Gateway</td>
<td class="border"><?php echo $detailsTransaction->payment_gateway; ?></td>

</tr> 
<tr class="hover:bg-gray-200">

<td class="border" width="30%">Narration</td>
<td class="border"><?php if(!empty($detailsTransaction->status_description)) { echo $detailsTransaction->status_description; } ?></td>

</tr> 

<tr class="hover:bg-gray-200">

<td class="border" width="30%">Card Type</td>
<td class="border"><?php echo $detailsCard->card_type; ?></td>

</tr> 



 </tbody> </table>
 <div class="form-actions center">
    <button type="button" class="btn btn-danger mr-1 cancelit">
        <i class="feather icon-x"></i> Close
    </button>
    
    
</div>
<?php
}
}
?>