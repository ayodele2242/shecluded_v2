<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/course/get-all-courses","get",$global_var->getToken());

if($resp->success != "true")
{
   
    $output = array('data' => "empty");

 
}else{
$output = array('data' => array());


foreach($resp->data->courses as $row)
{

  $catID = $row->category;
  $contentType = $row->content_type;

  //Get course category name
 $cresp = curl_get("",$global_var->base_url."/course/get-course-by-category/".$catID,"get",$global_var->getToken());
 
  $category = $cresp->data->courses[0]->category;
 

      if(!empty( $category->name )){
        $cname =  ucwords($category->name);
      }else{
        $cname = "";
      }

      if($row->status == 'active'){
        $sta = "checked";
      }else{
          $sta = "";
      }

      if (strlen($row->description) >= 30) {
        $text = substr($row->description, 0, 20). " ... " . substr($row->description, -5);
      }
      else {
        $text = $row->description;
      }

      //Convert boolean back to str
      $conv = $row->is_paid ? 'true' : 'false';

      if($row->is_paid == true){
        $paid = "Paid Content";

      }else{
        $paid = "None Paid Content";
      }

      if ($contentType == "video" ){
        $img =  '<video muted controls style="max-width: 60px; max-height: 60px;"> <source src="'.$row->thumbnail.'" type="video/mp4"></video>';
      } else {
          $img = '<img src="'.$row->thumbnail.'" width="50" height="50" />';
      }
     
      $date = date("F jS, Y", strtotime($row->createdAt));

     $switch = ' <input type="checkbox" class="form-check-switch ustaDetails" '.$sta.' id="'.$row->id.'" data-catId="'.$catID.'">';
     $actionButton = '
     <a href="#" id="'.$row->id.'" data-topicId="'.$row->topic_id.'" data-catId="'.$catID.'" data-paid="'.$conv.'" data-name="'.$row->title.'" data-thumb="'.$row->thumbnail.'" data-desc="'.$row->description.'" data-type="'.$row->content_type.'" class="btn btn-warning btn-sm btn-float btn-round btn-float-sm mr-1 editDetils"> <i class="fa fa-edit"></i></a>
     <a href="#" data-toggle="modal" data-target="#deleteModal" id="'.$row->id.'" data-catId="'.$catID.'"  data-name="'.$row->title.'" class="btn btn-danger btn-sm btn-float btn-round btn-float-sm delMe waves-effect waves-light z-depth-4 btn-small mr-1" data-placement="left" title="" data-original-title="Delete" data-toggle="tooltip">
     <i class="fa fa-trash col-white"></i></a> 
     ';

   $output['data'][] = array(
    $img,
		ucwords($row->title),
    $cname,
    $text,
    $paid,
    date("F jS, Y", strtotime($row->createdAt)),
    $switch,
		$actionButton
    

	);

	

}

}
echo json_encode($output);
?>