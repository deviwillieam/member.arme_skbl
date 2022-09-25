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
                    <small class="designation text-muted">Pelanggan</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/pelanggan">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/marker/upload_marker">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Upload marker</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>index.php/marker/list_marker">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">List marker</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>index.php/pelanggan/logout">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">Logout</span>
              </a>
          </li>
         
        </ul>
      </nav>
      <!-- partial -->