var ccTbl;


$(document).ready(function() {
    $('.staSpinner').hide();
    
    $(".trackit").hide();

    var displaySideItems = 3;
    $('.i_loading').html(createSkeleton(displaySideItems));
    

    function createSkeleton(limit){
      var mskeletonHTML = '';
      for(var i = 0; i < limit; i++){
        mskeletonHTML += '<div class="ph-item">';
        mskeletonHTML += '<div>';
        mskeletonHTML += '<div class="ph-row">';
        mskeletonHTML += '<div class="ph-col-12 big"></div>';
        mskeletonHTML += '<div class="ph-col-12"></div>';
        mskeletonHTML += '<div class="ph-col-12 big"></div>';
        mskeletonHTML += '<div class="ph-col-12 "></div>';
        mskeletonHTML += '</div>';
        mskeletonHTML += '</div>';
        mskeletonHTML += '</div>';
      }
      return mskeletonHTML;
    }

    ccTbl = $("#ccTbl").DataTable({
      "processing": true,
      "pageLength": 50,
      dom: "Bfrtip",
       "columns": [
        {
           "title": "Thumbnail",
           "data": "img"
         },
         {
           "title": "Title",
           "data": "title"
         },
         {
           "title": "Description",
           "data": "descr"
         },
         {
           "title": "Action",
           "data": "btn"
         }
       ]
     });

     function loadFunction() {
   
      $.ajax({
        url: '../inc/course/getCourse_Title.php',
        dataType: 'json',
        success: function(json) {
          if(json.success == true){
          $('.tblDiv').removeClass('hidden');
          $('.i_loading').addClass('hidden');  
          ccTbl.rows.add(json.data).draw();
          }else{
           $('.i_loading').html('No data available').removeClass('hidden');
           $('.tblDiv').addClass('hidden');
          }
        },
        error: function (error) {
         var seconds = 7;  
         $('.tblDiv').addClass('hidden');
         console.log(error.responseText);
         if(error.responseText.includes("stdClass::$success")){
   
         setInterval(function () {  
           seconds--;  
           $("#lblCount").html(seconds);  
           if (seconds == 0) {  
              window.location = "../admin/logout";  
           }  
       }, 1000); 
   
      
   
         $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
         
     }else if(error.responseText.includes("success' of non-object")){
   
      setInterval(function () {  
        seconds--;  
        $("#lblCount").html(seconds);  
        if (seconds == 0) {  
           window.location = "../admin/logout";  
        }  
    }, 1000); 

      $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
      
  }else if(error.responseText == ""){
       $('.i_loading').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
     }else{
       $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
      
     }
        }
      });
     }

     loadFunction();

});



$(document).on('click', '.insertMe', function(e) {
 e.preventDefault();

 
  $('.btn').html('Please wait <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> ').prop("disabled",true);
  $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Updating...').removeClass('hidden');
  
 $.ajax({
    url: "../inc/course/saveCourse_Title.php",
    method: "post",
    data:  new FormData($("#ccForm")[0]),
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function(data){
    if(data.trim() == "done")
    { 

        $('.toast').addClass('alert-success').toast('show');        
        $('.toast-body').html("Created successfully");
        $('.theader').html("Success");
        $('#ccForm')[0].reset();
        
    setTimeout(function(){
      location.reload();
    }, 900);
        
        
        $('.insertMe').html("Create").prop("disabled",false);
        $('.overlay').addClass('hidden');
         
    }
    else{
      $('.overlay').addClass('hidden');
      $('.toast').addClass('alert-danger').toast('show');
      if(data.includes("'success' of non-object")){
        $('.toast-body').html("No internet connection available. Check your internet connection and try again.");
        $('.theader').html("Connection Failed");
        
      }else{
        $('.toast-body').html(data);
        $('.theader').html("Error Message");
      }
      
        $('.insertMe').html("Create").prop("disabled",false);
    }

    },
    error: function (error) {
      $('.insertMe').html("Create").prop("disabled",false);
      $('.overlay').addClass('hidden');
     var seconds = 7;  
     console.log(error.responseText);
     if(error.responseText.includes("stdClass::$success")){

     setInterval(function () {  
       seconds--;  
       $("#lblCount").html(seconds);  
       if (seconds == 0) {  
          window.location = "../admin/logout";  
       }  
   }, 1000); 

     $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
     
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
    var title = $(this).attr('data-title');
    var descr = $(this).attr('data-descr');
    var img = $(this).attr('data-img');
    var key = $(this).attr('data-keywords');
   


    $('.pid').val(id);
    $('#title').val(title);
    $('#descr').val(descr);
    $('#thumbnail').val(img);
    $('.ikey').val(key);

    $('#create').html('Update').removeClass('insertMe btn-primary').addClass('updateMe btn-warning');
    $(".reloadMe").removeClass('hidden');

  });


  $(document).on('click', '.delTopic', function() {
    var pid = $(this).attr('id'); 
    var name = $(this).attr('data-name'); 

    $("#adminId").val(pid);

    $(".warning-title").html('<i class="fa fa-exclamation-triangle text-danger"></i> Delete Warning').addClass("text-danger");
    $(".delete-msg").html('<p>You are about to delete <b class="text-info">' +name+ '</b> address informations.<p><p>Please note that there is no redo after deleting.</p>  ');

   });


   $(document).on('click', '.delAddr', function() {

    $('.delAddr').html('Deleting <span class="spinner spinner-right spinner-white pr-15">')
    var pid = $("#adminId").val();
    $.post("../include/deletecourseTopic.php", {"id": pid, }, 
   function(data) {
       if(data == 1){
            
            Swal.fire({
                 text: "Deleted Successfully",
                 icon: "success",
                 customClass: {
           confirmButton: "btn font-weight-bold btn-light-success"
         }
             });

           
             $('.delAddr').html('Yes, delete');
            $('#deleteModal').modal('toggle');
            ccTbl.ajax.reload(null, false);
           
       }else{
        $('.toast').addClass('alert-danger').toast('show');
        if(data.includes("'success' of non-object")){
          $('.toast-body').html("No internet connection available. Check your internet connection and try again.");
          $('.theader').html("Connection Failed");
       
        }else{
          $('.toast-body').html(data);
          $('.theader').html("Error Message");
       
        }


       $('.delAddr').html('Yes, delete');
       }
       
   });

   });

   $(document).on('click', '.reloadMe', function() {
    $(".reloadMe").addClass('hidden');
    //$(".trackit").show().fadeIn();
    $('#ccForm')[0].reset();
    //$('.ikey').show();

    $('#create').html('Create').removeClass('updateMe btn-warning').addClass('insertMe btn-primary').prop("disabled",false);

    setTimeout(function() {
        //$(".trackit").hide();
    }, 1000);
   

   });



  $(document).on('click', '.updateMe', function(e) {
    e.preventDefault();
   
    
     $('.updateMe').prop("disabled",true);
     $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Updating...').removeClass('hidden');
     
    $.ajax({
       url: "../inc/course/courseTopic_Update.php",
       method: "post",
       data:  new FormData($("#ccForm")[0]),
       contentType: false,
       cache: false,
       processData: false,
       async: false,
       success: function(data){
       if(data == "done")
       { 
        $('.resp').empty().show().html('<span class="alert alert-success">Updated successfully</span>').delay(500).fadeOut(5000);
           $('#ccForm')[0].reset();
           //ccTbl.ajax.reload(null, false);
           setTimeout(function(){
            location.reload();
          }, 700);
           $(".reloadMe").addClass('hidden');
           $('#create').html('Create').removeClass('updateMe btn-warning').addClass('insertMe btn-primary').prop("disabled",false);
           $('.overlay').addClass('hidden');
       }
       else{
        $('.resp').empty().show().html('<span class="alert alert-danger">'+data+'</span>').delay(9000).fadeOut(9000);
        $('.updateMe').html('Update').prop("disabled",false);
        $('.overlay').addClass('hidden');
       }
   
       },
       error: function (error) {
        $('.updateMe').html('Update').prop("disabled",false);
        $('.overlay').addClass('hidden');
        var seconds = 7;  
        console.log(error.responseText);
        if(error.responseText.includes("stdClass::$success")){
   
        setInterval(function () {  
          seconds--;  
          $("#lblCount").html(seconds);  
          if (seconds == 0) {  
             window.location = "../admin/logout";  
          }  
      }, 1000); 
   
        $('.resp').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
        
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








