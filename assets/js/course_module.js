var cc_Tbl;


$(document).ready(function() {
    $('.staSpinner').hide();
    
    $(".trackit").hide();

    $('.i_loading').removeClass('hidden');

    var displaySideItems = 2;
    $('.loader').html(createSkeleton(displaySideItems));
    
   
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
      loadTopic();
      loadCats();
    }, 1000);


    function loadTopic(){
      $('.i_loading').addClass('hidden');
      $('.tblDiv').removeClass('hidden');
   cc_Tbl = $('#cc_Tbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 460,
    'ajax': {
      type: 'POST',
      'url': '../inc/course/getAllCourses.php',
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
              
                /*if(xhr.responseText.includes("stdClass::$success")){
                    $('.savingDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not foundNot Found'){
                    $('.savingDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.savingDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }*/
                
                
            }
    }
});

}


function  loadCats(){
  //
  $.ajax({
    url: '../admin/loadCategory.php',
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


});



$(document).on('click', '.insertMe', function(e) {
 e.preventDefault();
 $('.overlay').removeClass('hidden');
 $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Processing...');
 //$('.btnLoad').prop("disabled",true);
 $('.btnLoad').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Processing...');
  
 $.ajax({
    url: "../inc/course/saveCourse.php",
    method: "post",
    data:  new FormData($("#ccForm")[0]),
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function(data){
    if(data.trim() == "done")
    { 
       
   $('#resp').empty().show().html('<div class="alert alert-success">Course created successfully</div>').delay(9000).fadeOut(9000);
           
    $('#ccForm')[0].reset();
    $('.insertMe').html("Create").prop("disabled",false);
    cc_Tbl.ajax.reload(null, false);
    $('.overlay').addClass('hidden');
    $('.btnLoad').html('');

    }
    else{
        $('.insertMe').html("Create").prop("disabled",false);
        $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
        $('.overlay').addClass('hidden');
        $('.btnLoad').html('');
    }

    },
    error: function (error) {
      $('.insertMe').html("Create").prop("disabled",false);
     $('.overlay').addClass('hidden');
     $('.btnLoad').html('');
     var seconds = 7;  
  
     if(error.responseText.includes("stdClass::$success")){

     setInterval(function () {  
       seconds--;  
       $("#lblCount").html(seconds);  
       if (seconds == 0) {  
          window.location = "../admin/logout";  
       }  
   }, 1000); 

     $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
     
      }else  if(error.responseText == ""){
        $('.resp').empty().show().delay(9000).fadeOut(9000);
        $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
      }else{
        $('.resp').empty().show().delay(9000).fadeOut(9000);
        $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
        
      }
    }
  });
	

  });



  $(document).on('click', '.editDetils', function() {

    var id = $(this).attr('id');
    var title = $(this).attr('data-name');
    var topic = $(this).attr('data-topicId');
    var category = $(this).attr('data-catId');
    var paid = $(this).attr('data-paid');
    var descr = $(this).attr('data-desc');
    var type = $(this).attr('data-type');
    var thumb = $(this).attr('data-thumb');

   
    if ( $(".catId option[value='"+category+"']").length ){
      $(".catId option[value='"+category+"']").prop('selected', true);
    }
    
    if ( $(".topicId option[value='"+topic+"']").length ){
      $(".topicId option[value='"+topic+"']").prop('selected', true);
    }

    if ( $(".media_type option[value='"+type+"']").length ){
      $(".media_type option[value='"+type+"']").prop('selected', true);
    }


    if ( $(".is_paid option[value='"+paid+"']").length ){
      $(".is_paid option[value='"+paid+"']").prop('selected', true);
    }

    $('.pid').val(id);
    $('#name').val(title);
    $('#descr').val(descr);
    $('#thumbnail').val(thumb);

  
   

    $('#create').html('Update').removeClass('insertMe btn-primary').addClass('updateMe btn-warning');
    $(".reloadMe").removeClass('hidden');

  });


  $(document).on('click', '.delMe', function() {
    var pid = $(this).attr('id'); 
    var category = $(this).attr('data-catId');
    var name = $(this).attr('data-name'); 

    $("#adminId").val(pid);
    $("#icatId").val(category);

    $(".warning-title").html('<i class="fa fa-exclamation-triangle text-danger"></i> Delete Warning').addClass("text-danger");
    $(".delete-msg").html('<p>You are about to delete <b class="text-info">' +name+ '</b> informations.<p><p>Please note that there is no redo after deleting.</p>  ');

   });


   $(document).on('click', '.delAddr', function() {

    $('.delAddr').html('Deleting <div class="spinner spinner-right spinner-white pr-15">')
    var pid = $("#adminId").val();
    var catid = $("#icatId").val();

    $.ajax({
      type: "POST",
      url: "../inc/course/deletecourse.php",
      data : {id : pid, cat_id : catid},
      success: function(data){
  
        if(data == "1"){
          $('.toast').addClass('alert-success').toast('show');
          $('.toast-body').html("Activated Successfully.");
          $('.theader').html("Message");
          $('.delAddr').html('Yes, delete');
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
           
           
            cc_Tbl.ajax.reload(null, false);
        }else if(data == "d"){
          $('.toast').addClass('alert-success').toast('show');
          $('.toast-body').html("De-Activated Successfully");
          $('.theader').html("Message");
          $('.delAddr').html('Yes, delete');
            cc_Tbl.ajax.reload(null, false);
        }else{
          $('.toast').addClass('alert-danger').toast('show');
          $('.delAddr').html('Yes, delete');
          if(data.includes("'success' of non-object")){
            $('.toast-body').html("No internet connection available. Check your internet connection and try again.");
            $('.theader').html("Connection Failed");
          $('.overlay').addClass('hidden');
          }else{
            $('.toast-body').html(data);
            $('.theader').html("Error Message");
          $('.overlay').addClass('hidden');
          }
         }
       
      },
      error: function (error) {
        $('.delAddr').html('Yes, delete');
        $('.toast').addClass('alert-danger').toast('show');
        $('.toast-body').html("Error occured : "+error.responseText);
        $('.theader').html("Error Message");
        $('.overlay').addClass('hidden');
     
   
      }
    });
 

   });



   $(document).on('click', '.reloadMe', function() {
    $(".reloadMe").addClass('hidden');
    $(".trackit").show().fadeIn();
    $('#ccForm')[0].reset();
    $('.idescr').hide();
   
    $('#create').html('Create').removeClass('updateMe btn-warning').addClass('insertMe btn-primary').prop("disabled",false);

    setTimeout(function() {
        $(".trackit").hide();
    }, 1000);
   

   });



  $(document).on('click', '.updateMe', function(e) {
    e.preventDefault();
   
    
    $('.updateMe').html("Processing...").prop("disabled",true);
    $('.overlay').removeClass('hidden');
    $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Processing...');
     
    $.ajax({
       url: "../inc/course/courseUpdate.php",
       method: "post",
       data:  new FormData($("#ccForm")[0]),
       contentType: false,
       cache: false,
       processData: false,
       async: false,
       beforeSend: function() {
        // setting a timeout
        $('.updateMe').html("Updating...").prop("disabled",true);
        $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Updating...');
       },
       success: function(data){
       if(data == "done")
       { 
          
     

        $('#resp').empty().show().html('<div class="alert alert-success">Updated successfully</div>').delay(9000).fadeOut(9000);
   

           $('#ccForm')[0].reset();
           cc_Tbl.ajax.reload(null, false);
           $(".reloadMe").addClass('hidden');
           $('.idescr').hide();
           
           
         
           $('#create').html('Create').removeClass('updateMe btn-warning').addClass('insertMe btn-primary').prop("disabled",false);
           $('.overlay').addClass('hidden');
   
            
       }
       else{
   
        $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
        $('.updateMe').html('Try Again').addClass('btn-danger').prop("disabled",false);
        $('.overlay').addClass('hidden');
          
       }
   
       },
       error: function (error) {
         $('.updateMe').html("Update").prop("disabled",false);
        $('.overlay').addClass('hidden');
        var seconds = 7;  
     
        if(error.responseText.includes("stdClass::$success")){
   
        setInterval(function () {  
          seconds--;  
          $("#lblCount").html(seconds);  
          if (seconds == 0) {  
             window.location = "../admin/logout";  
          }  
      }, 1000); 
   
        $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
        
         }else  if(error.responseText == ""){
           $('.resp').empty().show().delay(9000).fadeOut(9000);
           $('.resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
         }else{
           $('.resp').empty().show().delay(9000).fadeOut(9000);
           $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
           
         }
       }
     });
     
   
     });






//Update course category status

$(document).on('click', '.ustaDetails', function() {
  var checkStatus = this.checked ? 1 : 0;
  var id = $(this).attr('id');
  var catid = $(this).attr('data-catId');
  $.ajax({
    type: "POST",
    url: "../inc/course/course_status_update.php",
    data : {id: id, catid: catid, sta:checkStatus},
    success: function(data){

      if(data == "done"){
        $('.toast').addClass('alert-success').toast('show');
        $('.toast-body').html("Activated Successfully.");
        $('.theader').html("Message");
         
         
          cc_Tbl.ajax.reload(null, false);
      }else if(data == "d"){
        $('.toast').addClass('alert-success').toast('show');
        $('.toast-body').html("De-Activated Successfully");
        $('.theader').html("Message");
         
          cc_Tbl.ajax.reload(null, false);
      }else{
        $('.toast').addClass('alert-danger').toast('show');
        if(data.includes("'success' of non-object")){
          $('.toast-body').html("No internet connection available. Check your internet connection and try again.");
          $('.theader').html("Connection Failed");
        $('.overlay').addClass('hidden');
        }else{
          $('.toast-body').html(data);
          $('.theader').html("Error Message");
        $('.overlay').addClass('hidden');
        }
       }
     
    },
    error: function (error) {
      $('.toast').addClass('alert-danger').toast('show');
      $('.toast-body').html("Error occured : "+error.responseText);
      $('.theader').html("Error Message");
      $('.overlay').addClass('hidden');
   
 
    }
  });
  
  });
  

