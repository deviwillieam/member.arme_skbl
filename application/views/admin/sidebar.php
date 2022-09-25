<!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="<?php echo base_url() ?>/assets/images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $nama_sidebar ?></p>
                  <div>
                    <small class="designation text-muted">Admin</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/admin">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/video_admin">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">List video</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/marker_admin">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">List marker</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>index.php/pembelian">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Pembelian</span>
              </a>
          </li>
           <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>index.php/app_version">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">App version</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>index.php/admin/logout">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">Logout</span>
              </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->