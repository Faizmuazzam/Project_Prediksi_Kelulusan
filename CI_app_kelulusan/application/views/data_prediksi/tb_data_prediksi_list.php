<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Prediksi Kelulusan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Prediksi</li>
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
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url('data_prediksi/import'), 'Import', 'class="btn btn-primary me-3"'); ?>
                        <?php echo anchor(site_url('data_prediksi/excel'), 'Excel', 'class="btn btn-success"'); ?>
                        <?php //echo anchor(site_url('data_prediksi/create'), 'Create', 'class="btn btn-primary"'); ?>
                        <?php echo anchor(site_url('data_prediksi/empty_data'), 'Empty', 'class="btn btn-danger"', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <form action="<?php echo site_url('data_prediksi/index'); ?>" class="w-100" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($q <> '') {
                                    ?>
                                        <a href="<?php echo site_url('data_prediksi'); ?>" class="btn btn-default">Reset</a>
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
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Nim</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Ips 1</th>
                        <th>Ips 2</th>
                        <th>Ips 3</th>
                        <th>Ips 4</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr><?php
                            foreach ($data_prediksi_data as $data_prediksi) {
                            ?>
                        <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $data_prediksi->nama ?></td>
                            <td><?php echo $data_prediksi->jenis_kelamin ?></td>
                            <td><?php echo $data_prediksi->nim ?></td>
                            <td><?php echo $data_prediksi->usia ?></td>
                            <td><?php echo $data_prediksi->alamat ?></td>
                            <td><?php echo $data_prediksi->ips_1 ?></td>
                            <td><?php echo $data_prediksi->ips_2 ?></td>
                            <td><?php echo $data_prediksi->ips_3 ?></td>
                            <td><?php echo $data_prediksi->ips_4 ?></td>
                            <td><?php echo $data_prediksi->result ?></td>
                            <td style="text-align:center">
                                <?php
                                // echo anchor(site_url('data_prediksi/read/' . $data_prediksi->id), 'Read');
                                // echo ' | ';
                                // echo anchor(site_url('data_prediksi/update/' . $data_prediksi->id), 'Update');
                                // echo ' | ';
                                // echo anchor(site_url('data_prediksi/delete/' . $data_prediksi->id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                ?>

                                <a href="<?= base_url('data_prediksi/delete/' . $data_prediksi->id) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">
                                    <span class="iconify" data-icon="material-symbols:delete-outline"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                    ?>
                </table>

                <!-- <table class="table table-bordered" style="margin-bottom: 10px">
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
                        <th>Action</th>
                    </tr><?php
                            foreach ($data_latih_data as $data_latih) {
                            ?>
                        <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $data_latih->nama ?></td>
                            <td><?php echo $data_latih->jenis_kelamin ?></td>
                            <td><?php echo $data_latih->nim ?></td>
                            <td><?php echo $data_latih->usia ?></td>
                            <td><?php echo $data_latih->alamat ?></td>
                            <td><?php echo $data_latih->ips_1 ?></td>
                            <td><?php echo $data_latih->ips_2 ?></td>
                            <td><?php echo $data_latih->ips_3 ?></td>
                            <td><?php echo $data_latih->ips_4 ?></td>
                            <td><?php echo $data_latih->status ?></td>
                            <td style="text-align:center" width="70px">

                                <a href="<?= base_url('data_latih/read/' . $data_latih->id) ?>" class="btn btn-primary">
                                    <span class="iconify" data-icon="material-symbols:search"></span>
                                </a>

                                <a href="<?= base_url('data_latih/update/' . $data_latih->id) ?>" class="btn btn-warning">
                                    <span class="iconify" data-icon="material-symbols:edit"></span>
                                </a>

                                <a href="<?= base_url('data_latih/delete/' . $data_latih->id) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">
                                    <span class="iconify" data-icon="material-symbols:delete-outline"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                    ?>
                </table> -->
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

    .content.propabilitas table td {
        text-align: end;
    }
</style>