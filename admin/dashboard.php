<?php
    include("header.php");
    include("top-nav.php");
    include("side-menus.php");
?>
  


  

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Tour Guide</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Extra Components</a>
                  </li>
                  <li class="breadcrumb-item active">Tour
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
              <div class="btn-group" role="group">
                <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings icon-left"></i> Settings</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Bootstrap Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons Extended</a></div>
              </div><a class="btn btn-outline-primary" href="full-calender-basic.html"><i class="feather icon-mail"></i></a><a class="btn btn-outline-primary" href="timeline-center.html"><i class="feather icon-pie-chart"></i></a>
            </div>
          </div>
        </div>
        
        <div class="content-body">
            <!-- tour guide start -->
            <section class=" tour-wrapper">
                <!-- Basic Tour Start here -->
                <div class="basic-tour">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title m-0 p-0">Tour</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="btn btn-outline-primary waves-effect waves-light text-center px-2" id="tour">
                                            Start Tour</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <!-- tour guide ends -->
        </div>
        
      </div>
    </div>
    <!-- END: Content-->



<?php
    include("customizer.php");
    include("footer.php");
?>