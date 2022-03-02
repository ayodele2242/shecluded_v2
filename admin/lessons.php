<?php
    include("header.php");
    include("top-nav.php");
    include("side-menus.php");
?>
  


  <style>
tr td:last-child {
    display: flex;
}

.cover{
          position: absolute;
          background: #fff;
          top: 0;
          left: 0;
          right: 0;
          margin-right: 0;
          margin-left: 0;
          width: 100%;
          max-width: 500px;
          height: 600px;
          overflow:scroll;
          z-index: 101;;
      }

      .fitit{
          margin:0;
          margin-right: 0;
          margin-left: 0;
          width: 100%;
          max-width: 100%;
          min-width: 100%;
          height: 100%;
      }

      #upload-wrapper {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    margin-top: 50px;
    overflow: hidden;
    background: #F5F5F5;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 1px 1px 3px #AAA;
}
#upload-wrapper h3 {
    padding: 0px 0px 10px 0px;
    margin: 0px 0px 20px 0px;
    margin-top: -30px;
    border-bottom: 1px dotted #DDD;
}
#upload-wrapper input[type=file] {
    border: 1px solid #DDD;
    padding: 6px;
    background: #FFF;
    border-radius: 5px;
}
#upload-wrapper #submit-btn {
    border: none;
    padding: 10px;
    background: #61BAE4;
    border-radius: 5px;
    color: #FFF;
}
#output{
    padding: 5px;
    font-size: 12px;
}
#output img {
    border: 1px solid #DDD;
    padding: 5px;
}

/* progress bar style */
#progressbox {
    border: 1px solid #92C8DA;
    padding: 1px;
    position:relative;
    width:400px;
    border-radius: 3px;
    margin: 10px;
    display:none;
    text-align:left;
}
#progressbar {
    height:20px;
    border-radius: 3px;
    background-color: #77E0FA;
    width:1%;
}
#statustxt {
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}

#outputCode {
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */    
    text-align: left;
    visibility: hidden;
}

</style>
  

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Lessons Management</h3>
           
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

                                        <div class="col-lg-4 col-sm-12">
                                            
                                            <form id="ccForm" class="relative">

                                                
                                            <div class="form-group">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input id="name" name="title" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                <label for="" class="form-label">Sections</label>
                                                    <div class="clonedata" style="display: flex;">
                                                        <div class="col-span-10 lg:col-span-10 col-lg-10" style="width: 100%; max-width: 80%;">
                                                            <textarea rows="6"  class="form-control"  placeholder="" name="details[]"></textarea>
                                                        </div>   
                                                        <div class="col-span-2 lg:col-span-2 col-lg-2" style="width: 100%; max-width: 18%; margin-left: 10px; display: flex; align-items: center; justify-content: center;text-align: center;">
                                                            <button type="button" id="addRow" class="mb-xs mr-xs btn btn-info addmore mr-1"><i class="fa fa-plus"></i></button>
                                                      
                                                       </div>
                                                    </div>
                                                    <div id="newRow"></div>
                                                </div>
                                
                                                <div class="form-group loader">

                                                   
                                                </div>
                                
                                                <div class="form-group">
                                
                                                    <label for="title" class="form-label">Order</label>
                                                    <input id="order" name="order" type="text" class="form-control" placeholder="">
                                
                                                </div>
                                                <div class="form-group">
                                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                                    <input id="thumbnail" type="text" class="form-control" name ="thumbnail" value="" placeholder="eg https://www.wikihow.com/images/thumb/d/db/Get-the-URL-for-Pictures-Step-2-Version-6.jpg/aid597183-v4-728px-Get-the-URL-for-Pictures-Step-2-Version-6.jpg">
                                                   
                                                </div>
                                           
                                 
                                                <div class="form-group" align="center">
                                                <input type="hidden" class="pid" name="pid">
                                                <button class="btn btn-lg btn-primary mr-1 mb-2 insertMe" id="create">Create</button>
                                                </div>
                                                        
                                                <div class="cover col-span-12 hidden" id="icontents"></div>
                                
                                                 </form>
                                                 <div id="resp" class="resp"></div>


                                        </div>

                                        <div class="col-lg-8">
                                                        <div class="tblDiv hidden">
                                                           
                                                        <table class="table display table_view" id="cc_Tbl" style="width: 100%;">
                                                            <thead>
                                                            <tr> 
                                                                <th>Thumbnail</th>
                                                                <th>URL</th>
                                                                <th>Lesson Title</th>
                                                                <th>Course Name</th>
                                                                <th>Description</th>
                                                                <th>Order</th>
                                                                <th>Created Date</th>
                                                                <th>Actions</th>
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
                <input type="hidden" id="icatId" value="" />
                <button type="button" class="btn btn-light-primary font-weight-bold closeMe" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger del-btn font-weight-bold delAddr" >Yes, delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title warning-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body upload-msg">
               
            </div>
           
            <div class="form-group p-5">
                        <!--<input type="file" class="fonr-control" name="file">-->
                        <div id="upload-wrapper">
                            
                               
                                <span class=""></span>
                               
                                    <input name="image_file" id="imageInput" type="file" />
                                    
                                    <img src="../assets/images/Loading-2.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                                
                                <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                                <div id="output"></div>
                                <textarea id="outputCode"></textarea>
                           
                        </div>
            </div>
            
            <div class="modal-footer">
            	<input type="hidden" id="aId" name="id" value="" />
                <input type="hidden" id="icatId"  value="" />
                <button type="button" class="btn btn-light-primary font-weight-bold closeMe" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger del-btn font-weight-bold uploadAddrs" id="submit-btn" >Upload</button>
            </div>
        </div>
    </form>
    </div>
</div>

<?php
    include("customizer.php");
    include("footer.php");
?>
<script src="../assets/js/lesson_module.js"></script>