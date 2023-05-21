  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Welcome, <?php echo $this->session->userdata('nama_user') ?></h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
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
                  <!-- Default box -->
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">What can we help you with?</h3>

                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                      <div class="card-body">
                          <p>
                              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloribus cumque nam corrupti. Adipisci aperiam consequatur eum unde est dolore alias doloremque facilis ut quisquam ratione nam, libero fuga similique voluptates ex esse! Deleniti, quos? Quis nesciunt asperiores similique totam doloribus ipsam quia quisquam alias repudiandae aliquam, incidunt atque harum corrupti. Placeat in quo, temporibus ut error enim magnam et, voluptatibus ipsa deserunt, nisi nihil est. Nostrum doloribus omnis magni, officiis quo voluptate perferendis pariatur corrupti.
                          </p>
                      </div>

                  </div>
                  <!-- /.card -->
              </div>
          </div>
      </div>
  </section>
  <div class="py-1"></div>
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-3">
                  <div class="small-box bg-danger">
                      <div class="inner">
                          <h3><?php echo $percentageOnTime ?><sup style="font-size: 20px">%</sup></h3>
                          <p>Prediksi Mahasiswa Lulus</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="small-box bg-success">
                      <div class="inner">
                          <h3><?php echo $dataAccuracy ?><sup style="font-size: 20px">%</sup></h3>
                          <p>Akurasi</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="small-box bg-warning">
                      <div class="inner">
                          <h3><?php echo $totalDataUji ?><sup style="font-size: 20px"></sup></h3>
                          <p>Jumlah Data Uji</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="small-box bg-primary">
                      <div class="inner">
                          <h3><?php echo $totalDataLatih ?><sup style="font-size: 20px"></sup></h3>
                          <p>Jumlah Data Latih</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- /.content -->