<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
						<div class="login-brand">
							<h2>Register</h2>
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<h4>Silahkan melakukan register dan masukkan data diri anda !</h4>
							</div>

							<div class="card-body">
								<form method="POST" action="<?php echo base_url('register') ?>">
									<div class="row">
										<div class="form-group col-6">
											<label for="nama">Nama</label>
											<input id="nama" type="text" class="form-control" name="nama" autofocus value="<?= $this->input->post('nama') ?>">
											<?php echo form_error('nama', '<div class="text-small text-danger">', '</div>') ?>
										</div>
										<div class="form-group col-6">
											<label for="username">Username</label>
											<input id="username" type="text" class="form-control" name="username" value="<?= $this->input->post('username') ?>">
											<?php echo form_error('username', '<div class="text-small text-danger">', '</div>') ?>
										</div>
									</div>

									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" required value="<?= $this->input->post('email') ?>">
										<?php echo form_error('email', '<div class="text-small text-danger">', '</div>') ?>
										<div class="invalid-feedback">
										</div>
									</div>
									<div class="form-group">
										<label for="alamat">Alamat</label>
										<input id="alamat" type="text" class="form-control" name="alamat" value="<?= $this->input->post('alamat') ?>">
										<?php echo form_error('alamat', '<div class="text-small text-danger">', '</div>') ?>
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label for="jenis_kelamin" class="d-block">Jenis Kelamin</label>
											<select class="form-control" name="jenis_kelamin">
												<option value="">--Pilih Jenis Kelamin--</option>
												<option>Laki-laki</option>
												<option>Perempuan</option>
											</select>
											<?php echo form_error('jenis_kelamin', '<div class="text-small text-danger">', '</div>') ?>
										</div>
										<div class="form-group col-6">
											<label for="no_telepon" class="d-block">No. Telepon</label>
											<input id="no_telepon" type="number" class="form-control" name="no_telepon" min="1" value="<?= $this->input->post('no_telepon') ?>">
											<?php echo form_error('no_telepon', '<div class="text-small text-danger">', '</div>') ?>
										</div>
									</div>


									<div class="row">
										<div class="form-group col-6">
											<label>No. Identitas</label>
											<input type="number" name="no_identitas" class="form-control" value="<?= $this->input->post('no_identitas') ?>">
											<?php echo form_error('no_identitas', '<div class="text-small text-danger">', '</div>') ?>
										</div>
										<div class="form-group col-6">
											<label>Password</label>
											<input type="password" name="password" class="form-control" value="<?= $this->input->post('password') ?>">
											<?php echo form_error('password', '<div class="text-small text-danger">', '</div>') ?>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block">
											Register
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="simple-footer">
							Copyright &copy; Stisla 2018
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
