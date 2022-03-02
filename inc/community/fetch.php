<?php
include("../functions.php");

$resp = curl_get("",$global_var->base_url."/community/get-all-communities?status=active","get",$global_var->getToken());
if($resp->success != "true")
{
  //echo 'Dat'
}
//getCloudinary
if(!empty($resp->data->communities)){
foreach($resp->data->communities as $circle)
{
?>

<div class="col-md-4 col-sm-12">
			<div class="card">
				<div class="card-header">
					
					<div class="heading-elements">
						<span class="avatar">
                        <?php
                            if(!empty($circle->creator->image_path))
                            {
                        ?>
							<img class="rounded-full" src="https://res.cloudinary.com/<?php echo $global_var->cloudinary_code;?>/image/fetch/c_fill,g_face,h_200,w_200/r_max/f_auto/<?php echo $circle->creator->image_path;?>">
                            <?php
                                }
                            ?>
						</span>
					</div>
                    <h5 class="card-title" id="heading-thumbnail"> <a target=_blank href="#<?php echo $circle->creator->id;?>"> <?php echo $circle->creator->last_name." ".$circle->creator->first_name; ?></a> </h5>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
				</div>
				<div class="card-content">
					<div class="card-body">
						<h4 class="card-title"><a href="" class="font-medium"><?php echo $circle->name; ?></a></h4>
						<p class="card-text"><?php echo $circle->description; ?></p>
						
					</div>
				</div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
					<span class="float-left">1 day ago</span>
					<span class="tags float-right">
                    <a href="#" id="<?php echo $circle->id; ?>" data-title="<?php echo $circle->name; ?>" class="getPolls" data-toggle="modal" data-target="#pollsModal"> <button class="badge badge-pill badge-success">Polls</button></a>
					<a href="#" id="<?php echo $circle->id; ?>" data-title="<?php echo $circle->name; ?>" class="getPollPosts" data-toggle="modal" data-target="#postModal"><button class="badge badge-pill badge-info">Posts</button></a>
                    <a href="#" id="<?php echo $circle->id; ?>" data-title="<?php echo $circle->name; ?>" class="getPostMembers" data-toggle="modal" data-target="#postModal"><button class="badge badge-pill badge-primary">Members</button></a>
					</span>
				</div>
			</div>
</div>



<?php
}
}
?>



  <!-- Load Polls Modal -->
  <div id="pollsModal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" >
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto title-name"></h2> 
                           
                        </div> <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body " id="poll_contents">
                        </div> <!-- END: Modal Body -->
                    </div>
                </div>
            </div> 
             <!-- Load Polls Modal #END -->

            <!-- Load Post Modal -->
           <div id="postModal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" >
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto ptitle-name"></h2> 
                           
                        </div> <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body " id="post_contents">
                        </div> <!-- END: Modal Body -->
                    </div>
                </div>
            </div> 
             <!-- Load Post Modal #END -->




             