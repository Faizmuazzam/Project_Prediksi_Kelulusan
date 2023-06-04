<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Import Data Uji</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Uji</a></li>
                    <li class="breadcrumb-item active">Import</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4>About Me ?</h4>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo praesentium perspiciatis, sapiente earum <code>voluptas voluptates</code> repudiandae sequi ea aliquid est, ipsa illo! Quia aspernatur atque velit accusantium minus cumque blanditiis hic dolores excepturi, quasi eaque officiis magnam officia vero quis quos suscipit consequatur architecto qui repellendus voluptates nulla. Error, necessitatibus.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Import Excel</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="<?= base_url('data_latih/import_action') ?>" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="file_excel">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_excel" name="file_excel" required>
                                        <label class="custom-file-label" for="file_excel" id="label_excel">Choose file</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Import</button>
                            <a href="<?= base_url('guide/format data pada tabel.pdf') ?>" target="_blank" class="btn btn-success">
                                Format Excell
                            </a>
                            <a href="<?= base_url('data_latih') ?>" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const fileExcel = document.getElementById('file_excel');
    const labelExcel = document.getElementById('label_excel');

    fileExcel.onchange = () => {
        labelExcel.innerHTML = fileExcel.files[0].name;
    }
</script>