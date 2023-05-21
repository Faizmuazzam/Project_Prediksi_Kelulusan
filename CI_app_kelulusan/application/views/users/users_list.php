  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Data Users</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Users</li>
                  </ol>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content users">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">DataTable with minimal features & hover style</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                          <div class="row">
                              <div class="col-md-4">
                                  <!-- <?php echo anchor(site_url('users/create'), 'Create', 'class="btn btn-success"'); ?> -->
                              </div>
                              <div class="col-md-4 text-center">
                                  <div style="margin-top: 8px" id="message">
                                      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                  </div>
                              </div>
                              <div class="col-md-4 text-right d-flex justify-content-end">
                                  <form action="<?php echo site_url('users/index'); ?>" class="form-inline" method="get">
                                      <div class="input-group">
                                          <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                          <span class="input-group-btn">
                                              <?php
                                                if ($q <> '') {
                                                ?>
                                                  <a href="<?php echo site_url('users'); ?>" class="btn btn-danger rounded-0">Reset</a>
                                              <?php
                                                }
                                                ?>
                                              <button class="btn btn-secondary rounded-0" type="submit">Search</button>
                                          </span>
                                      </div>
                                  </form>
                              </div>
                          </div>

                          <div class="py-3"></div>
                          <table class="table table-bordered table-hover ">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Username</th>
                                      <!-- <th>Password</th> -->
                                      <th>Email</th>
                                      <th>Nama</th>
                                      <th>Jenis Kelamin</th>
                                      <th>No Telp</th>
                                      <th>Alamat</th>
                                      <!-- <th>Image</th> -->
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($users_data as $users) : ?>
                                      <tr>
                                          <td width="80px"><?php echo ++$start ?></td>
                                          <td><?php echo $users->username ?></td>
                                          <!-- <td><?php echo $users->password ?></td> -->
                                          <td><?php echo $users->email ?></td>
                                          <td><?php echo $users->nama ?></td>
                                          <td><?php echo $users->jenis_kelamin ?></td>
                                          <td><?php echo $users->no_telp ?></td>
                                          <td><?php echo $users->alamat ?></td>
                                          <!-- <td><?php echo $users->image ?></td> -->
                                          <td><?php echo $users->status ?></td>
                                          <td style="text-align:center" width="200px">
                                              <?php
                                                // echo anchor(base_url('users/read/' . $users->id), 'Read');
                                                // echo ' | ';
                                                // echo anchor(base_url('users/update/' . $users->id), 'Update');
                                                // echo ' | ';
                                                // echo anchor(base_url('users/delete/' . $users->id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                                // 
                                                ?>

                                              <!-- <a href="<?= base_url('users/read/' . $users->id) ?>" class="btn btn-primary">
                                                  <span class="iconify" data-icon="material-symbols:search"></span>
                                              </a> -->

                                              <a href="<?= base_url('users/update/' . $users->id) ?>" class="btn btn-warning">
                                                  <span class="iconify" data-icon="material-symbols:edit"></span>
                                              </a>

                                              <a href="<?= base_url('users/delete/' . $users->id) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">
                                                  <span class="iconify" data-icon="material-symbols:delete-outline"></span>
                                              </a>
                                          </td>
                                      </tr>
                                  <?php endforeach ?>
                              </tbody>

                          </table>

                          <div class="py-2"></div>
                          <div class="row">
                              <div class="col-md-6">
                                  <a href="#" class="btn">Total Record : <?php echo $total_rows ?></a>
                              </div>
                              <div class="col-md-6 text-right">
                                  <?php echo $pagination ?>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <style>
      .content.users table tr td {
          vertical-align: middle !important;
      }
  </style>