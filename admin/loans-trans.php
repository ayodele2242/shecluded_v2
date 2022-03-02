<?php
    include("header.php");
    include("top-nav.php");
    include("side-menus.php");
?>
  


  <style>
td:first-child { 
    display: flex;
  
}

</style>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Loans Management</h3>
           
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
                                <table class="table mt-2 display table-striped file-export sloanTbl" id="sloanTbl" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ACTIONS</th>
                                            <th class="whitespace-nowrap">SURNAME</th>
                                            <th class="whitespace-nowrap">FIRST NAME</th>
                                            <th class="whitespace-nowrap">LOAN AMOUNT</th>
                                            <th class="whitespace-nowrap">AMOUNT APPROVED</th>
                                            <th class="whitespace-nowrap">INTEREST RATE</th>
                                            <th class="whitespace-nowrap">REPAYMENT FREQUENCY</th>
                                            <th class="whitespace-nowrap">TENOR</th>
                                            <th class="whitespace-nowrap">PRINCIPAL</th>
                                            <th class="whitespace-nowrap">INTEREST</th>
                                            <th class="whitespace-nowrap">START DATE</th>
                                            <th class="whitespace-nowrap">REPAYMENT DATE</th>
                                            <th class="whitespace-nowrap">BANK STATEMENT</th>
                                            <th class="whitespace-nowrap">STATUS</th>

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



    <!-- BEGIN: Pre-approve modal -->
    <div id="preapprovepModal" class="modal" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: #f0f0f0;">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto" id="Uname"></h2> 
                        </div> 
                        <!-- END: Modal Header -->

                        <div class="modal-body p-5">

                            
                            <form id="preapproveForm">
                    
                                <div id="resp"></div>
                                    <div class="mt-3 preapproveloanDetailse"> 
                                    
                                    </div> 
                                    <div class="text-center">
                                        <input type="hidden" id="papprid" name="id">
                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary mr-1">Cancel</button>
                                        <a href="#"  type="button" class="btn btn-primary" id="preapproveBtn">PRE-APPROVE</a>
                                   </div>

                            </form>
                        </div>
            </div>
        </div>
    </div> 
        <!-- BEGIN: Pre-approve modal -->
           
    
          <!-- BEGIN: Approve modal -->
          <div id="approve-Modal" class="modal" tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content" style="background: #f0f0f0;">
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto" id="apprname"></h2> 
                            </div> 
                            <!-- END: Modal Header -->

                            <div class="modal-body p-5">
                                <form id="approveForm">
                        
                                    <div id="aresp"></div>   
                                    <div class="mt-3 approveloanDetails mb-3 mt-2"></div> 
                                        <div > 
                                            <label for="regular-form-1" class="form-label">Amount to Approve</label> 
                                            <input id="amt" type="number" class="form-control form-control-rounded" name="amount" placeholder=""> 
                                        </div> 
                                        <div class="mt-2"> 
                                            <label for="regular-form-1" class="form-label">Default Interest </label> 
                                            <input id="interest" type="text" class="form-control form-control-rounded" name="interest" placeholder=""> 
                                        </div> 
                                        <div class="mt-2"> 
                                            <label for="regular-form-1" class="form-label">Repayment Type </label> 
                                            <select name="type" id="type" class="form-control form-control-rounded">
                                            <option value=""></option>
                                            <option value="reducing">Reducing</option>
                                            <option value="equal">Equal</option>
                                            <option value="bullet">Bullet</option>
                                            </select>
                                        </div> 
                                            
                                        
                                    <div class="text-center mt-5">
                                        <input type="hidden" id="apprid" name="id">
                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary mr-1">Cancel</button>
                                        <a href="javascript:;"  type="button" class="btn btn-warning approveBtn" id="approveBtn" >APPROVE</a>
                                    </div>

                                </form>
                            </div>
                </div>
            </div>
    </div> 
<!-- BEGIN: Approve modal --> 

 <!-- BEGIN: Disburse modal -->
 <div id="disburse-Modal" class="modal" tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content" style="background: #f0f0f0;">
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto" id="dapprname"></h2> 
                            </div> 
                            <!-- END: Modal Header -->

                            <div class="modal-body p-5">
                                <form id="disburseForm">
                        
                                    <div id="daresp"></div>   
                                    <div class="mt-3 disburseloanDetails mb-3 mt-2"></div> 
                                        <div > 
                                            <label for="regular-form-1" class="form-label">Amount to Disburse</label> 
                                            <input id="amt" type="number" class="form-control form-control-rounded" name="amount" placeholder=""> 
                                        </div> 
                                        <div class="mt-2"> 
                                            <label for="regular-form-1" class="form-label">Default Interest </label> 
                                            <input id="interest" type="text" class="form-control form-control-rounded" name="interest" placeholder=""> 
                                        </div> 
                                        <div class="mt-2"> 
                                            <label for="regular-form-1" class="form-label">Repayment Type </label> 
                                            <select name="type" id="type" class="form-control form-control-rounded">
                                            <option value=""></option>
                                            <option value="reducing">Reducing</option>
                                            <option value="equal">Equal</option>
                                            <option value="bullet">Bullet</option>
                                            </select>
                                        </div> 
                                            
                                        
                                    <div class="text-center mt-5">
                                        <input type="hidden" id="dapprid" name="id">
                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary mr-1">Cancel</button>
                                        <a href="javascript:;"  type="button" class="btn btn-primary disburseBtn" id="disburseBtn" style="background: #4A148C; color: #fff;">DISBURSE</a>
                                    </div>

                                </form>
                            </div>
                </div>
            </div>
    </div> 
<!-- BEGIN: Disburse modal -->  


 <!-- BEGIN: Reject modal -->
 <div id="reject-Modal" class="modal" tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content" style="background: #f0f0f0;">
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto" id="rname"></h2> 
                            </div> 
                            <!-- END: Modal Header -->

                            <div class="modal-body p-5">
                                <form id="rejectForm">
                        
                                    <div id="rresp"></div>   
                                    <div class="mt-3 rejectloanDetails mb-3 mt-2"></div> 
                                       
                                        <div class="mt-2"> 
                                            <label for="regular-form-1" class="form-label">Reason for rejecting </label> 
                                            <textarea id="reason" rows="8" class="form-control" name="reason" placeholder=""></textarea> 
                                        </div> 
                                        
                                            
                                        
                                    <div class="text-center mt-5">
                                        <input type="hidden" id="meid" name="id">
                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-sm mr-1">Cancel</button>
                                        <a href="javascript:;"  type="button" class="btn btn-sm btn-danger" id="rejectBtn" >REJECT</a>
                                    </div>

                                </form>
                            </div>
                </div>
            </div>
    </div> 
<!-- BEGIN: Reject modal -->  

  <!-- BEGIN: Loan Schedule modal -->
  <div id="detail-Modal" class="modal" tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: #f0f0f0;">
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto" id="memName"></h2> 
                            </div> 
                            <!-- END: Modal Header -->

                            <div class="modal-body p-5">
                            <div class="amtBorrowed"></div>

                            <table class="table table_view scheduleTbl" id="scheduleTbl">
                             <thead>
                                <tr>
                                     <th>#ID</th>
                                    <th>Principal</th>
                                    <th>Interest</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>

                                </tr>
                             </thead>

                             <tbody class="iBody"> </tbody>

                            </table>

                            <div class="detailContent"></div>
                               
                            </div>
                </div>
            </div>
    </div> 
<!-- BEGIN:Loan Schedule modal --> 

            <!-- Load User's Details Modal -->
            <div class="modal fade text-left" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title title-name" id="myModalLabel1"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="user_contents">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        
                    </div>
                    </div>
                </div>
                </div>

             <!-- Load User's Details Modal #END -->

<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/loans_module.js"></script>

<script>
 $('#scheduleTbl').DataTable({
     
 });

</script>