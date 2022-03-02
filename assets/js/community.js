$(document).ready(function(){
    
	var displayProduct = 5;
	$('#icontents').html(createSkeleton(displayProduct));
	
    setTimeout(function(){
        loadItems(displayProduct);
    }, 5000);

    function createSkeleton(limit){
      var skeletonHTML = '';
      for(var i = 0; i < limit; i++){
        skeletonHTML += '<div class="ph-row">';
        skeletonHTML += '<div class="ph-col-4">';
        skeletonHTML += '<div class="ph-item">';
        skeletonHTML += '<div class="ph-col-2">';
        skeletonHTML += '<div class="ph-avatar"></div>';
        skeletonHTML += '</div>';
        skeletonHTML += '<div>';
        skeletonHTML += '<div class="ph-row">';
        skeletonHTML += '<div class="ph-col-4"></div>';
        skeletonHTML += '<div class="ph-col-8 empty"></div>';
        skeletonHTML += '<div class="ph-col-6"></div>';
        skeletonHTML += '<div class="ph-col-6 empty"></div>';
        skeletonHTML += '<div class="ph-col-2"></div>';
        skeletonHTML += '<div class="ph-col-10 empty"></div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
        skeletonHTML += '<div class="ph-col-12">';
        skeletonHTML += '<div class="ph-picture"></div>';
        skeletonHTML += '<div class="ph-row">';
        skeletonHTML += '<div class="ph-col-10 big"></div>';
        skeletonHTML += '<div class="ph-col-2 empty big"></div>';
        skeletonHTML += '<div class="ph-col-4"></div>';
        skeletonHTML += '<div class="ph-col-8 empty"></div>';
        skeletonHTML += '<div class="ph-col-6"></div>';
        skeletonHTML += '<div class="ph-col-6 empty"></div>';
        skeletonHTML += '<div class="ph-col-12"></div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
        skeletonHTML += '</div>';
      }
      return skeletonHTML;
    }
	
    function loadItems(limit){
      $.ajax({
        url:"../inc/community/fetch.php",
        method:"POST",
        data:{action: 'load_products', limit:limit},
        success:function(data) {
            if(data){
          $('#icontents').html(data);
            }else if(data.includes("Undefined property: stdClass::$success")){
                console.log('data error '+data);
                setInterval(function () {  
                  seconds--;  
                  $("#lblCount").html(seconds);  
                  if (seconds == 0) {  
                     window.location = "../admin/logout";  
                  }  
              }, 1000); 
           
                $('#icontents').html('<div class="alert alert-danger">An error occured while processing your request. Token has expired, logging you out in &nbsp;<div class="font-weight-bolder" id="lblCount"></div></div>');
                
                 }


        }, error: function (error) {
           var seconds = 7;  
           console.log(error.responseText);
           if(error.responseText.includes("Undefined property: stdClass::$success")){
      
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
      });
    }

  });


  
  $(document).on('click', '.getPolls', function() {
    var pid = $(this).attr('id');
    var title = $(this).attr('data-title');
    $('#poll_contents').html('<img src="../assets/gif/loading.gif" style="width: 100%; max-width: 50px; height: 100%; max-height: 50px;"/> &nbsp;Fetching Polls. Please wait...').addClass("pflex");
    $('.title-name').html('<span style="font-weight:bolder;">'+title+'</span>'); 
    
    $.ajax({
      url: '../inc/community/fetchPolls.php',
      type: 'POST',
      data: 'id='+pid,
      dataType: 'html'
    })
    .done(function(data){
          $('#poll_contents').html(data).removeClass("pflex");
          $('.loading').hide();
    })
    .fail(function(){
          $('#poll_contents').html('<span style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> Something went wrong, Please try again...</span>');
          $('.loading').hide();
    });
	
  });


  
  //Fetch posts
  $(document).on('click', '.getPollPosts', function() {
    var pid = $(this).attr('id');
    var title = $(this).attr('data-title');
    $('#post_contents').html('<img src="../assets/gif/loading.gif" style="width: 100%; max-width: 50px; height: 100%; max-height: 50px;"/> &nbsp;Fetching Posts. Please wait...').addClass("pflex");
    $('.ptitle-name').html('<span style="font-weight:bolder;">'+title+'</span>'); 
    
    $.ajax({
      url: '../inc/community/fetchPollPosts.php',
      type: 'POST',
      data: 'id='+pid,
      dataType: 'html'
    })
    .done(function(data){
          $('#post_contents').html(data).removeClass("pflex");
          $('.loading').hide();
    })
    .fail(function(){
          $('#post_contents').html('<span style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> Something went wrong, Please try again...</span>');
          $('.loading').hide();
    });
	
  });


//Get post members
 
  $(document).on('click', '.getPostMembers', function() {
    var pid = $(this).attr('id');
    var title = $(this).attr('data-title');
    $('#post_contents').html('<img src="../assets/gif/loading.gif" style="width: 100%; max-width: 50px; height: 100%; max-height: 50px;"/> &nbsp;Fetching Members. Please wait...').addClass("pflex");
    $('.ptitle-name').html('<span style="font-weight:bolder;">'+title+'</span>'); 
    
    $.ajax({
      url: '../inc/community/fetchPostMembers.php',
      type: 'POST',
      data: 'id='+pid,
      dataType: 'html'
    })
    .done(function(data){
          $('#post_contents').html(data).removeClass("pflex");
          $('.loading').hide();
    })
    .fail(function(){
          $('#post_contents').html('<span style="color:red; font-weight:bolder; forn-size:16px;"><i class="fas fa-exclamation-circle"></i> Something went wrong, Please try again...</span>');
          $('.loading').hide();
    });
	
  });
  