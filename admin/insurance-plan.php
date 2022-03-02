<?php
    include("header.php");
    include("top-nav.php");
    include("side-menus.php");
?>
  
  <style>
tr td:last-child {
    display: flex;
}

.closePlan{
    position: absolute;
    top: -50px;
    right: -1px;
    z-index: 20;
}
</style>

  

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

                                        <div class="col-lg-4 col-sm-12 leftDiv">

                                        <form id="planForm" enctype="multipart/form-data" class="planForm">

                                        <div class="form-group"> 
                                            <label for="vertical-form-1" class="form-label">Plan Name</label> 
                                            <input id="name"  type="text" class="form-control" placeholder="Name of Plan" name="name" value=""> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="vertical-form-2" class="form-label">Description</label>
                                            <textarea class="form-control" rows="6" cols="100%" id="desc"  placeholder="Plan description" name="desc"></textarea> 
                                        </div> 
                                        <div class="form-group img">
                                             <label for="vertical-form-1" class="form-label">Plan Image</label> 
                                             <input id="vertical-form-1"  type="file" class="form-control" placeholder="Upload image for plan" name="image"> 
                                            </div> 
                                        <div class="form-group">
                                        <input type="hidden" class="pid" name="pid">
                                        <button class="btn btn-primary addPlan planBtn" id="planBtn">Create</button>  <i class="fa fa-refresh fa-lg ml-3 text-danger hidden reloadMe"></i>
                                        </div>
                                        </form>
                                        <div class="loadPlansPck relative hidden"></div>

                                            <div id="resp" class="resp"></div>
                                        </div>



                                        <div class="col-lg-8 col-sm-12 rightDiv">
                                        <div class="tblDiv hidden">
                                   
                                        <table class="table table-striped plantbl" id="plantbl">

                                        <thead>
                                            <tr>
                                    
                                                <th class="whitespace-nowrap">PLAN</th>
                                                <th class="whitespace-wrap">DESCRIPTION</th>
                                                <th class="whitespace-wrap">status</th>
                                                <th class="text-center whitespace-nowrap">DETAILS</th>
                                                
                                            </tr>
                                        </thead>


                                        </table>
                                        </div>
                                        <div class="i_loading hidden"></div>

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
