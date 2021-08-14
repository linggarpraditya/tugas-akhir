<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Jadwal setir</h1>
		</div>

		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="col-md"></div>
				<form action="" class="col-md-3">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="q" id="q" class="form-control" placeholder="..." value="<?= $q ?>">
							<div class="input-group-append">
								<button class="btn btn-success"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="card-body">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>customer</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($jadwal as $key => $value) { ?>
							<tr>
								<td><?= $key + 1 ?></td>
								<td><?= $value->tgl_rental ?></td>
								<td><?= $value->nama ?></td>
								<td>
									<a href="<?= base_url("sopir/jadwal_setir/setir/$value->id_rental") ?>" class="btn btn-primary"><i class="fas fa-map"></i></a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>



	</section>
</div>
