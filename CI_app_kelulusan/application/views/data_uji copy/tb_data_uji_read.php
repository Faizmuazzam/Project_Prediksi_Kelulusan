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
        <h2 style="margin-top:0px">Tb_data_uji Read</h2>
        <table class="table">
	    <tr><td>Nim</td><td><?php echo $nim; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Ipk1</td><td><?php echo $ipk1; ?></td></tr>
	    <tr><td>Ipk2</td><td><?php echo $ipk2; ?></td></tr>
	    <tr><td>Ipk3</td><td><?php echo $ipk3; ?></td></tr>
	    <tr><td>Ipk4</td><td><?php echo $ipk4; ?></td></tr>
	    <tr><td>Ipk Akhir</td><td><?php echo $ipk_akhir; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('data_uji') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>