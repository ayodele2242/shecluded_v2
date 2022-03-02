<?php
include("../functions.php");

$id = $_POST['id'];
$fname = $_POST['fname'];

?>


<form id="adminUpdate">
                                    
                                   

<div class="form-group"> 
                                        <label for="regular-form-1" class="form-label">Last Name</label> 
                                        <input id="lname" type="text" class="form-control form-control-rounded" name="last_name" placeholder="" value="<?php echo $_POST['lname']; ?>"> 
                                     </div> 
                                     <div class="form-group"> 
                                         <label for="regular-form-2" class="form-label">First Name</label> 
                                         <input id="fname" type="text" class="form-control form-control-rounded" name="first_name" placeholder="" value="<?php echo $_POST['fname']; ?>"> 
                                     </div> 
                                     <div class="form-group"> 
                                         <label for="regular-form-2" class="form-label">Phone Number</label> 
                                         <input id="phone" type="text" class="form-control form-control-rounded" name="phone" placeholder="" value=""> 
                                     </div> 
                                     <div class="form-group"> 
                                         <label for="regular-form-2" class="form-label">Email</label> 
                                         <input id="email" type="email" class="form-control form-control-rounded" name="email" placeholder="" value="<?php echo $_POST['email']; ?>">
                                         <input id="userid" type="hidden" class="form-control form-control-rounded" name="user_id" value="<?php echo $_POST['id']; ?>" > 
                                        
                                     </div> 
 
                                     
                                     <div class="form-group"> 
                                         <label for="regular-form-2" class="form-label">Role</label> 
                                        <select class="form-control tom-select w-full" name="role" id="crole">
                                        <option value=""></option>
                                         <option value="super-admin" <?php if($_POST['role'] == "admin" || $_POST['role'] == "super-admin"){ echo "selected"; } ?> >Admin</option>
                                         <option value="reviewer" <?php if($_POST['role'] == "reviewer" ){ echo "selected"; } ?>>Reviewer</option>
                                         </select>
                                     </div> 
                                    
 
                                
                                 </div>
                                 <div class="px-5 pb-8 text-center mt-5">
                                     <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                     <button type="button" class="btn btn-warning w-24" id="updateBtn">Update</button>
                                 </div>
                                 </form>