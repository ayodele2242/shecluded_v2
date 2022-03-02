 
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Hello <strong><?php echo ucwords($name).' </strong>'. $signOutQuip; ?>
            </div>
            <div class="modal-footer">
            	<a href="logout" class="btn btn-danger btn-small btn-icon-alt font-weight-bold"><?php echo $signOutBtn; ?>  <i class="fas fa-sign-out-alt"></i></a>
                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal"><?php echo $cancelBtn; ?></button>
                
            </div>
        </div>
    </div>
</div>









 <div class="sidenav-overlay"></div>
 <div class="drag-target"></div>

 <div class="toast fade" role="alert" style="position: absolute; top: 70px; right: 50px; z-index:302" data-delay="30000">
    <div class="toast-header">
      <strong class="mr-auto theader"></strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
     
    </div>
  </div>


  <script src="../assets/js/pwa.js"></script>
 <!-- BEGIN: Vendor JS-->
 <script src="../assets/vendors/js/vendors.min.js"></script>

 
 <script src="../assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
 <script src="../assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"></script>
 <script src="../assets/vendors/js/pickers/pickadate/picker.js"></script>
 <script src="../assets/vendors/js/pickers/pickadate/picker.date.js"></script>
 <script src="../assets/vendors/js/pickers/pickadate/picker.time.js"></script>
 <script src="../assets/vendors/js/pickers/pickadate/legacy.js"></script>
 <script src="../assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
 <script src="../assets/vendors/js/scripts/pickers/dateTime/bootstrap-datetime.min.js"></script>
 <script src="../assets/vendors/js/scripts/pickers/dateTime/pick-a-datetime.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/datatables.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/buttons.flash.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/jszip.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
 <script src="../assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
 <script src="../assets/vendors/js/tables/datatable/buttons.print.min.js"></script>


 <script src="../assets/js/core/app-menu.min.js"></script>
 <script src="../assets/js/core/app.min.js"></script>
 <script src="../assets/js/scripts/customizer.min.js"></script>
 <script src="../assets/js/scripts/forms/switch.min.js"></script>
 <script src="../assets/js/scripts/pages/bootstrap-toast.min.js"></script>


 <!--<script src="../assets/vendors/js/tables/datatable/datatable-advanced.min.js"></script>-->

 <!--<script src="../assets/js/placeholder.js"></script>-->

</body>
<!-- END: Body-->
</html>