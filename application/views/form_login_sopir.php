<body>
	<div id="app">
		<section class="section">
			<div class="container mt-3">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<img src="<?php echo base_url('assets/assets_admin/') ?>/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
						</div>

						<div class="card card-primary">
							<div class="card-header text-center">
								<h4 style="width: 100%; font-size: 30px">Login Sopir</h4>
							</div>

							<span class="m-2"><?php echo $this->session->flashdata('pesan') ?></span>

							<div class="card-body">
								<form method="POST" action="<?php echo base_url('auth/login_sopir') ?>">
									<div class="form-group">
										<label for="username">Username</label>
										<input id="username" type="text" class="form-control" name="username" tabindex="1" autofocus required>
										<?php echo form_error('username', '<div class="text-danger text-small">', '</div>') ?>
									</div>

									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
										</div>
										<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
										<?php echo form_error('password', '<div class="text-danger text-small">', '</div>') ?>
									</div>

									<div class="form-group">
										<span>
											<?php echo $captcha_image; ?></span><br>
										<a href="#" onclick="parent.window.location.reload(true)">Ganti Captcha</a>
										<br> <br>
										<input type="text" name="captcha" class="form-control" required>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Login
										</button>
										<a href="<?= base_url('auth') ?>" class="btn btn-outline-info btn-block">Kembali</a>
									</div>
								</form>
							</div>
						</div>

						<div class="mt-5 text-muted text-center">
							Anda belum memiliki akun? <a href="<?php echo base_url('register') ?>">Buat disini</a>
						</div>
						<div class="simple-footer">
							Copyright &copy; Stisla 2018
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
