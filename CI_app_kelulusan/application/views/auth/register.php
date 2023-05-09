<div class="register-box">
	<div class="py-3"></div>
	<div class="py-3"></div>
	<div class="py-3"></div>
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Register a new membership</p>

			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Username <?php echo form_error('username') ?></label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Password <?php echo form_error('password') ?></label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
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
					<!-- <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" /> -->
					<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
						<option value="">-- Pilih Jenis Kelamin --</option>
						<option value="Laki Laki">Laki Laki</option>
						<option value="Perempulan">Perempuan</option>
					</select>

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
				<div class="row">

					<!-- /.col -->
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Register</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<div class="pt-2"></div>

			<a href="login.html" class="text-center">I already have a membership</a>
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->


	<div class="py-3"></div>
	<div class="py-3"></div>
	<div class="py-3"></div>
</div>


<!-- /.register-box -->