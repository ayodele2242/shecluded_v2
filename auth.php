<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Shecluded">
    <title>Login Page</title>
    <link rel="apple-touch-icon" href="assets/images/logo/logo.png">
    
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu_types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/pages/login-register.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <!-- END: Custom CSS-->

    <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
    
    

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu 1-column   blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
    <!--<div class="toast_wrapper">
              <div class="toast">
                <div class="content">
                  <div class="icon"><i class="uil uil-wifi"></i></div>
                  <div class="details">
                    <span>You're online now</span>
                    <p>Hurray! Internet is connected.</p>
                  </div>
                </div>
                <div class="close-icon"><i class="uil uil-times"></i></div>
              </div>
        </div>-->
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row" id="online_title">
        </div>
        
        

        <div class="content-body"><section class="row flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1"><img src="assets/images/logo/logo.png"
                                alt="Shecluded logo" style="width: 100%; max-width: 120px;"></div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Admin Login</span></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple relative" id="login-form">

                            <fieldset class="form-group position-relative has-icon-left mb-2">
                                <input type="text" class="form-control form-control-lg" id="email"
                                    placeholder="Email">
                                <div class="form-control-position">
                                    <i class="feather icon-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control form-control-lg" id="password"
                                    placeholder="Password">
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                              
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                   
                                </div>
                                <div class="col-sm-6 col-12 text-center text-sm-right"></div>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block mbtn"><i
                                    class="feather icon-unlock"></i> Login</button>

                                    <div class="overlay hidden"></div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section>
        </div>
      </div>
    </div>
    <!-- END: Content-->


  <div class="toast fade" role="alert" style="position: absolute; top: 20px; right: 50px;" data-delay="30000">
    <div class="toast-header">
      <strong class="mr-auto theader"></strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
     
    </div>
  </div>


    <script src="assets/js/pwa.js"></script>
    <!-- BEGIN: Vendor JS-->
    <script src="assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="assets/js/core/app-menu.min.js"></script>
    <script src="assets/js/core/app.min.js"></script>
    <script src="assets/js/scripts/pages/bootstrap-toast.min.js"></script>
    <!-- END: Theme JS-->
   <!-- <script src="assets/js/online.js"></script>-->
    <script type="text/javascript" src="assets/js/login.js"></script>



  </body>
  <!-- END: Body-->
</html>