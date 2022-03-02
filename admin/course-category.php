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
            <h3 class="content-header-title mb-0">Course Categories</h3>
           
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

                                            <div class="row">
                                                <div class="col-lg-4">

                                                <form id="ccForm" class="relative">
                                                
                                                <div class="form-group">
                                                    <label for="title" class="form-label">Category Name</label>
                                                    <input id="name" name="name" type="text" class="form-control" placeholder="">
                                                </div>
                                
                                                <div class="form-group loadTopic">
                                                

                                                </div>
                                
                                                <div class="form-group idescr  hidden">
                                                    <label for="title" class="form-label">Description</label>
                                                    <input id="descr" name="descr" type="text" class="form-control" placeholder="">
                                                </div>
                                
                                                
                                                <div class="mt-3" align="center">
                                                <input type="hidden" class="pid" name="pid">
                                                <button class="btn btn-lg btn-primary mr-1 mb-2 insertMe" id="create">Create</button> <i class="fa fa-refresh fa-lg ml-2 text-danger hidden reloadMe"></i>
                                                </div>
                                                <div class="overlay hidden"></div>
                                                 </form>
                                                 <div id="resp" class="form-group resp">
                                                </div>

                                                 </div>

                                                    <div class="col-lg-8">
                                                        <div class="tblDiv hidden">
                                                           
                                                            <table class="table display table-striped table_view" id="cc_Tbl" style="width: 100%;">
                                                                <thead>
                                                                <tr>
                                                                    
                                                                
                                                                    <th>Category Name</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>

                                                                </thead>


                                                            </table>
                                                        </div>
                                                        <div class="i_loading"></div>

                                                    </div>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title warning-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body delete-msg">
               
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="adminId" value="" />
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger del-btn font-weight-bold delAddr" >Yes, delete</button>
            </div>
        </div>
    </div>
</div>

<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/course_category.js"></script>