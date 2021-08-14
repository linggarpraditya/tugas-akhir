<div class="container">
	<div class="card" style="margin-top: 150px; margin-bottom: 50px">
		<?php echo $this->session->flashdata('pesan') ?>
		<div class="card-header">
			Form booking Paket Tour
		</div>
		<div class="card-body">
			<?php foreach ($detail as $dt) : ?>
				<form method="POST" action="<?php echo base_url('customer/paket_tour/tambah_paket_aksi') ?>">

					<div class="form-group">
						<label>Nama Paket</label>
						<input type="hidden" name="package_id" value="<?php echo $dt->package_id ?>">
						<input type="text" name="package_name" class="form-control" value="<?php echo $dt->package_name  ?>"readonly>
					</div>
					<div class="form-group">
						<label>Harga Paket/Orang</label>
						<input type="text" name="harga_paket" class="form-control" value="<?php echo $dt->harga_paket  ?>"readonly>
					</div>
					<div class="form-group">
						<label>Jumlah Tiket</label>
						<input type="number" name="jumlah_orang" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="date" name="tgl_rental" class="form-control">
					</div>
					
					<button type="submit" class="btn btn-success"> Sewa </button>
					
				</form>
			<?php endforeach; ?>
		</div>
	</div>


</div>