  <!-- Content Header (Page header) -->
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
  <!-- Main content -->

  <section class="content">
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-12">
  				<div class="card card-primary">
  					<div class="card-header">
  						<h3 class="card-title">Quick Example</h3>
  					</div>
  					<!-- /.card-header -->
  					<!-- form start -->
  					<form action="<?php echo $action; ?>" method="post">
  						<div class="card-body">
  							<div class="row">
  								<div class="col-lg-4"></div>
  								<div class="col-lg-8">
  									<div class="form-group">
  										<label for="varchar">Username <?php echo form_error('username') ?></label>
  										<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
  									</div>
  									<div class="form-group">
  										<label for="varchar">Ganti Password <?php echo form_error('ganti_password') ?></label>
  										<input type="password" class="form-control" name="ganti_password" id="ganti_password" placeholder="Password" />
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
  								</div>
  							</div>
  						</div>
  						<input type="hidden" name="id" value="<?php echo $id; ?>" />
  						<div class="card-footer d-flex justify-content-end">
  							<button type="submit" class="btn btn-primary mr-2"><?php echo $button ?></button>
  							<a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
  	</div>

  	<div class="alert alert-danger alert-dismissible">
  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<h5><i class="icon fas fa-ban"></i> Alert!</h5>
  		Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my
  		entire
  		soul, like these sweet mornings of spring which I enjoy with my whole heart.
  	</div>
  </section>