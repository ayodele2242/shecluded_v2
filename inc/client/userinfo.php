<?php
require_once '../admins.php';

if(isset($_POST['id'])){

$userid = $_POST['id'];

$resp = curl_get("",$global_var->base_url."/user/get-user-details/".$userid,"get",$global_var->getToken());

if($resp->success == "true"){

$userdetails = $resp->data->userDetails;
$userPersonal = $resp->data->userDetails->user_details;
$userEmployment = $resp->data->userDetails->employment_details;




if($userdetails->status == "active"){
$sta = "checked";
}else{
    $sta ="";
}

?>
<div class="row">
    <div class="col-12 col-sm-7">
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="../assets/images/avatar.png" alt=""
            class="users-avatar-shadow rounded-circle" width="100" height="100">
        </a>
        <div class="media-body pt-25">
            <h4 class="media-heading"><span class="users-view-name"><?php echo $userdetails->last_name ." ".$userdetails->first_name; ?> </span>
            <span
                class="users-view-username text-muted font-medium-1  ml-2">[<a href="mailto:<?php echo $userdetails->email; ?>"> <i  class="fa fa-envelope"></i> <?php echo $userdetails->email; ?> </a>]</span></h4>
            
            <p class="users-view-id">
            <?php
                if(empty($userdetails->user_details->instagram_handle))
                {
                    echo "<span class=\"text-danger\">Instagram handle not available</span>";
                }else {
                    
                    echo '<a href="https://www.instagram.com/'.$userdetails->user_details->instagram_handle.'"><i  class="fa fa-instagram"></i>'.$userdetails->user_details->instagram_handle.'</a>';
                }
            ?>
            </p>
            <p class="users-view-id">
                <?php
                     if(empty($userdetails->user_details->twitter_handle))
                     {
                         echo "<span class=\"text-danger\">Twitter handle not available</span>";
                     }else {
                         echo '<a href="https://www.twitter.com/'.$userdetails->user_details->twitter_handle.'"><i  class="fa fa-twitter"></i>'. $userdetails->user_details->twitter_handle.'</a>';
                         
                     }

                ?>
            </p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
           <div class="form-group mt-1">
           <input type="checkbox" id="switcherySize2" class="switchery ustaUDetails" data-size="sm" <?php echo $sta; ?> id="<?php echo $userdetails->id; ?>"/>
            </div>
    </div>
  </div>

  <div class="row">
        <div class="col-sm-12 col-lg-6 bg-light-grey">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td class="font-weight-bolder">Employment Details:</td>
                        <td> <?php 
                            if($userEmployment->employer != ""){
                            echo $userEmployment->employer;
                            }else{
                                echo '<span class="text-danger">Employer\'s details not available</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Occupation:</td>
                        <td ><?php echo $userEmployment->job_designation; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Monthly Salary:</td>
                        <td><?php echo number_format($userEmployment->monthly_salary,2); ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Career Type:</td>
                        <td><?php echo $userEmployment->career_type; ?></td>
                    </tr>

                    </tbody>
                </table>
        </div>

        <div class="col-sm-12 col-lg-6 bg-light-grey">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td class="font-weight-bolder">Home Address:</td>
                        <td> <?php 
                            if($userEmployment->employer != ""){
                            echo $userEmployment->employer;
                            }else{
                                echo '<span class="text-danger">Employer\'s details not available</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Phone Number:</td>
                        <td ><?php echo $userdetails->phone_no; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Date of Birth:</td>
                        <td><?php echo explode("T",$userPersonal->date_of_birth)[0]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bolder">Marital Status:</td>
                        <td><?php echo $userPersonal->marital_relationship; ?></td>
                    </tr>

                    </tbody>
                </table>
        </div>


  </div>

  <div class="row pt-3 pb-3" style="background: #f1f1f1;">
   <div class="h4 col-12"> Account Details</div>
   <div class="col-sm-12 col-lg-6">
        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bolder">BVN Status:</td>
                                    <td> <?php
                                                                
                                            if(($userdetails->is_bvn_verified == "false") || (empty($userdetails->is_bvn_verified)))
                                            echo "<font color=\"maroon\"><b>Not Verified</b></font>";
                                            else
                                            echo "<font color=\"blue\"><b>Verified</b></font>";

                                        ?>
                                    </td>
                        </tr>
                        <tr>
                                
                                    <td class="font-weight-bolder">Withdrawal PIN:</td>
                                    <td >
                                        <?php
                                                                
                                        if(($userdetails->has_withdrawal_pin == "false") || (empty($userdetails->has_withdrawal_pin)))
                                        echo "<font color=\"maroon\"><b>not set</b></font>";
                                        else
                                        
                                        echo "<font color=\"blue\"><b>activated</b></font>";
                                        ?>
                                    </td>
                        </tr>

                        <tr>
                        <td class="font-weight-bolder">Account Status:</td>
                        <td><?php echo $userdetails->status; ?></td>
                        </tr>

                        </body>
                        </table>
                        </div>
                        <div class="col-sm-12 col-lg-6">

                        <table class="table table-borderless">
                            <tbody>

                       

                        <tr>
                        <td class="font-weight-bolder">Account Modified:</td>
                        
                        <td>
                        <?php 
                        $date=date_create($userdetails->updatedAt);
                        echo date_format($date,"Y-m-d");
                          ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="font-weight-bolder">Account Created:</td>
                        <td><?php echo $userdetails->createdAt; ?></td>
                        </tr>
                        <tr>
                   
                        <td class="font-weight-bolder">Account ID:</td>
                        <td><?php echo $userdetails->id; ?></td>
                    </tr>
                </tbody>
        </table>
    </div>
  </div>

  <div class="row">
  
  <div class="col-xl-12 col-lg-12">
			<div class="card">
				
				<div class="card-content">
					<div class="card-body">
						
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab" aria-selected="true">Loans</a>
							</li>
							<!--<li class="nav-item">
								<a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab" aria-selected="false">Group Savings</a>
							</li>-->
							<li class="nav-item">
								<a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab" aria-selected="false">Insurance</a>
							</li>
                            <!--<li class="nav-item">
								<a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Account Statement</a>
							</li>-->
                            <li class="nav-item">
								<a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5" href="#tab5" role="tab" aria-selected="false">Accounts</a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#tab6" role="tab" aria-selected="false">Cards</a>
							</li>
							
						</ul>

						<div class="tab-content px-1 pt-1">

							<div class="tab-pane active LoansDiv" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
							
                                <table class="table table-striped  file-export" id="loansTbl" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">PURPOSE</th>
                                    <th scope="col">PRINCIPAL</th>
                                    <th scope="col">INTEREST</th>
                                    <th scope="col">START</th>
                                    <th scope="col">END</th>
                                    <th scope="col">FREQ</th>
                                    <th scope="col">PAID</th>
                                    <th scope="col">BALANCE</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">MORE</th>
                                </tr>
                                </thead>
                            

                                </table>

							</div>

							<div class="tab-pane savingDiv" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                           
                           
                            <table class="table table-striped table-striped -mt-2" id="savingCatTbl" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">#ID</th>
                                        <th class="whitespace-nowrap">Category</th>
                                        <th class="whitespace-nowrap">Account Name</th>
                                        <th class="whitespace-nowrap">Target Amount</th>
                                        <th class="whitespace-nowrap">Description</th>
                                        <th class="whitespace-nowrap">Start Date</th>
                                        <th class="whitespace-nowrap">Start Date</th>
                                       
                                        <th class="whitespace-nowrap">Status</th>
                                        <!-- <th class="text-center whitespace-nowrap">MORE</th> -->
                                    </tr>
                                </thead>
                            </table>

							</div>

							<div class="tab-pane InsuranDiv" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                            <table class="table table-striped -mt-2" id="insuranceTbl" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">#ID</th>
                                        <th class="whitespace-nowrap">PACKAGE</th>
                                        <th class="whitespace-nowrap">PLAN</th>
                                        <th class="whitespace-nowrap">PAID</th>
                                        <th class="whitespace-nowrap">FULL AMOUNT</th>
                                        <th class="whitespace-nowrap">BALANCE</th>
                                        <th class="whitespace-nowrap">CREATE DATE</th>
                                        <th class="whitespace-nowrap">UPDATED</th>
                                        <th class="whitespace-nowrap">STATUS</th>
                                        <!-- <th class="text-center whitespace-nowrap">MORE</th> -->
                                    </tr>
                                </thead>
                            </table>
                            </div>
                            <!--<div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
								Wallet
                            </div>-->
                            <div class="tab-pane acctsDiv" id="tab5" role="tabpanel" aria-labelledby="base-tab5">
                            <table class="table table-striped -mt-2" id="acctsTbl" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">#ID</th>
                                        <th class="whitespace-nowrap">ACCOUNT NAME</th>
                                        <th class="whitespace-nowrap">ACCOUNT NUMBER</th>
                                        <th class="whitespace-nowrap">TYPE</th>
                                        <th class="whitespace-nowrap">STATUS</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>

                            </table>
                            </div>
                            <div class="tab-pane cardsDiv" id="tab6" role="tabpanel" aria-labelledby="base-tab6">
                                <table class="table table-striped -mt-2" id="cardsTbl" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">#ID</th>
                                            <th class="whitespace-nowrap">CARD NUMBER</th>
                                            <th class="whitespace-nowrap">TYPE</th>
                                            <th class="whitespace-nowrap">EXP DATE</th>
                                            <th class="whitespace-nowrap">CARD STATE</th>
                                        
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            
						</div>

					</div>
				</div>
			</div>
		</div>

  </div>
  





<script>

  $(document).ready(function() {

 var data = {'id': "<?php echo $userid;  ?>"};
 var id = {'id': "003e3c21-6b4a-4663-b537-8f3c842f40f1"};

 var loansTbl;


  loansTbl = $('#loansTbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 300,
    'ajax': {
      type: 'POST',
      'url': '../inc/client/getUserLoans.php',
      "data": data,
      "method": "POST",
      error: function (xhr, error, code)
            {
               
                if(xhr.responseText.includes("stdClass::$success")){
                    $('.LoansDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not found'){
                    $('.LoansDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.LoansDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }
                
                
            }
    }
  });//Loans ends



//Insurance
var insuranceTbl = $('#insuranceTbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 300,
    'ajax': {
      type: 'POST',
      'url': '../inc/client/getUserInsurance.php',
      "data": data,
      "method": "POST",
      error: function (xhr, error, code)
            {
              
                if(xhr.responseText.includes("stdClass::$success")){
                    $('.InsuranDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not foundNot Found'){
                    $('.InsuranDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.InsuranDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }
                
                
            }
    }
});



var acctsTbl = $('#acctsTbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 300,
    'ajax': {
      type: 'POST',
      'url': '../inc/client/getUserAccount.php',
      "data": data,
      "method": "POST",
      error: function (xhr, error, code)
            {
              
                if(xhr.responseText.includes("stdClass::$success")){
                    $('.acctsDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not foundNot Found'){
                    $('.acctsDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.acctsDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }
                
                
            }
    }
});



var cardsTbl = $('#cardsTbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 300,
    'ajax': {
      type: 'POST',
      'url': '../inc/client/getUserCards.php',
      "data": data,
      "method": "POST",
      error: function (xhr, error, code)
            {
              
                if(xhr.responseText.includes("stdClass::$success")){
                    $('.cardsDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not foundNot Found'){
                    $('.cardsDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.cardsDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }
                
                
            }
    }
});



var savingCatTbl = $('#savingCatTbl').DataTable({
    'processing': true,
    'serverSide': true,
     dom: 'Bfrtip',
     "scrollX": true,
     "scrollY": 300,
    'ajax': {
      type: 'POST',
      'url': '../inc/client/fetchUserSavings.php',
      "data": id,
      "method": "POST",
      error: function (xhr, error, code)
            {
              
                if(xhr.responseText.includes("stdClass::$success")){
                    $('.savingDiv').html('<div class="alert alert-danger">Token has expired. Please log out!!</div>');
                }else if(code == 'not foundNot Found'){
                    $('.savingDiv').html('<div class="alert alert-danger">The system could not locate the url.</div>');
                }else{
                    $('.savingDiv').html('<div class="alert alert-danger">'+code+'</div>');
                }
                
                
            }
    }
});



});




$(document).ready(function(){
                $(document).on('click', '.ustaUDetails', function() {

                    var checkStatus = this.checked ? 1 : 0;
                    var id = $(this).attr('id'); // get id of clicked row
                    $.post("../inc/client/user_status_updates.php", {"id": id, "sta":checkStatus, }, 
                function(data) {
                    if(data == "done"){
                       
                        $('.toast').removeClass('alert-danger').addClass('alert-success').toast('show');
                        $('.toast-body').html("Account activated successfully");
                        $('.theader').html("Success");
                    }else{
                    $('.toast').addClass('alert-danger').toast('show');
                    $('.toast-body').html(data);
                    $('.theader').html("Error Message");
                    }
                    
                });

                });




            });
 
</script>



  <?php
}
}else{
    echo "Nothing here to fetch";
}
?>