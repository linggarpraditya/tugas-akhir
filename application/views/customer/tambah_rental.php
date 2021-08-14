<div class="container">
	<div class="card" style="margin-top: 150px; margin-bottom: 50px">
		<div class="card-header">
			Form Rental/Sewa Mobil
		</div>
		<div class="card-body">
			<?php foreach ($detail as $dt) : ?>
				<form method="POST" action="<?php echo base_url('customer/rental/tambah_rental_aksi') ?>">

					<div class="form-group">
						<label>Harga Sewa/Hari</label>
						<input type="hidden" name="id_mobil" value="<?php echo $dt->id_mobil ?>">
						<input type="text" name="harga" class="form-control" value="<?php echo $dt->harga  ?>" readonly>
					</div>
					<div class="form-group">
						<label>Denda/Hari</label>
						<input type="text" name="denda" class="form-control" value="<?php echo $dt->denda  ?>" readonly>
					</div>
					<div class="form-group">
						<label>Sopir</label>
						<select name="id_sopir" id="id_sopir" class="form-control">
							<option value="">Tidak pakai sopir</option>
							<?php foreach ($sopir as $key => $value) { ?>
								<option value="<?= $value->id_sopir ?>"><?= $value->nama_sopir ?></option>

							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Tanggal Sewa</label>
						<input type="date" name="tgl_rental" id="tgl_rental" class="form-control" min="<?= date("Y-m-d") ?>">
					</div>

					<div class="form-group">
						<label>Tanggal Kembali</label>
						<input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" min="<?= date("Y-m-d") ?>">
					</div>
					<button type="submit" class="btn btn-success"> Sewa </button>

				</form>
			<?php endforeach; ?>
		</div>
	</div>


</div>
<script>
	$('#tgl_rental').change(function() {
		var tgl_rental = $('#tgl_rental').val();
		$('#tgl_kembali').attr('min', tgl_rental)
		$('#tgl_kembali').val('')
	});
</script>
