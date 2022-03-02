var trxTbl;

$(document).ready(function() {
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

    trxTbl = $("#trxTbl").DataTable({
        "processing": true,
        "pageLength": 50,
        dom: "Bfrtip",
         "columns": [
          {
             "title": "REFERENCE",
             "data": "ref"
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
             "title": "TIMESTAMP",
             "data": "date"
           },
           {
             "title": "Action",
             "data": "btn"
           }
         ]
       });



});

function trxFunction() {
   
    $.ajax({
      url: '../inc/transactions/successful.php',
      dataType: 'json',
      success: function(json) {
        if(json.success == true){
        $('.trxTbl').removeClass('hidden');
        $('.i_loading').addClass('hidden');
        
        trxTbl.rows.add(json.data).draw();
        }else{
         $('.i_loading').html('No data available').removeClass('hidden');
         $('.trxTbl').addClass('hidden');
        }
      },
      error: function (error) {
       var seconds = 7;  
       $('.trxTbl').addClass('hidden');
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
       
   }else  if(error.responseText == ""){
     $('.i_loading').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
   }else  if(error.responseText.includes("Undefined")){
    $('.i_loading').html('<div class="alert alert-danger">The end-point returned an empty response.');
  }else{
     $('.i_loading').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+error.responseText+'</b></div>');
    
   }
      }
    });
   }

   trxFunction();




   $(document).on('click', '.detail', function(e) {

    e.preventDefault();
  
      var displayLoader = 1;
      $('#topUpandEditDiv').html(createSkeleton(displayLoader));
  
      setTimeout(function(){
        loadForm();
      }, 1000);
  
      $('.tableDiv').removeClass('col-12').addClass('col-8 table-responsive');
     
      $('.ldivider').removeClass('hidden');
      $('.topUpandEditDiv').removeClass('hidden');
      $("#usersTbl").addClass('display');
    
    
    var id = $(this).attr('id'); 
    
  
    function createSkeleton(limit){
      var skeletonHTML = '';
      for(var i = 0; i < limit; i++){
        skeletonHTML += '<div class="ph-item">';
        skeletonHTML += '<div>';
        skeletonHTML += '<div class="ph-row">';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-4 empty"></div><div class="ph-col-4 big"></div>';
        skeletonHTML += '<div class="ph-col-4 big"></div><div class="ph-col-8 empty"></div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
      }
      return skeletonHTML;
    }
  
    $('html, body').animate({
      scrollTop: $('#topUpandEditDiv').offset().top - 70
  }, 'slow');
  
    function loadForm(){
      $.ajax({
        url:"../inc/transactions/details.php",
        method:"POST",
        data:{ id:id },
        success:function(data) {
        
            if(data.success == "false"){
                $('#topUpandEditDiv').html("No data available to return from the end-point");
            }else{

          $('#topUpandEditDiv').html(data);
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