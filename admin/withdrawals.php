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
            <h3 class="content-header-title mb-0">Withdrawals</h3>
           
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
                                    <div class="card-body">
                                         <div class="row editInfoDiv">
                                                <div class="col-12  tableDiv">
                                                    <table class="table table-striped  file-export trxTbl hidden" id="trxTbl">
                                                    <thead>
                                                        <tr>
                                                        
                                                            <th class="whitespace-nowrap">REFERENCE</th>
                                                            <th class="whitespace-nowrap">AMOUNT</th>
                                                            <th class="whitespace-wrap">NARRATION</th>
                                                            <th class="whitespace-wrap">TYPE</th>
                                                            <th class="whitespace-nowrap">TIMESTAMP</th>
                                                            <th class="text-center whitespace-nowrap">DETAILS</th>
                                                        
                                                        </tr>
                                                    </thead>
                                        
                                                    </table>

                                                 
                                                    <div class="i_loading"></div>
                                                </div>
                                                <div class="col-4   topUpandEditDiv hidden"  id="topUpandEditDiv"></div>
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

<script src="../assets/js/withdrawals.js"></script>