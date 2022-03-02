var cc_Tbl;


$(document).ready(function() {
    $('.staSpinner').hide();
    $(".trackit").hide();
    $('.i_loading').removeClass('hidden');

    var displaySideItems = 1;
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
      'url': '../inc/course/getLesson.php',
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


function  loadCats(){
  //
  $.ajax({
    url: '../admin/loadCourse.php',
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

 
  $('.insertMe').html('Please wait').prop("disabled",true);
  
 $.ajax({
    url: "../inc/course/saveLesson.php",
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
    $(this).closest('#inputFormRow').remove();

    }
    else{
        $('.insertMe').html("Create").prop("disabled",false);
        $('#resp').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);

    }

    }, error: function (error) {
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



  $(document).on('click', '.editDetils', function() {
    $('#icontents').removeClass('hidden');
    $('.formDiv').removeClass('p-4');
    $('.formDiv').addClass('fitit');
    
    $('#icontents').addClass('p-4');
    var pid = $(this).attr('id');
    var ds = $(this).attr('data-desc');
    $('#icontents').html('Loading content...');
    $.ajax({
      url: '../inc/course/lessonUpdate.php',
      type: 'POST',
      data: {"id": pid, "descr":ds },
      dataType: 'html',
      success: function(data){  
        $('#icontents').html(data);         
      },error: function (error) {
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
  
       $('#icontents').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
       
        }else  if(error.responseText == ""){
          $('#icontents').empty().show().delay(9000).fadeOut(9000);
          $('#icontents').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
        }else{
          $('#icontents').empty().show().delay(9000).fadeOut(9000);
          $('#icontents').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
          
        }
      }

    })
    

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
    $.post("../inc/course/deleteLesson.php", { "id": pid, "cat_id":catid }, 
   function(data) {
       if(data == 1){
            
        $(".delete-msg").html('<div class="alert alert-success">Deleted successfully</div>');
   
           
             $('.delAddr').html('Done <i class="fa fa-check"></i>').addClass('btn-success').prop("disabled",true);
             $('.closeMe').html('Close Me');
             
             $('.modal').modal('hide');
             $('body').removeClass('modal-open');
             $('.modal-backdrop').remove();
            cc_Tbl.ajax.reload(null, false);
           
       }else{
        $(".delete-msg").html('<div class="alert alert-danger">'+data+'</div>');
       
       $('.delAddr').html('Yes, delete');
       }
       
   });

   });



   $(document).on('click', '.reloadMe', function() {
   
    $('#icontents').addClass('hidden');
    $('.formDiv').addClass('p-4');
   
   });



  




//Update course category status

$(document).on('click', '.ustaDetails', function() {
  var checkStatus = this.checked ? 1 : 0;
  var id = $(this).attr('id');
  var catid = $(this).attr('data-catId');
  $(".iam_loading").html("Updating Status...").show();
  $.post("../inc/course/course_status_update.php", {"id": id, "catid": catid, "sta":checkStatus, }, 
  function(data) {
  if(data == "done"){
     
      $('.staUpdate').empty().show().html('<div class="alert alert-success"> Activated Successfully</div>').delay(9000).fadeOut(9000);

      cc_Tbl.ajax.reload(null, false);
  }else if(data == "d"){
      $('.staUpdate').empty().show().html('<div class="alert alert-success"> De-Activated Successfully</div>').delay(9000).fadeOut(9000);

      cc_Tbl.ajax.reload(null, false);
  }else{
    $('.staUpdate').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(9000).fadeOut(9000);
  }
  });
  
  });




  //Clone input for details
 $("#addRow").click(function () {
  var html = '';
  html += '<div class="clonedata" id="inputFormRow" style="display: flex;">';
  html += '<div class="col-div-10 lg:col-div-10 col-lg-10" style="width: 100%; max-width: 80%;">';
  html += '<textarea rows="6" id="order" class="form-control"  placeholder="" name="details[]"></textarea>';
  html += '</div>';   
  html += '<div class="col-div-2 lg:col-div-2 col-lg-2" style="width: 100%; max-width: 18%; margin-left: 10px; display: flex; align-items: center; justify-content: center;text-align: center;">';
  html += '<button type="button" id="removeRow" class="mb-xs mr-xs btn btn-danger removemore"><i class="fa fa-remove"></i></button>';
  html += '</div>';
  html += '</div>';

  $('#newRow').append(html);
});

// remove row
$(document).on('click', '#removeRow', function () {
  $(this).closest('#inputFormRow').remove();
});





$(document).on('click', '.uploadMe', function() {
  var pid = $(this).attr('id'); 
  var category = $(this).attr('data-catId');
  var name = $(this).attr('data-name'); 

  $("#aId").val(pid);
  $("#icatId").val(category);

  $(".warning-title").html('<i class="fa fa-exclamation-triangle text-primary"></i>Media Upload').addClass("text-primary");
  $(".upload-msg").html('<p>You are about to upload media for <b class="text-info">' +name+ '</b>. ');

 });

 $(document).on('click', '.uploadAddrs', function() {
  var formData = new FormData($("#MyUploadForm")[0]);
  $('.upload-msg').html("Processing Upload").addClass("text-info");
  $.ajax({
    url: '../inc/course/lessonMediaUpload.php',
    type: 'POST',
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    async: false,
  })
  .done(function(data){
        if(data.trim() == "done"){
          $('.upload-msg').html("Uploaded successfully").addClass("text-success");
        }else{
          $('.upload-msg').html('<div style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+data+'</div>');
      
        }
  })
  .fail(function(){
        $('.upload-msg').html('<div style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> Something went wrong, Please try again...</div>');
        $('.loading').hide();
  });

});




//Media upload


$(document).ready(function () {
 /* $("#submit-btn").click(function () {
      beforeSubmit();
  });
  $("#outputCode").focus(function() {
      // Select all on focus; 
      var $this = $(this);
      $this.select();
      // Work around Chrome's little problem
      $this.mouseup(function() {
          // Prevent further mouseup intervention
          $this.unbind("mouseup");
          return false;
      });
  });  */    
});




//function to check file size before uploading.
function beforeSubmit() {

  $('#output').html("<b class='text-center'><img src='../images/Loading-2.gif' alt='' /> In progress...</b>");


  //check whether browser fully supports all File API
  if (window.File && window.FileReader && window.FileList && window.Blob) {

      if (!$('#imageInput').val()) //check empty input filed
      {
          $("#output").html("Select image !!!!!!");
          return false
      }

      var fsize = $('#imageInput')[0].files[0].size; //get file size
      var ftype = $('#imageInput')[0].files[0].type; // get file type

      //allow only valid image file types
      switch (ftype) {
          case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg': case 'video/mp4':
          break;
          default:
              $("#output").html("<b>" + ftype + "</b>  Unsupported file type!!");
              return false
      }

      //Allowed file size is less than 1 MB (1048576)
      if (fsize > 50048576) {
          $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
          return false
      }


      encodeImageFileAsURL(ftype);
  }
  else {
      //Output error to older unsupported browsers that doesn't support HTML5 File API
      $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!!");
      return false;
  }
}
function encodeImageFileAsURL(ftype){



  var fileUpload = $('#imageInput').get(0);
  var file = fileUpload.files;


  // alert(file);
  if (file.length > 0)
  {
      var fileToLoad = file[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
          var srcData = fileLoadedEvent.target.result; // <--- data: base64

          // alert(srcData);
          upload(srcData,ftype);
      };
      fileReader.readAsDataURL(fileToLoad);
  }
}

function upload(base64Image,ftype){

 var aid = $("#aId").val();
  // AJAX Code To Submit Form.
  $.ajax({
      type: "POST",
      url: "../inc/course/lessonMediaUpload.php",
      data: {"file": base64Image, "ex": ftype, "id": aid },
      cache: false,
      success: function(result){

          console.log(result);
          if(result){
             if(result.trim() == "done"){

             }else{
              $("#output").empty();
              $("#output").append('<div style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+result +'</div>');
              $("#outputCode").empty();
              $("#outputCode").append('<div style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+result +'</div>');          
              $('#outputCode').css('visibility','visible');
             }
           
          }else{
              $("#output").empty();
              $("#outputCode").append('<div style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+result +'</div>');          
             
              //$("#output").html("Error to insert database!!");
          }

      },
      error: function (r) {
          console.log("ERROR");
          console.log(r);

          $("#output").empty();
          $("#output").html("Error to upload image!!");

      }
  });
}



function bytesToSize(bytes) {
  var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
  if (bytes == 0) return '0 Bytes';
  var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
  return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}