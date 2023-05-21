<?php if (!empty($probJenkel)) : ?>
    <section class="content">
        <div class="container-fluid">
            <h5 class="mt-4 mb-2">Propabilitas <code>Jenis Kelamin</code> dari Data Uji</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Data <strong>TEPAT</strong></h3>

                            <div class="card-tools">
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button> -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> -->
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <th>Tepat</th>
                                    <!-- <th>Terlambat</th> -->
                                    <!-- <th>Total</th> -->
                                    <th>Peluang Lulus</th>
                                    <!-- <th>Peluang Terlambat</th> -->
                                </tr>
                                <?php foreach ($probJenkel as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <td><?= $value['countOnTime'] ?></td>
                                        <!-- <td><?= $value['countLate'] ?></td> -->
                                        <!-- <td><?= $value['countAll'] ?></td> -->
                                        <td><?= $value['resultOnTime'] ?></td>
                                        <!-- <td><?= $value['resultLate'] ?></td> -->
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
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button> -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> -->
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th></th>
                                    <!-- <th>Tepat</th> -->
                                    <th>Terlambat</th>
                                    <!-- <th>Total</th> -->
                                    <!-- <th>Peluang Lulus</th> -->
                                    <th>Peluang Terlambat</th>
                                </tr>
                                <?php foreach ($probJenkel as $key => $value) : ?>
                                    <tr class="text-right">
                                        <th><?= $value['name'] ?></th>
                                        <!-- <td><?= $value['countOnTime'] ?></td> -->
                                        <td><?= $value['countLate'] ?></td>
                                        <!-- <td><?= $value['countAll'] ?></td> -->
                                        <!-- <td><?= $value['resultOnTime'] ?></td> -->
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