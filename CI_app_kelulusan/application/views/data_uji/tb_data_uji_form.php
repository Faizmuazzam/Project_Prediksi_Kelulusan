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
            <label for="varchar">Nim <?php echo form_error('nim') ?></label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ipk1 <?php echo form_error('ipk1') ?></label>
            <input type="text" class="form-control" name="ipk1" id="ipk1" placeholder="Ipk1" value="<?php echo $ipk1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ipk2 <?php echo form_error('ipk2') ?></label>
            <input type="text" class="form-control" name="ipk2" id="ipk2" placeholder="Ipk2" value="<?php echo $ipk2; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ipk3 <?php echo form_error('ipk3') ?></label>
            <input type="text" class="form-control" name="ipk3" id="ipk3" placeholder="Ipk3" value="<?php echo $ipk3; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ipk4 <?php echo form_error('ipk4') ?></label>
            <input type="text" class="form-control" name="ipk4" id="ipk4" placeholder="Ipk4" value="<?php echo $ipk4; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ipk Akhir <?php echo form_error('ipk_akhir') ?></label>
            <input type="text" class="form-control" name="ipk_akhir" id="ipk_akhir" placeholder="Ipk Akhir" value="<?php echo $ipk_akhir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_uji') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>