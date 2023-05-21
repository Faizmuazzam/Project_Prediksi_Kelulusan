  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>index3.html" class="brand-link">
      <img src="<?= base_url() ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">App Prediksi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?= base_url() ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('nama_user') ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('/') ?>" class="nav-link <?= ($this->uri->uri_string() == '') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('/data_prediksi') ?>" class="nav-link <?= ($this->uri->uri_string() == 'data_prediksi') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Prediksi Kelulusan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('/data_uji') ?>" class="nav-link <?= ($this->uri->uri_string() == 'data_uji') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Uji Data
                <span class="right badge badge-success">Testing</span>
              </p>
            </a>
          </li>

          <li class="nav-header">Data Master</li>
          <li class="nav-item">
            <a href="<?= base_url('users') ?>" class="nav-link <?= ($this->uri->uri_string() == 'users') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('/data_latih') ?>" class="nav-link <?= ($this->uri->uri_string() == 'data_latih') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Data Latih
                <span class="right badge badge-danger">Training</span>
              </p>
            </a>
          </li>
          <li class="nav-header">Auth</li>
          <li class="nav-item">
            <a href="<?= base_url('/auth/logout') ?>" class="nav-link">
              <!-- <i class="nav-icon fas fa-folder"></i> -->
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>