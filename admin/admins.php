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
            <h3 class="content-header-title mb-0">System Administrators  <a href="javascript:;" data-toggle="modal" data-target="#addAdmin" class="btn btn-primary  ml-3">Add New Admin</a></h3>
           
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
                                <th class="whitespace-nowrap">#ID</th>
                                    <th class="whitespace-nowrap">SURNAME</th>
                                    <th class="whitespace-nowrap">FIRST NAME</th>
                                    <th class="whitespace-nowrap">EMAIL</th>
                                   <!-- <th class="whitespace-nowrap">PHONE No</th>-->
                                    <th class="whitespace-nowrap">ROLE</th>
                                    <th class="whitespace-nowrap">STATUS</th>
                                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <!--<tbody class="tbody" id="tbody">

                            </tbody>-->
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


                <!-- BEGIN: Delete Confirmation Modal -->
                <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto form-group"></i> 
                                    <div class="text-3xl mt-5">Are you sure?</div>
                                    <div class="text-gray-600 mt-2">
                                        Do you really want to delete these records? 
                                        <br>
                                        This process cannot be undone.
                                    </div>
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="button" class="btn btn-danger w-24">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->



                 <!-- BEGIN:Update Confirmation Modal -->
                 <div id="superlarge-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="text-2xl mb-1 p-5 title-name" id="name"></div>
                                            <div id="uresp" class="p-5 text-center"></div>
                                            <div class="p-5" id="acontent"></div>
                                      </div>
                            </div>
                       </div> 
                 </div>
                <!-- END: Update Confirmation Modal -->


                 <!-- BEGIN:Add Modal -->
                 <div id="addAdmin" class="modal" tabindex="-1" aria-hidden="true" >
                <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: #f0f0f0;">
                            <div class="modal-body  pb-3">
                            <div id="resp" class="p-2 text-center nresp"></div>
                                <div class="p-5 text-center">
                                <form id="adminCreate">
                                    <div class="text-2xl mb-5">Add New</div>
                                  

                                    <div class="form-group"> 
                                       <label for="regular-form-1" class="form-label">Last Name</label> 
                                       <input id="lnames" type="text" class="form-control form-control-rounded" name="last_name" placeholder=""> 
                                    </div> 
                                    <div class="form-group"> 
                                        <label for="regular-form-2" class="form-label">First Name</label> 
                                        <input id="fnames" type="text" class="form-control form-control-rounded" name="first_name" placeholder=""> 
                                    </div> 
                                    <div class="form-group"> 
                                        <label for="regular-form-2" class="form-label">Phone Number</label> 
                                        <input id="phones" type="text" class="form-control form-control-rounded" name="phone_no" placeholder=""> 
                                    </div> 
                                    
                                    <div class="form-group"> 
                                        <label for="regular-form-2" class="form-label">Email</label> 
                                        <input id="emails" type="email" class="form-control form-control-rounded" name="email" placeholder="">
                                        
                                    </div> 

                                    <div class="form-group"> 
                                        <label for="regular-form-2" class="form-label">Role</label> 
                                       <select class="form-control tom-select w-full" name="role" id="roles">
                                       <option value=""></option>
                                        <option value="super-admin">Admin</option>
                                        <option value="reviewer">Reviewer</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="button" class="btn btn-primary w-24" id="createBtn">Create</button>
                                </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div> 
                <!-- END: Add Modal -->

<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/admins.js"></script>