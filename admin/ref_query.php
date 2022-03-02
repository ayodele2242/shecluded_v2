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
            <h3 class="content-header-title mb-0">Transaction Reference Search</h3>
           
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
                                                            placeholder="Enter ref. number">
                                                        <div class="form-control-position">
                                                            <i class="spinner feather icon-refresh-cw hidden"></i>
                                                        </div>
                                                        <span class="resp"></span>
                                                    </fieldset>      
                                                 </div>
                                            </div>

                                           
                                                <div class="col-12  refTblDiv ">

                                                <table class="table table-striped  file-export refTbl" id="refTbl">
                                                        <thead>
                                                            <tr>
                                                            <th class="whitespace-nowrap">CLIENT</th>
                                                            <th class="whitespace-nowrap">AMOUNT</th>
                                                            <th class="whitespace-wrap">NARRATION</th>
                                                            <th class="whitespace-nowrap">STATUS</th>
                                                            <th class="whitespace-nowrap">TIMESTAMP</th>
                                                            <th class="whitespace-nowrap">TARGET</th>
                                                            </tr>
                                                        </thead>
                                        
                                                    </table>
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

    <div id="userModal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" >
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto title-name"></h2> 
                           
                        </div> <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body " id="user_contents">
                        

                        </div> <!-- END: Modal Body -->
                        
                   
                    </div>
                    
                </div>
    </div> 

<?php
    include("customizer.php");
    include("footer.php");
?>

<script>
var refTbl;

$(document).ready(function() {

    refTbl = $("#refTbl").DataTable({
    "processing": true,
    dom: "Bfrtip",
     "columns": [
      {
         "title": "CLIENT",
         "data": "name"
       },
       {
         "title": "AMOUNT",
         "data": "amount"
       },
       {
         "title": "NARRATION",
         "data": "narration"
       },
       {
         "title": "STATUS",
         "data": "status"
       },
       {
        "title": "TIMESTAMP",
        "data": "date"
      },
       {
         "title": "TARGET",
         "data": "dest"
       }
     ]
   });
   
var delay = (function() {
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$(".search-box").keyup(

    function () {
        delay(function () {
          var keyword = $(".search-box").val();
          $('.tableDiv').fadeOut("slow");
          $('.refTblDiv').removeClass("hidden");
          $('.refTblDiv').fadeIn("slow");
          
          if(keyword == ""){
            $(".spinner").addClass('hidden');
          }else{         
            $(".spinner").removeClass('hidden');
            $.ajax({
                url: '../inc/transactions/searchRef.php',
                type:'POST',
                data: {"keyword":  keyword},
                dataType: 'json',
                cache: false,
               
                success: function(json) {
                  if(json.nouser == ''){
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html("Transaction Reference not found.");
                      $('.spinner').addClass('hidden');
                      $('.theader').html("Error Message");
                     refTbl.clear().draw();
                  }else{    

                   refTbl.clear().draw();
                   refTbl.rows.add(json.data).draw();
            
                   $('.spinner').addClass('hidden');
                   
                   }
                },
                error: function (response) {
                  $('html, body').animate({
                    scrollTop: $('.toast').offset().top - 50
                  }, 'slow');
          
                    if(response.responseText.includes("404")){      
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html("The requested url is not found. It could have been moved.");
                      $('.spinner').addClass('hidden');
                    }else if(response.responseText.includes("Warning")){              
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html(response.responseText);
                      $('.spinner').addClass('hidden');
                    }else if(response.responseText.includes("open stream")){              
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html("There is an error in the script.");
                      $('.spinner').addClass('hidden');
                    } else{
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html(response.responseText);
                      $('.spinner').addClass('hidden');        
                    }

                    $('.theader').html("Error Message");
                    
                }
            });
          }
        }, 500);
    }
     
);


 });
</script>

<script>
$(document).on('click', '.userInfo', function() {

var pid = $(this).attr('id');
var name = $(this).attr('data-name');
$('#user_contents').html('Loading. Please wait...'); // leave this div blank
$('.title-name').html('<span style="font-weight:bolder;">'+name+'\'s</span> Details'); 

$.ajax({
url: '../inc/client/userinfo.php',
type: 'POST',
data: 'client_id='+pid,
dataType: 'html'
})
.done(function(data){
    $('#user_contents').html(data); // load here
    $('.loading').hide();
})
.fail(function(){
    $('#user_contents').html('<span style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> Something went wrong, Please try again...</span>');
    $('.loading').hide();
});


});


</script>