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
            <h3 class="content-header-title mb-0">Manage Loan Purpose  <a href="javascript:;" data-toggle="modal" data-target="#addAdmin" class="btn btn-sm btn-primary ml-4">Add New</a></h3>
           
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
                                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible relative">
                                    <div class="tblDiv hidden">                
                        <table class="table mt-2 display table-striped file-export" id="admins" style="width: 100%;">
                            <thead>
                                <tr>
                               
                                    <th class="whitespace-nowrap">TITLE</th>
                                    <th class="whitespace-wrap">DESCRIPTION</th>
                                    <th class="whitespace-wrap">RATE</th>
                                    <th class="whitespace-nowrap">CREATED</th>
                                    <th class="whitespace-nowrap">UPDATED</th>
                                    <th class="whitespace-nowrap">STATUS</th>
                                    <th class="text-center whitespace-nowrap">ACTIONS</th>
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



    <div class="modal fade text-left" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">New Saving Goal </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="loanForm" >
                
            <div class="modal-body">
            <div id="resp" class=" text-center"></div>
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Title" name="title" id="name" value="">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" placeholder="desc" name="desc" id="desc"  value="">
            <input type="hidden" name="pid" id="pid"  value="">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Interest rate , eg 4.5" name="interest_rate" id="interest" value="">
             </div>
        
             </div>
            <div class="modal-footer">
            
            <button type="button" class="btn btn-outline-primary createBtn" id="createBtn">Save</button>
            </div>
            </form>
        </div>
        </div>
    </div>

           



<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/loan.js"></script>