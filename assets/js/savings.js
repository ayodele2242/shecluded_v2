var admins;


$(document).ready(function() {
    $('.i_loading').removeClass('hidden');


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
    }, 1000);



    function loadTopic(){
      $('.i_loading').addClass('hidden');
      $('.tblDiv').removeClass('hidden');
   admins = $('#admins').DataTable({
    'processing': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 480,
    'ajax': {
      type: 'POST',
      'url': '../inc/savings/fetchSavings.php',
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

});




//Create new admin details
$(document).on('click', '#createBtn', function(e) {
e.preventDefault();

$('#createBtn').html("Processing...").prop('disabled', true);

$.ajax({
  url:'../inc/savings/addSavingGoal.php',
  type:'POST',
  data:$("#savingForm").serialize(),
  success:function(result){
     if(result == "done"){
      $('#resp').empty().show().html('<div class="alert alert-success">Successfully Created</div>').delay(3000).fadeOut(10000);
      $("#savingForm")[0].reset();
      admins.ajax.reload(null, false);
      $('#createBtn').html("Create").prop('disabled', false);
      setTimeout(function(){
        $('.modal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      }, 900);
     }else{
         $('#resp').empty().show().html('<div class="alert alert-danger">'+result+'</div>').delay(3000).fadeOut(10000);
         $('#createBtn').html("Create").prop('disabled', false);
      }

  },error: function (xhr, error, code)
  {

    var seconds = 7;  
 

    setInterval(function () {  
      seconds--;  
      $("#lblCount").html(seconds);  
      if (seconds == 0) {  
         window.location = "../admin/logout";  
      }  
  }, 1000); 

    console.log(error.responseText);
    if(xhr.responseText.includes("stdClass::$success")){

    $('#resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
    
    }else if(xhr.responseText.includes("success' of non-object")){
    $('#resp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
    }else if(xhr.responseText == ""){
      $('#resp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
    }else if(code == 'not foundNot Found'){
      $('#resp').html('<div class="alert alert-danger">The system could not locate the url.</div>');
     } else{
      $('#resp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
    
    }
    
   
      
  }

});



});



//Update admin status

$(document).on('click', '.ustaDetails', function() {
var checkStatus = this.checked ? 1 : 0;
var id = $(this).attr('id');
$(".iam_loading").html("Updating Status...").show();
$.post("../inc/savings/_status_update.php", {"id": id, "sta":checkStatus, }, 
function(data) {
if(data == "done"){
  $(".iam_loading").hide();
  alert("Activated Successfully");
  admins.ajax.reload(null, false);
}else if(data == "d"){
  $(".iam_loading").hide();
  alert("De-Activated Successfully");
  admins.ajax.reload(null, false);
}else{
  $(".iam_loading").hide();
 alert("Error occured: "+data);
}
});

});
