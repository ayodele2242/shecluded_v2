<?php
    include("header.php");
    include("top-nav.php");
    include("side-menus.php");
?>
  


  

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Insurance Package</h3>
           
          </div>
          <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            
          </div>
        </div>
        
        <div class="content-body">
            <!-- tour guide start -->
            <section class=" tour-wrapper">
                <!-- Basic Tour Start here -->
                <div class="basic-tour">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                               
                                <div class="card-content">
                                    <div class="card-body row">

                                        <div class="col-lg-6 col-sm-12">

                                        <form id="packageForm" enctype="multipart/form-data">
                                        <div class="form-group">
    <label for="vertical-form-1" class="form-label">Package Name</label> 
    <input id="vertical-form-1"  type="text" class="form-control" placeholder="Name of package" name="name" value="<?php if(isset($_GET['name'])) { echo $_GET['name']; } ?>"> 
</div> 
<div class="form-group">
    <label for="vertical-form-2" class="form-label">Description</label>
     <textarea class="form-control" rows="6" cols="100%" id="vertical-form-2"  placeholder="Package description" name="desc"><?php if(isset($_GET['descr'])) { echo $_GET['descr']; } ?></textarea>
     </div> 
     <?php if(!isset($_GET['name'])) { ?>    
<div class="form-group loader"></div>
<?php }else{ ?>
    <div class="form-group">
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

    </div>

<?php } ?>
<div class="form-group">
     <label for="vertical-form-1" class="form-label">Total Installments</label> 
     <input id="vertical-form-1"  type="number" class="form-control" placeholder="Total number of installments" name="installment" value="<?php if(isset($_GET['duration'])) { echo $_GET['duration']; } ?>"> 
    </div> 

    <div class="form-group">
         <label for="vertical-form-1" class="form-label">Package Amount</label> 
         <input id="vertical-form-1"  type="number" class="form-control" placeholder="Amount for package " name="amount" value="<?php if(isset($_GET['amt'])) { echo $_GET['amt']; } ?>"> </div> 
         <div class="form-group">
         <?php if(!isset($_GET['name'])) { ?>    
        <button class="btn btn-primary addPackage">Create Now</button> 
        <?php }else{ ?>
            <button class="btn btn-warning updatePackage">Update</button> 
            <input type="hidden" name="packageid" value="<?php if(isset($_GET['packageid'])) { echo $_GET['packageid']; } ?>">
            <input type="hidden" name="planid" value="<?php if(isset($_GET['planid'])) { echo $_GET['planid']; } ?>">
            <?php } ?>
        </div>
</form>
                                            <div id="resp" class="resp"></div>
                                        </div>



                                        <div class="col-lg-6 col-sm-12">
                                   


                                        </div>

                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <!-- tour guide ends -->
        </div>
        
      </div>
    </div>
    <!-- END: Content-->



<?php
    include("customizer.php");
    include("footer.php");
?>
<script src="../assets/js/insurance_module.js"></script>
