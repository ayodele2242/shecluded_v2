<?php
include("../inc/functions.php");


$id = $_POST['id'];
$name = $_POST['name'];

$resp = curl_get("",$global_var->base_url."/insurance/get-insurance-purchase-by-plan/".$id,"get",$global_var->getToken());



//loop thru to get name and title
$plan = $resp->data->insurancePlan ;


if($plan->id == $id)
{
    $plan_name = $plan->name;
    $course_desc = $plan->description;
}


if($resp->success != "true")
{
    echo "No data available for this plan";
}else{
?>
<div class="relative">
<style>
.closePlan{
    position: absolute;
    top: -50px;
    right: -1px;
    z-index: 20;
}

</style>
    
<table class="table table-striped tpkg">
    <thead>
       
                <tr>
            
            <th class="whitespace-nowrap">PACKAGE</th>
            <th class="whitespace-wrap">DESCRIPTION</th>
            <th class="whitespace-nowrap">AMOUNT</th>
            <th class="whitespace-nowrap">INSTALLMENT</th>
            <th class="whitespace-nowrap">STATUS</th>
            <th class="text-center whitespace-nowrap">ACTION</th>
            
        </tr>

</thead>
<tbody>

<?php
if(!empty($resp->data->insurancePlan->insurance_packages)){
foreach($resp->data->insurancePlan->insurance_packages as $package)
{
    if($package->status == 'active'){
        $sta = "checked";
      }else{
          $sta = "";
      }
?>

<tr class="intro-x">
                                       
    <td class="font-medium whitespace-nowrap"><?php echo $package->name; ?>
    
    </td>
    <td class="font-medium whitespace-wrap"><?php echo $package->description; ?></td>
    <td class="font-medium whitespace-nowrap"><?php echo number_format($package->amount,2); ?></td>
    <td class="font-medium whitespace-nowrap"><?php echo $package->installment_month; ?> month(s)</td>
    <td class="font-medium whitespace-nowrap"><?php 
    if($package->status == "active")
    echo "<button class=\"btn btn-rounded btn-success\">active</button>";
    else 
    echo "<button class=\"btn btn-rounded btn-warning\">".$package->status."</button>";
    
    ?></td>

    
    <td>
    <input type="checkbox" id="<?php echo $package->id; ?>" data-planid="<?php echo $plan->id; ?>"  class="ustaPlanDetails" <?php echo $sta; ?>/>
    <a href="../admin/insurance-packages?packageid=<?php echo $package->id.'&name='.$package->name.'&descr='.$package->description.'&amt='.$package->amount.'&duration='.$package->installment_month.'&planName='.$name.'&planid='.$id; ?>" class="btn btn-warning btn-sm btn-float btn-round btn-float-sm ml-1"><i class="fa fa-edit"></i></a></div>
    </td>
    
</tr> 

<?php
}
?>
</tbody>
<?php
}
?>
</table>
</div>
<?php
}
?>

<script>
var tpkg;   
tpkg = $('.tpkg').DataTable({
   dom: 'Bfrtip',
   "scrollX": true,
   "scrollY": 460,

});


$(document).on('click', '.ustaPlanDetails', function() {
            var checkStatus = this.checked ? 1 : 0;
            var id = $(this).attr('id');
            var catid = $(this).attr('data-planid');
            $(".iam_loading").html("Updating Status...").show();
            $.post("../inc/insurance/package_status_update.php", {"packageid": id, "planid": catid, "sta":checkStatus, }, 
            function(data) {
            if(data == "done"){
                
                $('.resp').empty().show().html('<div class="alert alert-success"> Activated Successfully</div>').delay(9000).fadeOut(9000);
            
                //tpkg.ajax.reload(null, false);
            }else if(data == "d"){
                $('.resp').empty().show().html('<div class="alert alert-success"> De-Activated Successfully</div>').delay(9000).fadeOut(9000);
            
                //tpkg.ajax.reload(null, false);
            }else{
                $('.resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
            }
            });
        
        });

</script>