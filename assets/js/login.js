$(document).on('click', '.mbtn', function(e) {
  e.preventDefault();
 
  var email = $("#email").val();
  var password = $("#password").val();


  $('.overlay').html('<img src="assets/gif/loading.gif" width="24" height="24"/>').removeClass('hidden');

String.prototype.trim = function() {
    try {
        return this.replace(/^\s+|\s+$/g, "");
    } catch(e) {
        return this;
    }
}



  $.ajax({
    type: "POST",
    url: "inc/login.php",
    data : {email:email,password:password},
    success: function(response){

    if(response.trim() == "ok"){
      $('.overlay').html('<div class="col-white font-weight-bolder">Logging you in..</div>').removeClass('hidden');
    setTimeout(' window.location.href = "admin/redirect"; ',2000);
    }else{
      $('.toast').addClass('alert-danger').toast('show');
      if(response.includes("'success' of non-object")){
        $('.toast-body').html("No internet connection available. Check your internet connection and try again.");
        $('.theader').html("Connection Failed");
      $('.overlay').addClass('hidden');
      }else{
        $('.toast-body').html(response);
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
  });//ajax



});
