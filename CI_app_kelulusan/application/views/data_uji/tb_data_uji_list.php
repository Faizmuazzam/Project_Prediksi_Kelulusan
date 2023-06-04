<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Uji Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Uji</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Setting Data Uji</h3>
            </div>
            <div class="card-body">
                <div class="desc">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quod in perferendis, saepe eaque mollitia minus soluta dolorum veritatis iste sequi, at animi cumque nobis obcaecati culpa maxime. Vitae ullam perferendis placeat similique veniam, possimus ipsa impedit! Vero eaque illo quam accusantium. Natus expedita voluptatem voluptates laudantium, error placeat repellendus.</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php if (!empty($probStatus)) : ?>
                            <form action="<?= base_url('data_uji') ?>" method="post">
                                <div class="row">
                                    <?php
                                    $dataSelect = [
                                        [
                                            'val' => 0.1,
                                            'opt' => '10%'
                                        ],
                                        [
                                            'val' => 0.15,
                                            'opt' => '15%'
                                        ],
                                        [
                                            'val' => 0.25,
                                            'opt' => '25%'
                                        ],
                                        [
                                            'val' => 0.35,
                                            'opt' => '35%'
                                        ],
                                        [
                                            'val' => 0.5,
                                            'opt' => '50%'
                                        ],
                                        [
                                            'val' => 0.75,
                                            'opt' => '75%'
                                        ],
                                    ]
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="filterDataUji" id="filterDataUji" class="form-control">
                                                <?php foreach ($dataSelect as $key => $value) : ?>
                                                    <option value=<?= $value['val'] ?> <?= ($filterData == $value['val'] ? 'selected' : '') ?>><?= $value['opt'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success" id="filterData" onclick="hideLoader()">
                                            Filter Data
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php endif ?>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <?php
                            if (empty($probStatus) && !empty($data_latih)) : ?>
                                <form action="<?php echo base_url('data_uji/action_count_prob') ?>" method="post">
                                    <button class="btn btn-success mr-2" type="submit" id="hitungProb" onclick="hideLoader()">
                                        Hitung Propabilitas
                                    </button>
                                </form>
                            <?php endif ?>
                            <?php
                            if (empty($data_latih)) {
                                echo anchor(site_url('data_latih/import'), 'Import Data Latih', 'class="btn btn-primary mr-2"');
                            } else {
                                // echo anchor(site_url('data_uji/empty_data_prob'), 'Reset Data Latih', 'class="btn btn-danger"', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="loader d-none" id="loader">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <!-- <span class="visually-hidden">Loading...</span> -->
                    </div>
                    <h5>Wait a minutes..........</h5>
                </div>
            </div>
        </div>
    </section>
</div>

<?php if (!empty($resultFilter)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $dataAccuracy ?><sup style="font-size: 20px">%</sup></h3>
                            <p>Akurasi Data Yang Di Uji</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-left px-2">
                            Total data yang di uji <strong><?= $totalDataUji ?></strong>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $totalDataUji ?><sup style="font-size: 20px">/<?= $totalAllData ?></sup></h3>
                            <p>Jumlah Data Yang Di Uji</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-left px-2">
                            Diambil <strong><?= $filterData * 100 ?>%</strong> dari data latih
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $correct ?><sup style="font-size: 20px">/<?= $totalDataUji ?></sup></h3>
                            <p>Jumlah Pengujian Benar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-left px-2">
                            Persentase dari data uji <strong><?= $dataAccuracy ?>%</strong>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $inCorrect ?><sup style="font-size: 20px">/<?= $totalDataUji ?></sup></h3>
                            <p>Jumlah Pengujian Salah</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-left px-2">
                            Persentase dari data uji <strong><?= 100 - $dataAccuracy ?>%</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-dark collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Lihat Detail</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table clasification table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Nim</th>
                            <th>Usia</th>
                            <th>Alamat</th>
                            <th>Ips 1</th>
                            <th>Ips 2</th>
                            <th>Ips 3</th>
                            <th>Ips 4</th>
                            <th>Status</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr><?php
                                foreach ($resultFilter as $key => $data_uji) {
                                ?>
                            <tr class="<?php echo ($dataResult[$key] == $data_uji->status) ? '' : 'bg-danger'  ?>">
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $data_uji->nama ?></td>
                                <td><?php echo $data_uji->jenis_kelamin ?></td>
                                <td><?php echo $data_uji->nim ?></td>
                                <td><?php echo $data_uji->usia ?></td>
                                <td><?php echo $data_uji->alamat ?></td>
                                <td><?php echo $data_uji->ips_1 ?></td>
                                <td><?php echo $data_uji->ips_2 ?></td>
                                <td><?php echo $data_uji->ips_3 ?></td>
                                <td><?php echo $data_uji->ips_4 ?></td>
                                <td><?php echo $data_uji->status ?></td>
                                <td><?php echo $dataResult[$key] ?></td>
                                <td>
                                    <?php
                                    // echo anchor(site_url('data_uji/read/' . $data_uji->id), 'Read');
                                    // echo ' | ';
                                    // echo anchor(site_url('data_uji/update/' . $data_uji->id), 'Update');
                                    // echo ' | ';
                                    // echo anchor(site_url('data_uji/delete/' . $data_uji->id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                    // 
                                    ?>

                                    <a href="<?= base_url('data_uji/delete/' . $data_uji->id) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">
                                        <span class="iconify" data-icon="material-symbols:delete-outline"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php
                                }
                        ?>
                    </table>
                </div>
            </div>
            <div class="py-2"></div>
            <hr>
            <div class="py-2"></div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid">
            <h5 class="mt-4 mb-3 text-center">Propabilitas <code>Status</code> dari Data Uji</h5>
            <div class="row justify-content-center reverse">
                <?php foreach ($probStatus as $key => $value) : ?>
                    <div class="col-md-3">
                        <?php if (strtoupper($value['status']) == 'TEPAT') : ?>
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><strong><?php echo $value['status'] ?></strong></span>
                                    <h3 class="h3 font-weight-bold"><?php echo $value['result'] ?></h3>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $value['result'] * 100 ?>%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <?php echo $value['count'] ?> dari <?= $totalAllData ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        <?php else : ?>
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="far fa-thumbs-down"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><strong><?php echo $value['status'] ?></strong></span>
                                    <h3 class="h3 font-weight-bold"><?php echo $value['result'] ?></h3>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $value['result'] * 100 ?>%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <?php echo $value['count'] ?> dari <?= $totalAllData ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        <?php endif ?>

                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
<?php endif ?>


<?php if (!empty($probJenkel)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>Jenis Kelamin</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <th>Tepat</th>
                                    <th>Peluang Lulus</th>
                                </tr>
                                <?php foreach ($probJenkel as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <td><?= $value['countOnTime'] ?></td>
                                        <td><?= $value['resultOnTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <th>Terlambat</th>
                                    <th>Peluang Terlambat</th>
                                </tr>
                                <?php foreach ($probJenkel as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <td><?= $value['countLate'] ?></td>
                                        <td><?= $value['resultLate'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probAlamat)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>Alamat</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <th>Tepat</th>
                                    <th>Peluang Lulus</th>
                                </tr>
                                <?php foreach ($probAlamat as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <td><?= $value['countOnTime'] ?></td>
                                        <td><?= $value['resultOnTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <th>Terlambat</th>
                                    <th>Peluang Terlambat</th>
                                </tr>
                                <?php foreach ($probAlamat as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <td><?= $value['countLate'] ?></td>
                                        <td><?= $value['resultLate'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>Usia</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probUsia as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probUsia[$key]['onTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probUsia as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probUsia[$key]['late'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>IPS 1</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps1 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps1[$key]['onTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps1 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps1[$key]['late'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>IPS 2</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps2 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps2[$key]['onTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps2 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps2[$key]['late'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>IPS 3</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps3 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps3[$key]['onTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps3 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps3[$key]['late'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($probStatus)) : ?>
    <section class="content">
        <div class="container-fluid px-auto px-md-5">
            <h5 class="mt-4 mb-2">Propabilitas <code>IPS 4</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps4 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps4[$key]['onTime'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TERLAMBAT</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <?php foreach ($probIps4 as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th class="text-left"><?= str_replace('_', ' ', ucwords($key)) ?></th>
                                        <td><?= $probIps4[$key]['late'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>







<!-- <div class="py-3"></div> -->




<style>
    /* .loader {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 10;
    }

    .loader .loader-inner {
        display: grid;
        place-content: center;
        height: 100%;
        width: 100%;
        background-color: #212529;
        color: #fff;
    }

    .loader .loader-inner .v-load-content .logo-text h5 {
        color: #fff;
        font-size: 60px;
    } */

    .row.reverse {
        flex-direction: row-reverse;
    }

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

    .content.propabilitas table td {
        text-align: end;
    }

    .content table td {
        vertical-align: middle !important;

    }

    .content table.clasification tr.bg-success {
        background-color: rgba(40, 167, 69, 0.3) !important;
        color: #212529 !important;
    }

    .content table.clasification tr.bg-danger {
        background-color: rgba(220, 53, 69, 0.3) !important;
        color: #212529 !important;
    }
</style>

<script>
    const hideLoader = () => {
        document.getElementById("loader").classList.remove('d-none');
    }



    function loading() {
        if (document.all) {
            // document.all["loader"].style.visibility = "hidden";
            document.getElementById("loader").classList.remove('d-none');
            // document.all["main"].style.visibility = "visible";
            console.log('load');
        } else if (document.getElementById) {
            document.getElementById("loader").classList.add('d-none');
            // node = document.getElementById("loader").style.visibility = 'hidden';
            // node = document.getElementById("main").style.visibility = 'visible';
            console.log('finish');
        }
    }

    document.body.onload = () => loading();
</script>