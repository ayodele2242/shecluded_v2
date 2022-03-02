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
            <h3 class="content-header-title mb-0">Course Topic</h3>
           
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
                                        <div class="col-lg-5 col-sm-12">

                                        <form id="ccForm" class="relative">
                                                
                                                <div class="form-group">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Title">
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="desc" class="form-label">Description</label>
                                                    <textarea rows="6" class="form-control" id="descr" name="description"></textarea>
                                                </div>
                                
                                                <div class="form-group ikey">
                                                    <label for="title" class="form-label">Search Keywords</label>
                                                    <input id="keywords" name="keywords" type="text" class="form-control" placeholder="Search Keywords">
                                                    <div class="form-help">For multiple search key words use comma delimiter e.g business, money, loss</div>
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                                    <input id="thumbnail" type="text" class="form-control" name ="thumbnail" value="" placeholder="eg https://www.wikihow.com/images/thumb/d/db/Get-the-URL-for-Pictures-Step-2-Version-6.jpg/aid597183-v4-728px-Get-the-URL-for-Pictures-Step-2-Version-6.jpg">
                                                    <div class="form-help">Enter image url</div>
                                                </div>
                                
                                                <div class="mt-3" align="center">
                                                <input type="hidden" class="pid" name="pid">
                                                <button class="btn btn-lg btn-primary mr-1 mb-2 insertMe" id="create">Create</button> <i class="fa fa-refresh fa-lg ml-2 text-danger hidden reloadMe"></i>
                                                </div>
                                                <div class="form-group resp"></div>
                                                <div class="overlay hidden"></div>
                                        </form>

                                         </div>

                                    <div class="col-lg-7 col-sm-12">
                                            <div class="tblDiv hidden">
                                                    <table class="table table-striped" id="ccTbl">

                                                    
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>Thumbnail</th>
                                                                <th>Title</th>
                                                                <th>Description</th>
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



<?php
    include("customizer.php");
    include("footer.php");
?>

<script src="../assets/js/course_topic.js"></script>