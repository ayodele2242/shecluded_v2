<?php
include("../functions.php");


$resp = curl_get("",$global_var->base_url."/course/get-course-lessons","get",$global_var->getToken());

if($resp->success != "true")
{
   
    $output = array('data' => "empty");

 
}else{
$output = array('data' => array());
$i = 1;

foreach($resp->data->data as $row)
{
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
   
     foreach($row->sections as $note){
       $notes[] = $note->notes;
     }

   $str = "'".implode("','",$notes)."'"; 


     if (strlen($str) >= 100) {
     $text = substr($str, 0, 60). " ... " . substr($str, -5);
    }
    else {
      $text = $str;
    }

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

     $actionButton = '
     <a href="#" id="'.$row->id.'" data-courseId="'.$row->course_id.'"  data-name="'.$row->title.'" data-thumb="'.$thum.'" data-url="'.$ul.'" data-order="'.$row->order_number.'" data-desc="'.$json.'" class="btn btn-warning btn-sm btn-float btn-round btn-float-sm editDetils"> <i class="fa fa-edit"></i></a>
     <a href="#" data-toggle="modal" data-target="#deleteModal" id="'.$row->id.'"  data-name="'.$row->title.'" class="btn btn-danger btn-sm btn-float btn-round btn-float-sm delMe waves-effect waves-light bg-red z-depth-4 btn-small" data-placement="left" title="" data-original-title="Delete" data-toggle="tooltip">
     <i class="fa fa-trash col-white"></i></a> 
     <a href="#" data-toggle="modal" data-target="#uploadModal" id="'.$row->id.'"  data-name="'.$row->title.'" class="btn btn-info btn-sm btn-float btn-round btn-float-sm uploadMe waves-effect waves-light z-depth-4" data-placement="left" title="" data-original-title="Upload media" data-toggle="tooltip">
     <i class="fa fa-video-camera col-white"></i></a> 
     ';

   $output['data'][] = array(
    $thumb,
    $url,
		ucwords($row->title),
    $cname,
    $text,
    $row->order_number,
    date("F jS, Y", strtotime($row->createdAt)),
		$actionButton
	);

	$i++;

}

}
echo json_encode($output);
?>