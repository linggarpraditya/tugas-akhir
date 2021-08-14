<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Gambar</h1>
		</div>
		<a href="<?php echo base_url('admin/data_gambar/tambah_gambar') ?>" class="btn btn-primary mb-3 "  ><i class="fas fa-user-plus"></i>Tambah Data</a>
		<?php echo $this->session->flashdata('pesan') ?>

		<table class="table table-hover table-striped table-borderd">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Mobil</th>
					<th>Gambar</th>
					<th>Action</th>

				</tr>
			</thead>

			<tbody>
				<?php 
				$no=1;
				foreach ($mobil as $mb) : ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $mb->merk ?></td>
						<td>
							<img width="60px" src="<?php echo base_url().'assets/upload/'.$mb->gambar ?>">   
						</td>
						<td><a onclick="return confirm('apakah anda yakin untuk menghapus ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_gambar/delete_gambar/'.$mb->id_gambar) ?>"><i class="fas fa-times"></i></a></td>
					</tr>

				<?php endforeach; ?>
			</tbody>


		</section>
	</table>
</div>