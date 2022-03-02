  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
            <li class="nav-item mr-auto"><a class="navbar-brand" href="dashboard"><img class="brand-logo" alt="stack admin logo" src="../assets/images/logo/logo.png" style="width: 100%; max-width: 120px;">
                <h2 class="brand-text"></h2></a></li>
            <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon feather icon-toggle-right font-medium-3 white" data-ticon="feather.icon-toggle-right"></i></a></li>
            <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
             
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>
            
            </ul>

            <ul class="nav navbar-nav float-right">
            
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <div class="avatar avatar-online"><img src="../assets/images/avatar.png" alt="avatar"><i></i></div><span class="user-name"><?php echo $name; ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <!--<a class="dropdown-item" href="user-profile"><i class="feather icon-user"></i> Edit Profile</a>
                  
                  <div class="dropdown-divider"></div>-->
                  <a class="dropdown-item text-danger" href="javascript:;" data-toggle="modal" data-target="#logoutModal">
                    <i class="feather icon-power"></i> Logout
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->