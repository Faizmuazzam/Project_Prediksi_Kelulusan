<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Input data users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Input</li>
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
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">User Controls</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Username <?php echo form_error('username') ?></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Ganti Password</label>
                                <input type="password" class="form-control" name="ganti_passowrd" id="ganti_passowrd" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Email <?php echo form_error('email') ?></label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
                                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="varchar">Image <?php echo form_error('image') ?></label>
                                <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="int">Status <?php echo form_error('status') ?></label>
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                            <a href="<?php echo base_url('/') ?>" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>