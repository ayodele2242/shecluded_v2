var cc_Tbl;

$(document).ready(function() {
  $('.staSpinner').hide();
  $(".trackit").hide();

  var displaySideItems = 1;
    $('.loadTopic').html(createSkeleton(displaySideItems));
    
    setTimeout(function(){
      loadTopic();
    }, 1000);
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

    //Second Loader
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

    cc_Tbl = $("#cc_Tbl").DataTable({
      "processing": true,
      "pageLength": 50,
      dom: "Bfrtip",
       "columns": [
        {
           "title": "Category Name",
           "data": "name"
         },
         {
           "title": "Status",
           "data": "status"
         },
         {
           "title": "Action",
           "data": "btn"
         }
       ]
     });

  function  loadTopic(){
    //
    $.ajax({
      url: '../admin/loadTopic.php',
      dataType: 'html',
      success: function(data) {
        $('.loadTopic').html(data);
      },
      error: function (error) {
       var seconds = 7;  
       $('.tblDiv').addClass('hidden');
       console.log(error.responseText);
       if(error.responseText.includes("stdClass::$success")){
 
       $('.loadTopic').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired</div>');
       
   }else if(error.responseText.includes("success' of non-object")){
 
  

    $('.loadTopic').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
    
}else if(error.responseText == ""){
     $('.loadTopic').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
   }else{
     $('.loadTopic').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
    
   }
      }
    });
  }

  function loadFunction() {
   
    $.ajax({
      url: '../inc/course/getCourse_Categories.php',
      dataType: 'json',
      success: function(json) {
        if(json.success == true){
        $('.tblDiv').removeClass('hidden');
        $('.i_loading').addClass('hidden');  
        cc_Tbl.rows.add(json.data).draw();
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

 
  $('.insertMe').prop("disabled",true);
  $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Processing...').removeClass('hidden');
  
 $.ajax({
    url: "../inc/course/saveCourse_Category.php",
    method: "post",
    data:  new FormData($("#ccForm")[0]),
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function(data){
    if(data.trim() == "done")
    { 
       
   $('.resp').empty().show().html('<span class="alert alert-success">Course Category created successfully</span>').delay(9000).fadeOut(9000);
           
    $('#ccForm')[0].reset();
    //cc_Tbl.ajax.reload(null, false);
    setTimeout(function(){
      location.reload();
    }, 1000);
        
    $('.insertMe').html("Create").prop("disabled",false);
    $('.overlay').addClass('hidden');
    
    }
    else{
     
        $('.resp').empty().show().html('<span class="alert alert-danger">'+data+'</span>').delay(9000).fadeOut(9000);
  
        $('.insertMe').html("Create").prop("disabled",false);
        $('.overlay').addClass('hidden');
       
       
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
    var title = $(this).attr('data-name');
    var topic = $(this).attr('data-topicId');
   
    
    if ( $(".catId option[value='"+topic+"']").length ){
      $(".catId option[value='"+topic+"']").prop('selected', true);

    }

    $('.pid').val(id);
    $('#name').val(title);
    $('.idescr').show();

    $('#create').html('Update').removeClass('insertMe btn-primary').addClass('updateMe btn-warning');
    $(".reloadMe").removeClass('hidden');

  });


  $(document).on('click', '.delMe', function() {
    var pid = $(this).attr('id'); 
    var name = $(this).attr('data-name'); 

    $("#adminId").val(pid);

    $(".warning-title").html('<i class="fa fa-exclamation-triangle text-danger"></i> Delete Warning').addClass("text-danger");
    $(".delete-msg").html('<p>You are about to delete <b class="text-info">' +name+ '</b> informations.<p><p>Please note that there is no redo after deleting.</p>  ');

   });


   $(document).on('click', '.delAddr', function() {

    $('.delAddr').html('Deleting <span class="spinner spinner-right spinner-white pr-15">')
    var pid = $("#adminId").val();
    $.post("../includes/deletecourse_category.php", {"id": pid, }, 
   function(data) {
       if(data == 1){
            
        $('#resp').empty().show().html('<span class="alert alert-success">Deleted successfully</span>').delay(9000).fadeOut(9000);
   
           
             $('.delAddr').html('Yes, delete');
            $('#deleteModal').modal('toggle');
            cc_Tbl.ajax.reload(null, false);
           
       }else{
        $('#resp').empty().show().html('<span class="alert alert-danger">'+data+'</span>').delay(9000).fadeOut(9000);
       
       $('.delAddr').html('Yes, delete');
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
   
    
    $('.updateMe').prop("disabled",true);
    $('.overlay').html('<img src="../assets/gif/loading.gif" width="24" height="24"/> Updating...').removeClass('hidden');
     
    $.ajax({
       url: "../inc/course/courseCategory_Update.php",
       method: "post",
       data:  new FormData($("#ccForm")[0]),
       contentType: false,
       cache: false,
       processData: false,
       async: false,
       success: function(data){
       if(data.trim() == "done")
       { 
          
        $('#resp').empty().show().html('<span class="alert alert-success">Updated successfully</span>').delay(9000).fadeOut(9000);
           $('#ccForm')[0].reset();
           //cc_Tbl.ajax.reload(null, false);
           $(".reloadMe").addClass('hidden');
           $('.idescr').hide();
        
           $('#create').html('Create').removeClass('updateMe btn-warning').addClass('insertMe btn-primary').prop("disabled",false);
           setTimeout(function(){
            location.reload();
          }, 1000);
               
       }
       else{
   
        $('#resp').empty().show().html('<span class="alert alert-danger">'+data+'</span>').delay(9000).fadeOut(9000);
        $('.updateMe').html('Try Again').addClass('btn-danger').prop("disabled",false);
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






//Update course category status

$(document).on('click', '.ustaDetails', function() {
  var checkStatus = this.checked ? 1 : 0;
  var id = $(this).attr('id');
  $(".iam_loading").html("Updating Status...").show();
  $.post("../inc/course/course_category_status_update.php", {"id": id, "sta":checkStatus, }, 
  function(data) {
  if(data == "done"){
     
      $('#resp').empty().show().html('<span class="alert alert-success"> Activated Successfully</span>').delay(9000).fadeOut(9000);

      //cc_Tbl.ajax.reload(null, false);
  }else if(data == "d"){
      $('#resp').empty().show().html('<span class="alert alert-success"> De-Activated Successfully</span>').delay(9000).fadeOut(9000);

      //cc_Tbl.ajax.reload(null, false);
  }else{
    $('#resp').empty().show().html('<span class="alert alert-danger">'+data+'</span>').delay(9000).fadeOut(9000);
  }
  });
  
  });
  

