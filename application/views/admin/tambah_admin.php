<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Tambah Data Admin</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?php echo base_url('admin/tambah_admin/tambah_admin_aksi') ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control">
								<?php echo form_error('nama','<div class="text-small 
								text-danger">','</div>') ?>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control">
								<?php echo form_error('username','<div class="text-small 
								text-danger">','</div>') ?>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
								<?php echo form_error('password','<div class="text-small 
								text-danger">','</div>') ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No Telepon</label>
								<input type="text" name="no_telepon" class="form-control">
								<?php echo form_error('no_telepon','<div class="text-small 
								text-danger">','</div>') ?>
							</div>
							<label for="jenis_kelamin" class="d-block">Jenis Kelamin</label>
							<select class="form-control" name="jenis_kelamin">
								<option value="">--Pilih Jenis Kelamin--</option>
								<option>Laki-laki</option>
								<option>Perempuan</option>
							</select>
							<?php echo form_error('jenis_kelamin','<div class="text-small text-danger">','</div>') ?>
						</div>
						
						<button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%">
							Register
						</button>
						
					</section>
				</div>