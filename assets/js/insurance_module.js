var plantbl;

$(document).ready(function() {
var displaySideItems = 1;
$('.loader').html(createSkeleton(displaySideItems));
$('.i_loading').removeClass('hidden');


function createSkeleton(limit){
  var mskeletonHTML = '';
  for(var i = 0; i < limit; i++){
    mskeletonHTML += '<div class="ph-item">';
    mskeletonHTML += '<div>';
    mskeletonHTML += '<div class="ph-row">';
    mskeletonHTML += '<div class="ph-col-4  big"></div><div class="ph-col-8  empty"></div>';
    mskeletonHTML += '<div class="ph-col-12  big"></div>';
    mskeletonHTML += '</div>';
    mskeletonHTML += '</div>';
    mskeletonHTML += '</div>';
  }
  return mskeletonHTML;
}

var displayLoadItems = 3;
    $('.i_loading').html(lcreateSkeleton(displayLoadItems));
    

    function lcreateSkeleton(limit){
      var lskeletonHTML = '';
      for(var i = 0; i < limit; i++){
        lskeletonHTML += '<div class="ph-item">';
        lskeletonHTML += '<div>';
        lskeletonHTML += '<div class="ph-row">';
        lskeletonHTML += '<div class="ph-col-12 big"></div>';
        lskeletonHTML += '<div class="ph-col-12"></div>';
        lskeletonHTML += '<div class="ph-col-12 big"></div>';
        lskeletonHTML += '<div class="ph-col-12 "></div>';
        lskeletonHTML += '</div>';
        lskeletonHTML += '</div>';
        lskeletonHTML += '</div>';
      }
      return lskeletonHTML;
    }


setTimeout(function(){
    loadPlans();
    loadAllPlans();
  }, 1000);

  function  loadPlans(){
    //
    $.ajax({
      url: '../admin/loadInsurancePlans.php',
      dataType: 'html',
      success: function(data) {
        $('.loader').html(data);
      },
      error: function (error) {
       var seconds = 7;  
       if(error.responseText.includes("stdClass::$success")){
  
       $('.loader').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired</div>');
       
   }else if(error.responseText.includes("success' of non-object")){
    $('.loader').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
    
  }else if(error.responseText == ""){
     $('.loader').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
   }else{
     $('.loader').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
    
   }
      }
    });
  }

  function  loadAllPlans(){
    //
    $('.i_loading').addClass('hidden');
    $('.tblDiv').removeClass('hidden');
 plantbl = $('#plantbl').DataTable({
  'processing': true,
   dom: 'Bfrtip',
   "scrollX": true,
   "scrollY": 460,
  'ajax': {
    type: 'POST',
    'url': '../inc/insurance/getPlans.php',
    "method": "POST",
    error: function (xhr, error, code)
          {

            var seconds = 7;  
            $('.tblDiv').addClass('hidden');
            $('.i_loading').removeClass('hidden');

            setInterval(function () {  
              seconds--;  
              $("#lblCount").html(seconds);  
              if (seconds == 0) {  
                 window.location = "../admin/logout";  
              }  
          }, 1000); 

            console.log(error.responseText);
            if(xhr.responseText.includes("stdClass::$success")){
      
            $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
            
            }else if(xhr.responseText.includes("success' of non-object")){
            $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
            }else if(xhr.responseText == ""){
              $('.i_loading').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
            }else if(code == 'not foundNot Found'){
              $('.i_loading').html('<div class="alert alert-danger">The system could not locate the url.</div>');
             } else{
              $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
            
            }
            
           
              
          }
  }
});

  }



$(document).on('click', '.addPackage', function(e) {
    e.preventDefault();
   
    
    
    $('.addPackage').prop("disabled",true);

     
    $.ajax({
       url: "../inc/insurance/savePackage.php",
       method: "post",
       data:  new FormData($("#packageForm")[0]),
       contentType: false,
       cache: false,
       processData: false,
       async: false,
       beforeSend: function() {
        $(".addPackage").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Please wait');
        },
       success: function(data){
       if(data.trim() == "done")
       { 
          
      $('#resp').empty().show().html('<div class="alert alert-success">Insurance package created successfully</div>').delay(9000).fadeOut(9000);
              
       $('#packageForm')[0].reset();
       $('.addPackage').html("Create").prop("disabled",false);
       
     
   
       }
       else{
           $('.addPackage').html("Create").prop("disabled",false);
           $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
   
       }
   
       }, error: function (error) {
         var seconds = 7;  
         $('.tblDiv').addClass('hidden');
         $('.addPackage').html("Create").prop("disabled",false);
         if(error.responseText.includes("stdClass::$success")){
   
         setInterval(function () {  
           seconds--;  
           $("#lblCount").html(seconds);  
           if (seconds == 0) {  
              window.location = "../admin/logout";  
           }  
       }, 1000); 
   
      
   
         $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
         
     }else if(error.responseText.includes("success' of non-object")){
   
      setInterval(function () {  
        seconds--;  
        $("#lblCount").html(seconds);  
        if (seconds == 0) {  
           window.location = "../admin/logout";  
        }  
    }, 1000); 
   
      $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
      
   }else if(error.responseText == ""){
       $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
     }else{
       $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
      
     }
        }
     });
       
   
     });


//Update insurance package
$(document).on('click', '.updatePackage', function(e) {
    e.preventDefault();
   
    
    
    $('.updatePackage').prop("disabled",true);

     
    $.ajax({
       url: "../inc/insurance/updatePackage.php",
       method: "post",
       data:  new FormData($("#packageForm")[0]),
       contentType: false,
       cache: false,
       processData: false,
       async: false,
       beforeSend: function() {
        $(".updatePackage").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Please wait');
        },
       success: function(data){
       if(data.trim() == "done")
       { 
          
      $('#resp').empty().show().html('<div class="alert alert-success">Insurance package updated successfully</div>').delay(9000).fadeOut(9000);
              
       $('#packageForm')[0].reset();
       $('.updatePackage').html("Update").prop("disabled",false);
       
     
   
       }
       else{
           $('.updatePackage').html("Uodate").prop("disabled",false);
           $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
   
       }
   
       }, error: function (error) {
         var seconds = 7;  
         $('.tblDiv').addClass('hidden');
         $('.updatePackage').html("Update").prop("disabled",false);
         if(error.responseText.includes("stdClass::$success")){
   
         setInterval(function () {  
           seconds--;  
           $("#lblCount").html(seconds);  
           if (seconds == 0) {  
              window.location = "../admin/logout";  
           }  
       }, 1000); 
   
      
   
         $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
         
     }else if(error.responseText.includes("success' of non-object")){
   
      setInterval(function () {  
        seconds--;  
        $("#lblCount").html(seconds);  
        if (seconds == 0) {  
           window.location = "../admin/logout";  
        }  
    }, 1000); 
   
      $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
      
   }else if(error.responseText == ""){
       $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
     }else{
       $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
      
     }
        }
     });
       
   
     });






     //add plan

     $(document).on('click', '.addPlan', function(e) {
        e.preventDefault();
        $(".addPlan").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Please wait');
        
        
        $('.addPlan').prop("disabled",true);
    
         
        $.ajax({
           url: "../inc/insurance/savePlan.php",
           method: "post",
           data:  new FormData($("#planForm")[0]),
           contentType: false,
           cache: false,
           processData: false,
           async: false,
           beforeSend: function() {
            $(".addPlan").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Please wait');
            },
           success: function(data){
           if(data.trim() == "done")
           { 
              
          $('#resp').empty().show().html('<div class="alert alert-success">Insurance plan created successfully</div>').delay(9000).fadeOut(9000);
                  
           $('#planForm')[0].reset();
           $('.addPlan').html("Create").prop("disabled",false);
           plantbl.ajax.reload(null, false);
         
       
           }
           else{
               $('.addPlan').html("Create").prop("disabled",false);
               $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
       
           }
       
           }, error: function (error) {
             var seconds = 7;  
             $('.addPlan').html("Create").prop("disabled",false);
             if(error.responseText.includes("stdClass::$success")){
       
             setInterval(function () {  
               seconds--;  
               $("#lblCount").html(seconds);  
               if (seconds == 0) {  
                  window.location = "../admin/logout";  
               }  
           }, 1000); 
       
          
       
             $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
             
         }else if(error.responseText.includes("success' of non-object")){
       
          setInterval(function () {  
            seconds--;  
            $("#lblCount").html(seconds);  
            if (seconds == 0) {  
               window.location = "../admin/logout";  
            }  
        }, 1000); 
       
          $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
          
       }else if(error.responseText == ""){
           $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
         }else{
           $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
          
         }
            }
         });
           
       
         });



         //Update Plan

         $(document).on('click', '.updatePlan', function(e) {
            e.preventDefault();
            
            $("#planBtn").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Please wait');
            
            
            $('.planBtn').prop("disabled",true);
        
             
            $.ajax({
               url: "../inc/insurance/updatePlan.php",
               method: "post",
               data:  new FormData($("#planForm")[0]),
               contentType: false,
               cache: false,
               processData: false,
               async: false,
               beforeSend: function() {
                $(".planBtn").html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Updating');
                },
               success: function(data){
               if(data.trim() == "done")
               { 
                plantbl.ajax.reload(null, false);
                $('#resp').empty().show().html('<div class="alert alert-success">Insurance Plan updated successfully</div>').delay(9000).fadeOut(9000);
                      
                $('#planForm')[0].reset();
                $(".img").removeClass('hidden');
                $(".reloadMe").addClass('hidden');
                $(".planBtn").html('Create').addClass("addPlan btn-primary");
                $(".planBtn").removeClass("updatePlan btn-warning");
               
             
           
               }
               else{
                   $('.planBtn').html("Create").prop("disabled",false);
                   $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
           
               }
           
               }, error: function (error) {
                 var seconds = 7;  
                 $('.planBtn').html("Create").prop("disabled",false);
                 if(error.responseText.includes("stdClass::$success")){
           
                 setInterval(function () {  
                   seconds--;  
                   $("#lblCount").html(seconds);  
                   if (seconds == 0) {  
                      window.location = "../admin/logout";  
                   }  
               }, 1000); 
           
              
           
                 $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
                 
             }else if(error.responseText.includes("success' of non-object")){
           
              setInterval(function () {  
                seconds--;  
                $("#lblCount").html(seconds);  
                if (seconds == 0) {  
                   window.location = "../admin/logout";  
                }  
            }, 1000); 
           
              $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
              
           }else if(error.responseText == ""){
               $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
             }else{
               $('.resp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
              
             }
                }
             });
               
           
             });


        $(document).on('click', '.ustaDetails', function() {
            var checkStatus = this.checked ? 1 : 0;
            var id = $(this).attr('id');
            var catid = $(this).attr('data-catId');
            $(".iam_loading").html("Updating Status...").show();
            $.post("../inc/insurance/plan_status_update.php", {"id": id, "catid": catid, "sta":checkStatus, }, 
            function(data) {
            if(data == "done"){
                
                $('.resp').empty().show().html('<div class="alert alert-success"> Activated Successfully</div>').delay(9000).fadeOut(9000);
            
                planTbl.ajax.reload(null, false);
            }else if(data == "d"){
                $('.resp').empty().show().html('<div class="alert alert-success"> De-Activated Successfully</div>').delay(9000).fadeOut(9000);
            
                planTbl.ajax.reload(null, false);
            }else{
                $('.resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
            }
            });
        
        });       

     $(document).on('click', '.editDetils', function() {

        var pid = $(this).attr('id');
        var ds = $(this).attr('data-descr');
        var name = $(this).attr('data-title');
        

        $("#name").val(name);
        $("#desc").val(ds);
        $(".pid").val(pid);

        $(".img").addClass('hidden');
        $(".reloadMe").removeClass('hidden');
        $(".planBtn").removeClass("addPlan btn-primary");
        $(".planBtn").html('Update').addClass("updatePlan btn-warning");
     });

     $(document).on('click', '.reloadMe', function() {
   
        $('#planForm')[0].reset();
        $(".img").removeClass('hidden');
        $(".reloadMe").addClass('hidden');
        $(".planBtn").html('Create').addClass("addPlan btn-primary");
        $(".planBtn").removeClass("updatePlan btn-warning");
       
       });
    });

    

    $(document).on('click', '.viewPackages', function() {

        var pid = $(this).attr('id');
        var name = $(this).attr('data-title');

        $('.planForm').addClass('hidden');
        $('.loadPlansPck').html('<img src="../assets/gif/loading.gif" width="30" height="30" /> Loading').removeClass('hidden');
       

        $('.leftDiv').removeClass('col-lg-4').addClass('col-lg-6');
        $('.rightDiv').removeClass('col-lg-8').addClass('col-lg-6');

        $.ajax({
            url: "../admin/getPlanPackage.php",
            method: "post",
            data:  {id:pid, name:name},
            success: function(data){
                $('.loadPlansPck').html(data);
                $('.loadPlansPck').append('<button class="btn btn-danger btn-small closePlan">Close</button>');
        
            }, error: function (error) {
                $('.loadPlansPck').append('<button class="btn btn-danger btn-small closePlan">Close</button>');
              var seconds = 7;  
              
              if(error.responseText.includes("stdClass::$success")){
        
              setInterval(function () {  
                seconds--;  
                $("#lblCount").html(seconds);  
                if (seconds == 0) {  
                   window.location = "../admin/logout";  
                }  
            }, 1000); 
        
           
        
              $('.loadPlansPck').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
              
          }else if(error.responseText.includes("success' of non-object")){
        
           setInterval(function () {  
             seconds--;  
             $("#lblCount").html(seconds);  
             if (seconds == 0) {  
                window.location = "../admin/logout";  
             }  
         }, 1000); 
        
           $('.loadPlansPck').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
           
        }else if(error.responseText == ""){
            $('.loadPlansPck').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
          }else{
            $('.loadPlansPck').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
           
          }
             }
          });
        

       
     });



    
     $(document).on('click', '.closePlan', function() {
        $('.planForm').removeClass('hidden');
        $('.leftDiv').addClass('col-lg-4').removeClass('col-lg-6');
        $('.rightDiv').addClass('col-lg-8').removeClass('col-lg-6');
        $('.loadPlansPck').html("").addClass('hidden')

     });