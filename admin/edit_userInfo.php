<?php
require_once '../inc/admins.php';
?>

<style>
.iFormBody{
    height: 100%;
    max-height: 100%;
    top:0;
    bottom: 0;
    background: #f1f1f1;
}

</style>

<div class="iFormBody p-2" >
<div class="alert alert-infos"><h4 class="font-weight-bolder text-grey"><?php  echo ucwords($_POST['name']); ?></h4></div>
            <form id="userUpdate" class="form-horizontal">
               

                <div class="form-body">
                        <div id="resp"></div>

                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Last Name</label>
                            <div class="col-lg-12">
                            <input id="lname" type="text" class="form-control form-control-rounded" name="last_name" value="<?php  echo $_POST['lname']; ?>" placeholder=""> 
                            <input id="uid" type="hidden" value="<?php  echo $_POST['id']; ?>" name="user_id"> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">First Name</label>
                            <div class="col-lg-12">
                            <input id="fname" type="text" class="form-control form-control-rounded" name="first_name" value="<?php  echo $_POST['fname']; ?>" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Phone Number</label>
                            <div class="col-lg-12">
                            <input id="phone" type="text" class="form-control form-control-rounded" name="phone" value="<?php  echo $_POST['phone']; ?>" placeholder=""> 
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-12 label-control" for="eventRegInput1">DoB</label>
								<div class='input-group'>
									<input type='text' class="form-control singledate" name="dob" value="<?php  echo $_POST['dob']; ?>"/>
									<div class="input-group-append">
										<span class="input-group-text">
											<span class="fa fa-calendar"></span>
										</span>
									</div>
								</div>
						</div>

                       

                    
                        <div class="form-actions center">
                            <button type="button" class="btn btn-warning mr-1 cancelit">
                                <i class="feather icon-x"></i> Close
                            </button>
                          
                            <button type="submit" class="btn btn-danger" id="updateBtn">
                                <i class="fa fa-check-square-o"></i> Update
                            </button>
                           
                        </div>


                </div>

            </form>
 </div>      
       