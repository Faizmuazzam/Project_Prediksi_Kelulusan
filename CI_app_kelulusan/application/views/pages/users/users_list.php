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
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                  <?php echo anchor(site_url('users/create'), 'Create', 'class="btn btn-success"'); ?>
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
                          <a href="<?php echo site_url('users'); ?>" class="btn btn-danger">Reset</a>
                        <?php
                        }
                        ?>
                        <button class="btn btn-secondary rounded-0" type="submit">Search</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users_data as $users) : ?>
                    <tr>
                      <td width="80px"><?php echo ++$start ?></td>
                      <td><?php echo $users->username ?></td>
                      <td><?php echo $users->password ?></td>
                      <td><?php echo $users->email ?></td>
                      <td><?php echo $users->nama ?></td>
                      <td><?php echo $users->jenis_kelamin ?></td>
                      <td><?php echo $users->no_telp ?></td>
                      <td><?php echo $users->alamat ?></td>
                      <td><?php echo $users->image ?></td>
                      <td><?php echo $users->status ?></td>
                      <td style="text-align:center" width="200px">
                        <?php
                        echo anchor(site_url('users/read/' . $users->id), 'Read');
                        echo ' | ';
                        echo anchor(site_url('users/update/' . $users->id), 'Update');
                        echo ' | ';
                        echo anchor(site_url('users/delete/' . $users->id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                        ?>
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



  <!-- jQuery -->
  <script src="<?= base_url() ?>assets_lib/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets_lib/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets_lib/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>assets_lib/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets_lib/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets_lib/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>