<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tb_data_uji <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nim <?php echo form_error('nim') ?></label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Usia <?php echo form_error('usia') ?></label>
            <input type="text" class="form-control" name="usia" id="usia" placeholder="Usia" value="<?php echo $usia; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Ips 1 <?php echo form_error('ips_1') ?></label>
            <input type="text" class="form-control" name="ips_1" id="ips_1" placeholder="Ips 1" value="<?php echo $ips_1; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Ips 2 <?php echo form_error('ips_2') ?></label>
            <input type="text" class="form-control" name="ips_2" id="ips_2" placeholder="Ips 2" value="<?php echo $ips_2; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Ips 3 <?php echo form_error('ips_3') ?></label>
            <input type="text" class="form-control" name="ips_3" id="ips_3" placeholder="Ips 3" value="<?php echo $ips_3; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Ips 4 <?php echo form_error('ips_4') ?></label>
            <input type="text" class="form-control" name="ips_4" id="ips_4" placeholder="Ips 4" value="<?php echo $ips_4; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_uji') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>