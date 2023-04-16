

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>IP 1</th>
                    <th>IP 2</th>
                    <th>IP 3</th>
                    <th>IP 4</th> -->
                    <th>Alamat</th> 
                    <th>Status Kelulusan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa");
                    while($mhs = mysqli_fetch_array($query)){
                      $no++
                    ?>
                  <tr>
                    <td width='5%'><?php echo $no;?></td>
                    <td><?php echo $mhs['nama'];?></td>
                    <td><?php echo $mhs['nim'];?></td>
                    <td><?php echo $mhs['jenkel'];?></td>
                    <td><?php echo $mhs['usia'];?></td>
                    <td><?php echo $mhs['ip1'];?></td>
                    <td><?php echo $mhs['ip2'];?></td>
                    <td><?php echo $mhs['ip3'];?></td>
                    <td><?php echo $mhs['ip4'];?></td> -->
                    <td><?php echo $mhs['alamat'];?></td>
                    <td>X</td>
                  </tr> 
                  <?php }?>                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
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
</div>
  
