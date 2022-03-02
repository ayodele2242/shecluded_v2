var sloanTbl;

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
    loadLoans();
  }, 1000);



  function loadLoans(){
    $('.i_loading').addClass('hidden');
    $('.tblDiv').removeClass('hidden');
    sloanTbl = $('#sloanTbl').DataTable({
      'processing': true,
       dom: 'Bfrtip',
       "scrollX": true,
       "scrollY": 480,
      'ajax': {
        type: 'POST',
        'url': '../inc/loan/fetchLoans.php',
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


//Get loan details into the modal on Pre-Approve
$(document).on('click', '.pre_approve', function(e) {
  e.preventDefault();

  var id = $(this).attr('id'); 
  var name = $(this).attr('data-name'); 
  var interest = $(this).attr('data-interest'); 
  var amount = $(this).attr('data-amount'); 
  var principal = $(this).attr('data-principal'); 
  var frequency = $(this).attr('data-frequency'); 
  var rate = $(this).attr('data-rate');
 
 
  $("#Uname").html("Borrower's Name "+name);
  $("#resp").html("<b>Are you sure you want to take this action? </b>");
  $("#papprid").val(id);

  //$('.preapproveloanDetailse').html('<p><h2><b>Loan Details</b></h2></p><p></p><p>Loan Amount: '+ amount+'</p><p>Loan Interest :'+ interest +'</p><p>Loan Principal '+principal+'</p><p>Frequency '+frequency+'</p>');
  
  });

  //Send id to approval api
  $(document).on('click', '#preapproveBtn', function(e) {

    e.preventDefault();
    $('#preapproveBtn').html("Processing...").prop('disabled', true);
    
    $.ajax({
        url:'../inc/loan/pre_ApproveLoan.php',
        type:'POST',
        data:$("#preapproveForm").serialize(),
        success:function(resp){
           if(resp == "done"){
            //sloanTbl.ajax.reload(null, false);
             
             $("#sloanTbl").DataTable().ajax.reload( null, false );
            
            //location.reload();
            $('#resp').empty().show().html('<span style="color:green; font-weight:bolder;">Loan has been pre-approved successfully</span>').delay(3000).fadeOut(10000);
             $('#preapproveBtn').html("PRE-APPROVE").prop('disabled', false);
             setTimeout(function(){
              $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            }, 1000);
           }else{
               $('#resp').empty().show().html('<span style="color:red; font-weight:bolder;">'+resp+'</span>').delay(3000).fadeOut(10000);
               $('#preapproveBtn').html("PRE-APPROVE").prop('disabled', false);
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




//Get Approve details
$(document).on('click', '.approveMe', function(e) {
  e.preventDefault();
 
  var id = $(this).attr('id'); 
  var name = $(this).attr('data-name'); 
  var amount = $(this).attr('data-amount'); 
 
 
  $("#apprname").html("Borrower's Name "+name);
  $("#aresp").html("<b class=\"text-danger\">Are you sure you want to perform this action? </b>");
  $("#apprid").val(id);

  $('.approveloanDetails').html('<p><h2><b>Loan Details</b></h2></p><p></p><p><b>Loan Amount: '+ amount+'</b></p>');

  });

  //Send approve details

    $(document).on('click', '#approveBtn', function(e) {

    e.preventDefault();
    $('#approveBtn').html("Processing...").prop('disabled', true);
    
    $.ajax({
        url:'../inc/loan/approveLoans.php',
        type:'POST',
        data:$("#approveForm").serialize(),
        success:function(resp){
           if(resp == "done"){
            //sloanTbl.ajax.reload(null, false);
            $('#approveForm')[0].reset();
           
             $("#sloanTbl").DataTable().ajax.reload( null, false );
             
            //location.reload();
            $('#aresp').empty().show().html('<span style="color:green; font-weight:bolder;">Loan has been approved successfully</span>').delay(3000).fadeOut(10000);
             $('#approveBtn').html("APPROVE").prop('disabled', false);
             setTimeout(function(){
              $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            }, 1000);
           }else{
               $('#aresp').empty().show().html('<span style="color:red; font-weight:bolder;">'+resp+'</span>').delay(3000).fadeOut(10000);
               $('#approveBtn').html("APPROVE").prop('disabled', false);
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
      
          $('#aresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
          
          }else if(xhr.responseText.includes("success' of non-object")){
          $('#aresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
          }else if(xhr.responseText == ""){
            $('#aresp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
          }else if(code == 'not foundNot Found'){
            $('#aresp').html('<div class="alert alert-danger">The system could not locate the url.</div>');
           } else{
            $('#aresp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
          
          }
          
         
            
        }
    
    });
    
    });







//Get Disburse details
$(document).on('click', '.disburseMe', function(e) {
  e.preventDefault();
 
  var id = $(this).attr('id'); 
  var name = $(this).attr('data-name'); 
  var amount = $(this).attr('data-amount'); 
 
 
  $("#dapprname").html("Borrower's Name "+name);
  $("#daresp").html("<b class=\"text-danger\">Are you sure you want to perform this action? </b>");
  $("#dapprid").val(id);

  $('.disburseloanDetails').html('<p><h2><b>Loan Details</b></h2></p><p></p><p><b>Loan Amount: '+ amount+'</b></p>');

  });

  //Send DISBURSE details

    $(document).on('click', '#disburseBtn', function(e) {

    e.preventDefault();
    $('#disburseBtn').html("Processing...").prop('disabled', true);
    
    $.ajax({
        url:'../inc/loan/disburseLoan.php',
        type:'POST',
        data:$("#disburseForm").serialize(),
        success:function(resp){
           if(resp == "done"){
            //sloanTbl.ajax.reload(null, false);
            $('#disburseForm')[0].reset();
           
             $("#sloanTbl").DataTable().ajax.reload( null, false );
             
            //location.reload();
            $('#daresp').empty().show().html('<span style="color:green; font-weight:bolder;">Loan has been disbursed successfully</span>').delay(3000).fadeOut(10000);
             $('#disburseBtn').html("DISBURSE").prop('disabled', false);
             setTimeout(function(){
              $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            }, 1000);
           }else{
               $('#daresp').empty().show().html('<span style="color:red; font-weight:bolder;">'+resp+'</span>').delay(3000).fadeOut(10000);
               $('#disburseBtn').html("DISBURSE").prop('disabled', false);
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
      
          $('#dresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
          
          }else if(xhr.responseText.includes("success' of non-object")){
          $('#dresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
          }else if(xhr.responseText == ""){
            $('#dresp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
          }else if(code == 'not foundNot Found'){
            $('#dresp').html('<div class="alert alert-danger">The system could not locate the url.</div>');
           } else{
            $('#dresp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
          
          }
          
         
            
        }
    
    });
    
    });



    





//Get Reject details
$(document).on('click', '.rejectIt', function(e) {
  e.preventDefault();
 
  var id = $(this).attr('id'); 
  var name = $(this).attr('data-name'); 
 
 
 
  $("#rname").html(name);
  $("#rresp").html("<b class=\"text-danger\">Are you sure you want to perform this action? </b>");
  $("#meid").val(id);

  //$('.rejectloanDetails').html('<p><h2><b>Loan Details</b></h2></p><p></p><p><b>Loan Amount: '+ amount+'</b></p>');

  });

  //Send DISBURSE details
    $(document).on('click', '#rejectBtn', function(e) {
    e.preventDefault();
    $('#rejectBtn').html("Processing...").prop('disabled', true);
    
    $.ajax({
        url:'../inc/loan/rejectLoan.php',
        type:'POST',
        data:$("#rejectForm").serialize(),
        success:function(resp){
           if(resp == "done"){
            //sloanTbl.ajax.reload(null, false);
            $('#rejectForm')[0].reset();
           
             $("#sloanTbl").DataTable().ajax.reload( null, false );
             
            //location.reload();
            $('#rresp').empty().show().html('<span style="color:green; font-weight:bolder;">Loan has been rejected successfully</span>').delay(3000).fadeOut(10000);
             $('#rejectBtn').html("REJECT").prop('disabled', false);
             setTimeout(function(){
              $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            }, 2000);
           }else{
               $('#rresp').empty().show().html('<span style="color:red; font-weight:bolder;">'+resp+'</span>').delay(6000).fadeOut(10000);
               $('#rejectBtn').html("REJECT").prop('disabled', false);
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
      
          $('#rresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
          
          }else if(xhr.responseText.includes("success' of non-object")){
          $('#rresp').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
          }else if(xhr.responseText == ""){
            $('#rresp').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
          }else if(code == 'not foundNot Found'){
            $('#rresp').html('<div class="alert alert-danger">The system could not locate the url.</div>');
           } else{
            $('#rresp').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
          
          }
          
         
            
        }
    
    });
    
    });



//View loan schedule informations
    $(document).on('click', '.loandetails', function(e) {
      e.preventDefault();
      $("#scheduleTbl").hide();
      var id = $(this).attr('id'); 
      var uid = $(this).attr('data-uid');
      var name = $(this).attr('data-name'); 
      var amount = $(this).attr('data-amount'); 

      
      $("#memName").html(name);
      $(".amtBorrowed").html('<h2 class="mb-5">Amount Borrowed: '+amount+'</h2>');

      $('.detailContent').html("Processing...");

      $.ajax({
        url: '../inc/loan/loanSchedule.php',
        type: 'POST',
        data: {"id" : id },
        dataType: 'json',
        cache: false,

        success: function(json) {
      if(json.success == "false"){
        $("#scheduleTbl").hide();
        $("#scheduleTbl tbody tr").remove();
            $('.detailContent').html('<span style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+ json.msg +'</span>');
          $('.loading').hide();
          
          
     }else{    
       if(json.msg != ""){   
        $("#scheduleTbl").hide();         
      $('.detailContent').html('<span style="color: orange; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> '+ json.msg +'</span>');    
       }else{
        $("#scheduleTbl").show();
        $('.detailContent').html('');
          var tr=[];
           for (var i = 0; i < json.data.length; i++) {
           tr.push('<tr>');
           tr.push("<td>" + json.data[i].id + "</td>");
            tr.push("<td>" + json.data[i].principal + "</td>");
            tr.push("<td>" + json.data[i].interest + "</td>");
            tr.push("<td>" + json.data[i].date + "</td>");
            tr.push("<td>" + json.data[i].status + "</td>");
            tr.push('</tr>');
            }
            $('.iBody').append($(tr.join('')));
           /* $("#lusersTbl").hide();
           $("#loadusersTbl").show();*/

          }
          
           
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
      
          $('.detailContent').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
          
          }else if(xhr.responseText.includes("success' of non-object")){
          $('detailContent').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
          }else if(xhr.responseText == ""){
            $('detailContent').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
          }else if(code == 'not foundNot Found'){
            $('detailContent').html('<div class="alert alert-danger">The system could not locate the url.</div>');
           } else{
            $('detailContent').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
          
          }
          
         
            
        }
      })
     
     
      //for (var i = 0; i < ch.schedule.length; i++) {
        //console.log(ch.schedule[i]);

      /* tr.push('<tr>');
       tr.push("<td>" + json.data[i].id + "</td>");
       tr.push("<td>" + json.data[i].last_name + "</td>");
       tr.push("<td>" + json.data[i].first_name + "</td>");
       tr.push("<td>" + json.data[i].email + "</td>");
       tr.push("<td>" + json.data[i].phone + "</td>");
       tr.push("<td>" + json.data[i].dob + "</td>");
       tr.push("<td>" + json.data[i].btn + "</td>");
       tr.push('</tr>');*/
      // }
      
      });



        //Let's fetch user's info

  $(document).on('click', '.userInfo', function() {

    var pid = $(this).attr('id');
    var name = $(this).attr('data-name');

    $('#user_contents').html('Loading. Please wait...'); 
    $('.title-name').html('<span style="font-weight:bolder;">'+name+'\'s</span> Details'); 
    
   $.ajax({
    url: '../inc/client/userinfo.php',
    type: 'POST',
    data: {"id" : pid },
    dataType: 'html',
    cache: false,

    success: function(data) { 
        $('#user_contents').html(data); 
    },error: function (error)
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
      if(error.responseText.includes("stdClass::$success")){
  
      $('#user_contents').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
      
      }else if(error.responseText.includes("success' of non-object")){
      $('#user_contents').html('<div class="alert alert-danger">An error occured while processing your data. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');  
      }else if(error.responseText == ""){
        $('#user_contents').html('<div class="alert alert-danger">You have lost your connection. Please check your internet connection and try again. &nbsp;<a href="javascript:;" class="refreshdMe text-white font-weight-bolder "><i class="fa fa-refresh"></i> &nbsp;Refresh</a></div>');
      }else if(error.responseText == 'not foundNot Found'){
        $('#user_contents').html('<div class="alert alert-danger">The system could not locate the url.</div>');
       } else{
        $('#user_contents').html('<div class="alert alert-danger">An error occured while processing your data. The following error occured: <b>'+xhr.responseText+'</b></div>');
      
      }
      
     
        
    }
  })
	

  });