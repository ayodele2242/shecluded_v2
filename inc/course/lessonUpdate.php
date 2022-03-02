<?php
include("../functions.php");




$id = $_POST['id'];


$resp = curl_get("",$global_var->base_url."/course/get-lesson-by-id/".$id,"get",$global_var->getToken());

if($resp->success != "true")
{
   
    $output = array('data' => "empty");

 
}else{
$output = array('data' => array());


$row = $resp->data->lesson;

  $notes = array();
  $courseID = $row->course_id;
  

  //Get course category name
 $cresp = curl_get("",$global_var->base_url."/course/get-course-by-id/".$courseID,"get",$global_var->getToken());
 

 if($cresp->message == 'Course not found'){
  $cname = "";
 }else{
  $course = $cresp->data->course->title;
  $cname =  ucwords($course);
 }


    $json =  json_encode($row->sections);
   
     


     //Let's check if file type is  a video or image
     if(!empty($row->thumbnail)){
       $thum = $row->thumbnail;
      if(preg_match('/^.*\.(mp4|mov)$/i', $row->thumbnail)) {
        $thumb =  '<video muted controls style="max-width: 60px; max-height: 60px;"> <source src="'.$row->thumbnail.'" type="video/mp4"></video>';
      } else {
        $thumb  = '<img src="'.$row->thumbnail.'" width="50" height="50" />';
      }
     }else{
      $thumb = "";
      $thum =  "";
     }

     if(!empty($row->content_url)){
       $ul = $row->content_url;
      if(preg_match('/^.*\.(mp4|mov)$/i', $row->content_url)) {
        $url =  '<video muted controls style="max-width: 60px; max-height: 60px;"> <source src="'.$row->content_url.'" type="video/mp4"></video>';
        
      } else {
        $url  = '<img src="'.$row->content_url.'" width="50" height="50" />';
      }
     }else{
      $url = "";
      $ul = "";
     }
     
      $date = date("F jS, Y", strtotime($row->createdAt));
?>

<div class="col-lg-12 col-sm-12 p-3">
<form id="ccupdateForm" class="bg-white">
                                                
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input id="name" name="title" type="text" class="form-control" value="<?php echo $row->title; ?>" placeholder="">
                </div>

               

                
                <div class="form-group">
                <label for="" class="form-label">Sections</label>
                <?php 
                foreach($row->sections as $note){  
                ?>
                    <div class="clonedata form-group">
                      
                            <textarea rows="6"  class="form-control"  placeholder="" name="details[]"><?php echo $note->notes; ?></textarea>
                       
                    </div>

                <?php } ?>                   
                </div>

                <div class="form-group">
                    <label for="vertical-form-2" class="form-label">Course</label>
                    <select name="cat_id" id="cat_id" class="form-control form-select-lg sm:mt-2 sm:mr-2 catId" aria-label=".form-select-lg example">
                    <option value=""></option>
                        <?php
                            
                            $resp = curl_get("",$global_var->base_url."/course/get-all-courses","get",$global_var->getToken());

                            foreach($resp->data->courses as $course)
                            {
                                if($course->id == $courseID){
                                    $sel1 = "selected";
                                }else{
                                    $sel1 = "";
                                }
                            echo "<option value=\"".$course->id."\" ".$sel1.">".ucwords($course->title)."</option>";
                                

                            }
                            ?>
                    </select>
                </div>

                <div class="form-group">

                    <label for="title" class="form-label">Order</label>
                    <input id="order" name="order" type="text" class="form-control" value="<?php echo $row->order_number; ?>" placeholder="">

                </div>
                <div class="form-group">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input id="thumbnail" type="text" class="form-control" name ="thumbnail" value="<?php if(!empty($row->thumbnail)){ echo $row->thumbnail; } ?>" placeholder="eg https://www.wikihow.com/images/thumb/d/db/Get-the-URL-for-Pictures-Step-2-Version-6.jpg/aid597183-v4-728px-Get-the-URL-for-Pictures-Step-2-Version-6.jpg">
                      <input type="hidden" class="pid" name="pid" value="<?php echo $id; ?>">
                </div>
           
 
                <div class="form-group" align="center">
                    
               
                <button class="btn  btn-warning updateM" id="create">Update</button> 
                 <button class="btn  btn-danger reloadMe">Close</button>
                </div>
                        
                <div class="tell"></div>

                 </form>
    
                    </div>

	

<?php
}

?>


<script>
$(document).on('click', '.updateM', function(e) {
    e.preventDefault();
   
    $('.updateM').html("Updating...").prop("disabled",true);
        
    $.ajax({
       url: "../inc/course/lessonUpdateModule.php",
       method: "post",
       data:  $("#ccupdateForm").serialize(),
       success: function(data){
       if(data.trim() == "done")
       { 
        $('.tell').empty().show().html('<div class="alert alert-success">Updated successfully</div>').delay(2000).fadeOut(5000);
   

           cc_Tbl.ajax.reload(null, false);
        
           $('.idescr').hide();
           $('.updateM').html('Update').prop("disabled",false);
            
       }
       else{
   
        $('.tell').empty().show().html('<div class="alert alert-danger">'+data+'</div>').delay(5000).fadeOut(5000);
        $('.updateM').html('Try Again').addClass('btn-danger').prop("disabled",false);
          
       }
   
       }
     });
     
   
     });


</script>