<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
						<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
					</ul>

					<!-- <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div> -->

				</form>
				<ul class="navbar-nav navbar-right">
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

							<div class="d-sm-none d-lg-inline-block">Hi, <?php echo $this->session->userdata('nama_sopir') ?></div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="<?php echo base_url('auth/ganti_password') ?>" class="dropdown-item has-icon">
								<i class="fas fa-lock"></i> Ganti Password
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?php echo base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</li>
				</ul>
			</nav>
			<div class="main-sidebar" style="background: #dedede">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<img src="<?php echo base_url() ?>assets/assets_admin/assets/img/logoo.png">
						<!-- <a href="index.html"><strong style="font-size: 20px">PO SISWANTORO</strong></a> -->
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="">RM</a>
					</div>
					<ul class="sidebar-menu mt-4">
						<!-- <li><a style="color: black;" class="nav-link" href="<?php echo base_url('sopir/home') ?>"><i class="fas fa-tachometer-alt"></i><span> Home</span></a></li> -->

						<li><a style="color: black;" class="nav-link" href="<?php echo base_url('sopir/jadwal_setir') ?>"><i class="fas fa-car"></i> <span>Jadwal setir</span></a></li>

						<li><a class="nav-link text-danger" href="<?php echo base_url('auth/logout') ?>"><i class="fas fas fa-sign-out-alt"></i> <strong>Logout</strong></a></li>

					</ul>


				</aside>
			</div>
