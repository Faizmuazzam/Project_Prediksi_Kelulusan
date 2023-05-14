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

<?php
$dataAccuracy = 0;
$correct = 0;
$inCorrect = 0;

foreach ($data_uji_data as $key => $data_uji) {
    if ($data_uji->result == $data_uji->status) {
        $correct = $correct + 1;
    } else {
        $inCorrect = $inCorrect + 1;
    }
}



if (!empty($correct)) {
    $dataAccuracy = ($correct / $totalAllData) * 100;
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Accuracy : <strong><?php echo $dataAccuracy ?>%</strong></h3>
            </div>
        </div>
    </div>
</section>
<div class="py-2"></div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo anchor(site_url('data_uji/import'), 'Import', 'class="btn btn-primary me-3"'); ?>
                        <?php echo anchor(site_url('data_uji/excel'), 'Excel', 'class="btn btn-success"'); ?>
                        <?php //echo anchor(site_url('data_uji/create'), 'Create', 'class="btn btn-primary"'); 
                        ?>
                        <?php echo anchor(site_url('data_uji/empty_data'), 'Empty', 'class="btn btn-danger"', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
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

                <?php
                // $CI = &get_instance();
                // $CI->load->library('Naves_bayes');
                // // $CI->library_name->yourFunction();
                // $correct = 0;
                // $inCorrect = 0;
                ?>
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
                            foreach ($data_uji_data as $key => $data_uji) {
                                // $jenis_kelamin = $data_uji->jenis_kelamin;
                                // $usia = $data_uji->usia;
                                // $alamat = $data_uji->alamat;
                                // $ips_1 = $data_uji->ips_1;
                                // $ips_2 = $data_uji->ips_2;
                                // $ips_3 = $data_uji->ips_3;
                                // $ips_4 = $data_uji->ips_4;

                                // $clasification = $CI->naves_bayes->clasification($jenis_kelamin, $usia, $alamat, $ips_1, $ips_2, $ips_3, $ips_4);

                                if ($data_uji->result == $data_uji->status) {
                                    $correct = $correct + 1;
                                } else {
                                    $inCorrect = $inCorrect + 1;
                                }
                            ?>
                        <tr class="<?php echo ($data_uji->result == $data_uji->status) ? 'bg-success' : 'bg-danger'  ?>">
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
                            <td><?php echo $data_uji->result ?></td>
                            <td><?php //echo $clasification 
                                ?></td>
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
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn">Total Record : <?php echo $total_rows ?></a>
                    </div>
                    <!-- <div class="col-md-6 text-right">
                        <div class="vPaginations">
                            <?php //echo $pagination 
                            ?>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<div class="py-2"></div>



<!-- <div class="py-3"></div> -->




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

    .content table.clasification tr.bg-success {
        background-color: rgba(40, 167, 69, 0.3) !important;
        color: #212529 !important;
    }

    .content table.clasification tr.bg-danger {
        background-color: rgba(220, 53, 69, 0.3) !important;
        color: #212529 !important;
    }
</style>