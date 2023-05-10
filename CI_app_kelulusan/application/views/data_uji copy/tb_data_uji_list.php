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

  <section class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <div class="card-body table-responsive">
                  <div class="row">
                      <div class="col-md-6">
                          <?php echo anchor(site_url('data_uji/import'), 'Import', 'class="btn btn-primary me-3"'); ?>
                          <?php echo anchor(site_url('data_uji/excel'), 'Excel', 'class="btn btn-success"'); ?>

                      </div>
                      <!-- <div class="col-md-4 text-center">
                          <div style="margin-top: 8px" id="message">
                              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                          </div>
                      </div> -->
                      <div class="col-md-6 text-right d-flex justify-content-end">
                          <form action="<?php echo site_url('data_uji/index'); ?>" class="form-inline" method="get">
                              <div class="input-group">
                                  <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                  <span class="input-group-btn">
                                      <?php
                                        if ($q <> '') {
                                        ?>
                                          <a href="<?php echo site_url('data_uji'); ?>" class="btn btn-default">Reset</a>
                                      <?php
                                        }
                                        ?>
                                      <button class="btn btn-primary" type="submit">Search</button>
                                  </span>
                              </div>
                          </form>
                      </div>
                  </div>

                  <div class="py-2"></div>

                  <table class="table table-bordered" style="margin-bottom: 10px">
                      <tr>
                          <th>No</th>
                          <th>Nim</th>
                          <th>Jenis Kelamin</th>
                          <th>Ipk1</th>
                          <th>Ipk2</th>
                          <th>Ipk3</th>
                          <th>Ipk4</th>
                          <th>Ipk Akhir</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                      </tr><?php
                            foreach ($data_uji_data as $data_uji) {
                            ?>
                          <tr>
                              <td width="80px"><?php echo ++$start ?></td>
                              <td><?php echo $data_uji->nim ?></td>
                              <td><?php echo $data_uji->jenis_kelamin ?></td>
                              <td><?php echo $data_uji->ipk1 ?></td>
                              <td><?php echo $data_uji->ipk2 ?></td>
                              <td><?php echo $data_uji->ipk3 ?></td>
                              <td><?php echo $data_uji->ipk4 ?></td>
                              <td><?php echo $data_uji->ipk_akhir ?></td>
                              <td><?php echo $data_uji->keterangan ?></td>
                              <td style="text-align:center" width="200px">
                                  <?php
                                    // echo anchor(site_url('data_uji/read/' . $data_uji->id), 'Read');
                                    // echo ' | ';
                                    // echo anchor(site_url('data_uji/update/' . $data_uji->id), 'Update');
                                    // echo ' | ';
                                    // echo anchor(site_url('data_uji/delete/' . $data_uji->id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                    ?>

                                  <!-- <a href="<?= base_url('data_uji/read/' . $data_uji->id) ?>" class="btn btn-primary">
                                      <span class="iconify" data-icon="material-symbols:search"></span>
                                  </a>

                                  <a href="<?= base_url('data_uji/update/' . $data_uji->id) ?>" class="btn btn-warning">
                                      <span class="iconify" data-icon="material-symbols:edit"></span>
                                  </a> -->

                                  <a href="<?= base_url('data_uji/delete/' . $data_uji->id) ?>" onclick="javasciprt: return confirm(\'Are You Sure ?\')" class="btn btn-danger">
                                      <span class="iconify" data-icon="material-symbols:delete-outline"></span>
                                  </a>
                              </td>
                          </tr>
                      <?php
                            }
                        ?>
                  </table>

                  <div class="row">
                      <div class="col-md-6">
                          <a href="#" class="btn">Total Record : <?php echo $total_rows ?></a>
                      </div>
                      <div class="col-md-6 text-right">
                          <div class="vPaginations">
                              <?php echo $pagination ?>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <style>
      .vPaginations nav ul {
          display: flex;
          justify-content: end;

      }

      .vPaginations nav ul li {
          padding: 10px;
          border: 1px solid #ccc;
          border-right: 0;
      }

      .vPaginations nav ul li.active {
          background-color: #007bff;
          color: #fff;
      }

      .vPaginations nav ul li:last-of-type {
          border-right: 1px solid #ccc;
      }
  </style>