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
            <form id="Create" class="form-horizontal">
               

                <div class="form-body">
                        <div id="resp"></div>

                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Amount</label>
                            <div class="col-lg-12">
                            <input id="amt" type="number" class="form-control form-control-rounded" name="amount" placeholder=""> 
                            <input id="userid" type="hidden" value="<?php  echo $_POST['id']; ?>" name="userid"> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 label-control" for="eventRegInput1">Narration</label>
                            <div class="col-lg-12">
                            <textarea id="narration" rows="10" style="width: 100%;" name="narration"></textarea>
                            </div>
                        </div>

                    
                        <div class="form-actions center">
                            <button type="button" class="btn btn-warning mr-1 cancelit">
                                <i class="feather icon-x"></i> Close
                            </button>
                            <?php if($_SESSION['role'] == 'super-admin'){ ?>
                            <button type="submit" class="btn btn-primary" id="createBtn">
                                <i class="fa fa-check-square-o"></i> Create
                            </button>
                            <?php } ?>
                        </div>


                </div>

            </form>
 </div>      
       