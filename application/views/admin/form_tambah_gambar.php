<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h1>Form Tambah Gambar</h1>
		</div>
	</div>

	<form method="POST" action="<?php echo base_url('admin/data_gambar/tambah_gambar_aksi') ?>" enctype="multipart/form-data">
		<div class="form-group">
			<label>Mobil</label>
			<select name="id_mobil" class="form-control">
				<option value="">--Pilih mobil--</option>
				<?php foreach ($mobil as $tp) : ?>
					<option value="<?php echo $tp->id_mobil ?>">
						<?php echo $tp->merk ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('kode_type','<div class="text-small 
				text-danger">','</div>') ?>
			</div>

			<div class="form-group">
				<label>Gambar</label>
				<input type="file" name="gambar" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</form>

	</div>