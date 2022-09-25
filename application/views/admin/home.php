<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome | Admin Dashboard</title>
  <!-- plugins:css -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.3.1.js"></script>
  
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/vendor.bundle.addons.css">

  <!-- table -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap4table.css">

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
  <!-- table -->


  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/favicon.png" />

  <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo site_url() ?>/admin">
          <img src="http://armestudio.id/uploads/header_logo/header_logo_1544110504.png" alt="logo" style="min-height:50px;"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo site_url() ?>/admin">
          <img src="http://armestudio.id/uploads/header_logo/header_logo_1544110504.png" alt="logo" style="min-width:50px;"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <!--<i class="mdi mdi-file-document-box"></i>-->
              <!--<span class="count">7</span>-->
            </a>
            <!--<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">-->
            <!--  <div class="dropdown-item">-->
            <!--    <p class="mb-0 font-weight-normal float-left">You have 7 unread mails-->
            <!--    </p>-->
            <!--    <span class="badge badge-info badge-pill float-right">View all</span>-->
            <!--  </div>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <img src="<?php echo base_url() ?>/assets/images/faces/face4.jpg" alt="image" class="profile-pic">-->
            <!--    </div>-->
            <!--    <div class="preview-item-content flex-grow">-->
            <!--      <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey-->
            <!--        <span class="float-right font-weight-light small-text">1 Minutes ago</span>-->
            <!--      </h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        The meeting is cancelled-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <img src="<?php echo base_url() ?>/assets/images/faces/face2.jpg" alt="image" class="profile-pic">-->
            <!--    </div>-->
            <!--    <div class="preview-item-content flex-grow">-->
            <!--      <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook-->
            <!--        <span class="float-right font-weight-light small-text">15 Minutes ago</span>-->
            <!--      </h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        New product launch-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <img src="<?php echo base_url() ?>/assets/images/faces/face3.jpg" alt="image" class="profile-pic">-->
            <!--    </div>-->
            <!--    <div class="preview-item-content flex-grow">-->
            <!--      <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson-->
            <!--        <span class="float-right font-weight-light small-text">18 Minutes ago</span>-->
            <!--      </h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        Upcoming board meeting-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--</div>-->
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <!--<i class="mdi mdi-bell"></i>-->
              <!--<span class="count">4</span>-->
            </a>
            <!--<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">-->
            <!--  <a class="dropdown-item">-->
            <!--    <p class="mb-0 font-weight-normal float-left">You have 4 new notifications-->
            <!--    </p>-->
            <!--    <span class="badge badge-pill badge-warning float-right">View all</span>-->
            <!--  </a>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <div class="preview-icon bg-success">-->
            <!--        <i class="mdi mdi-alert-circle-outline mx-0"></i>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="preview-item-content">-->
            <!--      <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        Just now-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <div class="preview-icon bg-warning">-->
            <!--        <i class="mdi mdi-comment-text-outline mx-0"></i>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="preview-item-content">-->
            <!--      <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        Private message-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--  <div class="dropdown-divider"></div>-->
            <!--  <a class="dropdown-item preview-item">-->
            <!--    <div class="preview-thumbnail">-->
            <!--      <div class="preview-icon bg-info">-->
            <!--        <i class="mdi mdi-email-outline mx-0"></i>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="preview-item-content">-->
            <!--      <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>-->
            <!--      <p class="font-weight-light small-text">-->
            <!--        2 days ago-->
            <!--      </p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--</div>-->
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?php echo $nama_sidebar ?></span>
              <img class="img-xs rounded-circle" src="<?php echo base_url() ?>/assets/images/faces/face1.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            
              <a class="dropdown-item" href="<?php echo base_url() ?>index.php/admin/logout">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    
    <!-- sidebar -->
      <?php echo $this->load->view($sidebar) ?>
    <!-- sidebar -->



      <div class="main-panel">
       
        <div class="content-wrapper">
          <div class="row purchace-popup">
            <div class="col-12">
              
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <?php $this->load->view($content) ?>
            </div>
          </div>


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url() ?>/assets/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url() ?>/assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url() ?>/assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>