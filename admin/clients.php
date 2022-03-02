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
            <h3 class="content-header-title mb-0">Clients 
            <?php if($_SESSION['role'] == 'super-admin'){ ?>
                <a class="btn btn-secondary btn-sm round ml-4" href="javascript:;" data-toggle="modal" data-target="#walletInward">Wallet In-ward</a>
                <?php } ?>
            </h3>
           
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
                                            <div class="row searchMDiv">
                                                <div class="col-lg-4 col-sm-12 mb-3">
                                                    <fieldset class="form-group position-relative">
                                                        <input type="text" class="form-control mb-1 search-box" id="iconLeft13"
                                                            placeholder="Search Using Email">
                                                        <div class="form-control-position">
                                                            <i class="spinner feather icon-refresh-cw hidden"></i>
                                                        </div>
                                                        <span class="resp"></span>
                                                    </fieldset>      
                                                 </div>
                                            </div>

                                            <div class="row editInfoDiv">
                                                <div class="col-12  tableDiv">
                                                    <table class="table table-striped  file-export usersTbl hidden" id="usersTbl">
                                                        <thead>
                                                            <tr>
                                                            <td colspan="7" class="loadMore" style="text-align: right; padding-right:5px;"></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                <th scope="col">SURNAME</th>
                                                                <th scope="col">FIRST NAME</th>
                                                                <th scope="col">EMAIL</th>
                                                                <th scope="col">PHONE</th>
                                                                <th class="col">DoB</th>
                                                                <th scope="col">ACTIONS</th>
                                                            </tr>
                                                        </thead>
                                        
                                                    </table>

                                                 
                                                    <div class="i_loading"></div>
                                                </div>
                                                <div class="col-12  emailTblDiv hidden">
                                                <table class="table table-striped  file-export emailTbl" id="emailTbl">
                                                        <thead>
                                                            
                                                                <th scope="col">SURNAME</th>
                                                                <th scope="col">FIRST NAME</th>
                                                                <th scope="col">EMAIL</th>
                                                                <th scope="col">PHONE</th>
                                                                <th class="col">DoB</th>
                                                                <th width="100">ACTIONS</th>
                                                            </tr>
                                                        </thead>
                                        
                                                    </table>
                                                </div>
                                                
                                                <div class="col-4   topUpandEditDiv hidden"  id="topUpandEditDiv"></div>
                                            </div> 

                                            <div class="userInfoDiv relative hidden">
                                                
                                               
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

    <div class="modal fade" id="walletInward" tabindex="-1" role="dialog" aria-labelledby="walletInward" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Topup Wallet In-ward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="topmeUp" >
            <div class="modal-body">
                    <div class="imsg"></div>

                  <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Amount</label>
                            <div class="col-lg-12">
                            <input id="amt" type="number" class="form-control form-control-rounded" name="amount" placeholder=""> 
                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Narration</label>
                            <div class="col-lg-12">
                            <textarea id="narration" rows="10" style="width: 100%;" name="narration"></textarea>
                            </div>
                        </div>
               


            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-danger btn-small btn-icon-alt font-weight-bold topmeUpBtn" id="topmeUpBtn">Top Up</button>
                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal"><?php echo $cancelBtn; ?></button>
                
            </div>
            </form>
        </div>
    </div>
</div>



<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/users.js"></script>