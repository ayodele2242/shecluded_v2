var usersTbl;
var emailTbl;


$(document).ready(function() {
  $(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel").addClass("btn mb-2");
 
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
  


  usersTbl = $("#usersTbl").DataTable({
    "processing": true,
    "pageLength": 50,
    dom: "Bfrtip",
     "columns": [
      {
         "title": "SURNAME",
         "data": "last_name"
       },
       {
         "title": "FIRST NAME",
         "data": "first_name"
       },
       {
         "title": "EMAIL",
         "data": "email"
       },
       {
         "title": "PHONE",
         "data": "phone"
       },
       {
        "title": "Date of Birth",
        "data": "dob"
      },
       {
         "title": "Action",
         "data": "btn"
       }
     ]
   });

   emailTbl = $("#emailTbl").DataTable({
    "processing": true,
    "pageLength": 5,
    dom: "Bfrtip",
     "columns": [
      {
         "title": "SURNAME",
         "data": "last_name"
       },
       {
         "title": "FIRST NAME",
         "data": "first_name"
       },
       {
         "title": "EMAIL",
         "data": "email"
       },
       {
         "title": "PHONE",
         "data": "phone"
       },
       {
        "title": "Date of Birth",
        "data": "dob"
      },
       {
         "title": "Action",
         "data": "btn"
       }
     ]
   });

   function usersFunction() {
   
   $.ajax({
     url: '../inc/client/fetchUsers.php',
     dataType: 'json',
     success: function(json) {
       if(json.success == true){
       $('.usersTbl').removeClass('hidden');
       $('.i_loading').addClass('hidden');
       appendBtn(json.lastkey);

       usersTbl.rows.add(json.data).draw();
       }else{
        $('.i_loading').html('No data available').removeClass('hidden');
        $('.usersTbl').addClass('hidden');
       }
     },
     error: function (error) {
      var seconds = 7;  
      $('.usersTbl').addClass('hidden');
      console.log(error.responseText);
      if(error.responseText.includes("stdClass::$success")){

      setInterval(function () {  
        seconds--;  
        $("#lblCount").html(seconds);  
        if (seconds == 0) {  
           window.location = "../admin/logout";  
        }  
    }, 1000); 

      $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
      
  }else  if(error.responseText == ""){
    $('.i_loading').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
  }else{
    $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
   
  }
     }
   });
  }

  usersFunction();

  $(document).on('click', '.refreshdMe', function(){
    
   usersFunction();
   $('.refreshdMe').html('<i class="spinner feather icon-refresh-cw"></i>');
  });


//Searching user's detail on input
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
          $('.emailTblDiv').removeClass("hidden");
          $('.emailTblDiv').fadeIn("slow");
          
          if(keyword == ""){
            $('.tableDiv').fadeIn("slow");
            $('.emailTblDiv').addClass("hidden");
            $('.emailTblDiv').fadeOut("slow");
          }else{         
            $(".spinner").removeClass('hidden');
            $.ajax({
                url: '../inc/client/fetchUsersByEmail.php',
                type:'POST',
                data: {"keyword":  keyword},
                dataType: 'json',
                cache: false,
               
                success: function(json) {
                  if(json.nouser == ''){
                      $('.toast').addClass('alert-danger').toast('show');
                      $('.toast-body').html("No user found for this account.");
                      $('.spinner').addClass('hidden');
                      $('.theader').html("Error Message");
                     emailTbl.clear().draw();
                  }else{    

                   emailTbl.clear().draw();
                   emailTbl.rows.add(json.data).draw();
            
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


 

  $(document).on('click', '.loadMoreData', function(){
    var id = $(this).attr('id');
    $('.loadMoreData').html('Loading Data <i class="spinner feather icon-refresh-cw"></i>');  
    $('.loadMoreData').removeClass('btn-warning').addClass('btn-info');
    $.ajax({
      url: '../inc/client/fetchUsersByPagination.php',
      type:'POST',
      data: {"lastkey": id},
      dataType: 'json',
      success: function(json) {
        if(json.lastkey != ""){
          $('.loadMoreData').removeClass('btn-info').addClass('btn-warning');
        appendBtn(json.lastkey);
        usersTbl.clear().draw();
        usersTbl.rows.add(json.data).draw();
        }
        else{
          $('.loadMore').html('<span id="mylastkey"><b>No more data to load </b></span>  &nbsp;<button class="btn btn-warning btn-sm refreshdMe"">Refresh</button>');
 

        }
      },
      error: function (error) {
       var seconds = 7;  
       $('.usersTbl').addClass('hidden');
       console.log(error.responseText);
       if(error.responseText.includes("stdClass::$success")){
 
       setInterval(function () {  
         seconds--;  
         $("#lblCount").html(seconds);  
         if (seconds == 0) {  
            window.location = "../admin/logout";  
         }  
     }, 1000); 
 
       $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, login you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
       
   }else  if(error.responseText == ""){
     $('.i_loading').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
   }else{
     $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
    
   }
      }
    });



});



  //this is our callback function
function appendBtn(param) {
  $('.loadMore').html('<span id="mylastkey"><b>Last Key: </b>'+param+'</span>  &nbsp;<button class="btn btn-warning btn-sm loadMoreData" id="'+param+'">Load More data</button> ');
  }


  $(document).on('click', '.topUp', function() {

    var displayLoader = 1;
    $('#topUpandEditDiv').html(createSkeleton(displayLoader));
	
    setTimeout(function(){
      loadForm();
    }, 1000);
   
    var pid = $(this).attr('id');
    var name = $(this).attr('data-name');

    $('.tableDiv').removeClass('col-12').addClass('col-8 table-responsive');
    $('.emailTblDiv').removeClass('col-12').addClass('col-8 table-responsive');
    $('.ldivider').removeClass('hidden');
    $('.topUpandEditDiv').removeClass('hidden');
    $("#usersTbl").addClass('display');

    

    function createSkeleton(limit){
      var skeletonHTML = '';
      for(var i = 0; i < limit; i++){
        skeletonHTML += '<div class="ph-item">';
        skeletonHTML += '<div>';
        skeletonHTML += '<div class="ph-row">';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-8 big"></div><div class="ph-col-4 empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
        skeletonHTML += '<div class="ph-col-12 big"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
        skeletonHTML += '<div class="ph-col-12 big"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';
        skeletonHTML += '<div class="ph-col-2 big empty"></div>';
        skeletonHTML += '<div class="ph-col-4 big mr-1"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-2 big empty"></div>';
        skeletonHTML += '<div class="ph-col-12 big empty"></div>';      
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
      }
      return skeletonHTML;
    }

    $('html, body').animate({
      scrollTop: $('#topUpandEditDiv').offset().top - 40
  }, 'slow');

    function loadForm(limit){
      $.ajax({
        url:"topup.php",
        method:"POST",
        data:{action: 'load_products', id:pid, name:name},
        success:function(data) {
          $('#topUpandEditDiv').html(data);
        }
      });
    }

  
});

$(document).on('click', '.edituserInfo', function(e) {

  e.preventDefault();

    var displayLoader = 1;
    $('#topUpandEditDiv').html(createSkeleton(displayLoader));

    setTimeout(function(){
      loadForm();
    }, 1000);

    $('.tableDiv').removeClass('col-12').addClass('col-8 table-responsive');
    $('.emailTblDiv').removeClass('col-12').addClass('col-8 table-responsive');
    $('.ldivider').removeClass('hidden');
    $('.topUpandEditDiv').removeClass('hidden');
    $("#usersTbl").addClass('display');
  
  
  var id = $(this).attr('id'); 
  var lname = $(this).attr('data-lname'); 
  var fname = $(this).attr('data-fname'); 
  var email = $(this).attr('data-email'); 
  var dob = $(this).attr('data-dob'); 
  var phone = $(this).attr('data-phone'); 
  
  
  $("#name").html(lname +" "+ fname);
  $("#uid").val(id);
  $("#lname").val(lname);
  $("#fname").val(fname);
  $("#email").val(email);
  $("#phone").val(phone);
  $("#dob").val(dob);

  function createSkeleton(limit){
    var skeletonHTML = '';
    for(var i = 0; i < limit; i++){
      skeletonHTML += '<div class="ph-item">';
      skeletonHTML += '<div>';
      skeletonHTML += '<div class="ph-row">';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big"></div><div class="ph-col-4 empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
      skeletonHTML += '<div class="ph-col-12 big"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
      skeletonHTML += '<div class="ph-col-12 big"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
      skeletonHTML += '<div class="ph-col-12 big"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
      skeletonHTML += '<div class="ph-col-12 big"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-8 big empty"></div><div class="ph-col-4"></div>';
      skeletonHTML += '<div class="ph-col-12 big"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';
      skeletonHTML += '<div class="ph-col-2 big empty"></div>';
      skeletonHTML += '<div class="ph-col-4 big mr-1"></div>';
      skeletonHTML += '<div class="ph-col-4 big"></div>';
      skeletonHTML += '<div class="ph-col-2 big empty"></div>';
      skeletonHTML += '<div class="ph-col-12 big empty"></div>';      
      skeletonHTML += '</div>';
      skeletonHTML += '</div>';
    }
    return skeletonHTML;
  }

  $('html, body').animate({
    scrollTop: $('#topUpandEditDiv').offset().top - 40
}, 'slow');

  function loadForm(){
    $.ajax({
      url:"edit_userInfo.php",
      method:"POST",
      data:{ name:lname +" "+ fname, fname:fname, lname:lname, email:email, phone:phone, id:id, dob:dob },
      success:function(data) {
        $('#topUpandEditDiv').html(data);
      }
    });
  }
  
  });

//Close side div

$(document).on('click', '.cancelit', function(e) {

    $('.tableDiv').addClass('col-12').removeClass('col-8 table-responsive');
    $('.emailTblDiv').addClass('col-12').removeClass('col-8 table-responsive');
    $('.ldivider').addClass('hidden');
    $('.ldivider').html('');
    $('.topUpandEditDiv').addClass('hidden');
    $("#usersTbl").removeClass('display');

});
	

  $(document).on('click', '#createBtn', function(e) {

    e.preventDefault();
    $('#createBtn').html('Processing <i class="spinner feather icon-refresh-cw"></i>').prop('disabled', true);

$.ajax({
        url:'../inc/topup/topup.php',
        type:'POST',
        data:$("#Create").serialize(),
        success:function(result){

           if(result.trim() == "done"){
           
            $("#Create")[0].reset();
            $('.toast').removeClass('alert-danger').addClass('alert-success').toast('show');
            $('.toast-body').html("Wallet inward has been topped up successfully");
            $('.theader').html('<i class="fa fa-check"></i> Done');

            $('html, body').animate({
              scrollTop: $('.toast').offset().top - 50
          }, 'slow');
           
            $('#createBtn').html("Create").prop('disabled', false);
            //$("#usersTbl").DataTable().ajax.reload();
           }else{
            $('html, body').animate({
              scrollTop: $('.toast').offset().top - 50
          }, 'slow');
            $('.toast').addClass('alert-danger').toast('show');
            $('.toast-body').html(result);
            $('.theader').html("Error Message");
            $('#createBtn').html("Create").prop('disabled', false);
            }

        },
        error: function (response) {
          $('html, body').animate({
            scrollTop: $('.toast').offset().top - 50
        }, 'slow');
        
          
            if(response.responseText.includes("404")){
             

              $('.toast').addClass('alert-danger').toast('show');
              $('.toast-body').html("The requested url is not found. It could have been moved.");
              $('.theader').html("Error Message");
              
            }else if(response.responseText.includes("Warning")){
             
              $('.toast').addClass('alert-danger').toast('show');
              $('.toast-body').html("Check your internet connection.");
              $('.theader').html("Internet failure");
              
            } else{
              $('.toast').addClass('alert-danger').toast('show');
              $('.toast-body').html(response.responseText);
              $('.theader').html("Error Message");

            }
            $('#createBtn').html("Create").prop('disabled', false);
        }

});

});



//Update
$(document).on('click', '#updateBtn', function(e) {

  e.preventDefault();
  $('#updateBtn').html('Updating <i class="spinner feather icon-refresh-cw"></i>').prop('disabled', true);

$.ajax({
      url:'../inc/client/updateUser.php',
      type:'POST',
      data:$("#userUpdate").serialize(),
      success:function(result){

         if(result.trim() == "done"){
         
          
          $('.toast').removeClass('alert-danger').addClass('alert-success').toast('show');
          $('.toast-body').html("Details updated successfully");
          $('.theader').html('<i class="fa fa-check"></i> Done');

          $('html, body').animate({
            scrollTop: $('.toast').offset().top - 50
        }, 'slow');
         
          $('#updateBtn').html("Update").prop('disabled', false);
          usersFunction();
          //$("#usersTbl").DataTable().ajax.reload();
         }else{
          $('html, body').animate({
            scrollTop: $('.toast').offset().top - 50
        }, 'slow');
          $('.toast').addClass('alert-danger').toast('show');
          $('.toast-body').html(result);
          $('.theader').html("Error Message");
          $('#updateBtn').html("Update").prop('disabled', false);
          }

      },
      error: function (response) {
        $('html, body').animate({
          scrollTop: $('.toast').offset().top - 50
      }, 'slow');
      
        
          if(response.responseText.includes("404")){
           

            $('.toast').addClass('alert-danger').toast('show');
            $('.toast-body').html("The requested url is not found. It could have been moved.");
            $('.theader').html("Error Message");
            
          }else if(response.responseText.includes("Warning")){
           
            $('.toast').addClass('alert-danger').toast('show');
            $('.toast-body').html("Check your internet connection.");
            $('.theader').html("Internet failure");
            
          } else{
            $('.toast').addClass('alert-danger').toast('show');
            $('.toast-body').html(response.responseText);
            $('.theader').html("Error Message");

          }
          $('#createBtn').html("Create").prop('disabled', false);
      }

});

});







  //Let's fetch user's info

  $(document).on('click', '.userInfo', function() {

    var id = $(this).attr('id');
    var name = $(this).attr('data-name');

    $('.editInfoDiv').fadeOut("slow");
    $('.searchMDiv').fadeOut("slow");
    $('.userInfoDiv').removeClass("hidden").addClass('userDetails');
    $('.userInfoDiv').fadeIn("slow");

    

    setTimeout(function(){
      loadDetails();
    }, 2000);

    var display = 1;
  $('.userDetails').html(createSkeleton(display));
  function createSkeleton(limit){
    var uskeletonHTML = '';
    for(var i = 0; i < limit; i++){
     
      uskeletonHTML += '<div class="ph-item">';
      uskeletonHTML += '<div>';
      uskeletonHTML += '<div class="ph-row">';
      uskeletonHTML += '<div class="h4 ph-col-12 big text-blue ">Loading <span class="font-weight-bolder"> '+name+' </span> Details</div>';
      uskeletonHTML += '<div class="ph-col-12 big"></div>';
      uskeletonHTML += '<div class="ph-col-12 big"></div>';
      uskeletonHTML += '<div class="ph-col-12 big"></div>';
      uskeletonHTML += '</div>';
      uskeletonHTML += '</div>';
      uskeletonHTML += '</div>';
    }
    return uskeletonHTML;
  }


  function loadDetails(){
    $.ajax({
      url:"../inc/client/userInfo.php",
      method:"POST",
      data:{ id : id },
      success:function(data) {
        $('.userInfoDiv').removeClass("userDetails")
        $('.userInfoDiv').html('<div class="closeMe btn btn-danger btn-circle btn-sm">Close</div> <div class="user_cont">'+data+'</div>');
      },error: function (error) {
       var seconds = 7;  
       if(error.responseText.includes("stdClass::$success")){
 
       setInterval(function () {  
         seconds--;  
         $("#lblCount").html(seconds);  
         if (seconds == 0) {  
            window.location = "../admin/logout";  
         }  
     }, 1000); 
 
       $('.userInfoDiv').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, login you out in &nbsp;<span class="font-weight-bolder" id="lblCount"></span></div>');
       
   }else  if(error.responseText.includes("non-object")){
     $('.userInfoDiv').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
   }else{
     $('.userInfoDiv').html('<div class="alert alert-danger">An error occured while processing your request. The following error occured: <b>'+error.responseText+'</b></div>');
    
   }
      }
    });
  }
 

  });



$(document).on('click', '.closeMe', function() {

  $('.editInfoDiv').fadeIn("slow");
  $('.searchMDiv').fadeIn("slow");
  $('.userInfoDiv').removeClass("userDetails").addClass('hidden');

}); 






$(document).on('click', '#topmeUpBtn', function(e) {
  e.preventDefault();

  
  $('#topmeUpBtn').html('Processing <i class="spinner feather icon-refresh-cw"></i>').prop('disabled', true);

$.ajax({
      url:'../inc/topup/inwardtopup.php',
      type:'POST',
      data:$("#topmeUp").serialize(),
      success:function(result){

         if(result.trim() == "done"){
         
          $("#topmeUp")[0].reset();
        
          $('.imsg').html("<alert class=\"alert alert-success\">Wallet inward has been topped up successfully</div>");
        

          $('html, body').animate({
            scrollTop: $('.imsg').offset().top - 50
        }, 'slow');
         
          $('#topmeUpBtn').html("Top Up").prop('disabled', false);
          //$("#usersTbl").DataTable().ajax.reload();
         }else{
          $('html, body').animate({
            scrollTop: $('.toast').offset().top - 50
        }, 'slow');
         
          $('.imsg').html("<alert class=\"alert alert-danger\">"+result+"</div>");
         
          $('#topmeUpBtn').html("Top Up").prop('disabled', false);
          }

      },
      error: function (response) {
        $('html, body').animate({
          scrollTop: $('.imsg').offset().top - 50
      }, 'slow');
      
        
          if(response.responseText.includes("404")){
           

            
            $('.imsg').html("<alert class=\"alert alert-danger\">The requested url is not found. It could have been moved.</div>");
           
            
          }else if(response.responseText.includes("Warning")){
           
           
            $('.imsg').html("<alert class=\"alert alert-danger\">Check your internet connection.</div>");
           
            
          } else{
          
            $('.imsg').html("<alert class=\"alert alert-danger\">"+response.responseText+"</div>");
          

          }
          $('#topmeUpBtn').html("Top Up").prop('disabled', false);
      }

});

});

