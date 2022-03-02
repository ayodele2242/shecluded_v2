//Logout session
var idleMax = 25; // Logout after 25 minutes of IDLE
  var idleTime = 0;
  var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval    
  $( "body" ).mousemove(function( event ) {
      idleTime = 0; // reset to zero
});

// count minutes
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > idleMax) { 
        window.location="../admin/logout.php";
    }
}       
//Logout session ends

$(document).ready(function () {
    //called when key is pressed in textbox
     $(".digit").keypress(function (e) {
       //if the letter is not digit then display error and don't type anything
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
        //  $(".derror").html("Only digits allow").show().fadeOut("slow");
        $(".digit").css("background-color","#fbe9e7");
        
                 return false;
      }else{
          $(".digit").css("background-color","#fff");
      }
     });
  
      $('input.thousand').keyup(function(event){
          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40){
              event.preventDefault();
          }
          var $this = $(this);
          var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
          
          var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
                 
          $this.val(num2);
      });
    });
   //Thousand separator
    function RemoveRougeChar(convertString){
      if(convertString.substring(0,1) == ","){
          return convertString.substring(1, convertString.length) 
      }
      return convertString;
  }


  //Remove dispayed message box after 5secs
window.setTimeout(function() {
    $(".removeMessages").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
    });
  }, 10000);
//Remove dispayed message box ends