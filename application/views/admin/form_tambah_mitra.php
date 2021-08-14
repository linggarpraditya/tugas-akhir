<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h1>Form Tambah Mitra</h1>
		</div>
	</div>

	<form method="POST" action="<?php echo base_url('admin/mitra/tambah_mitra_aksi') ?>">
		<div class="form-group">
			<label>Nama Mitra</label>
			<input type="text" name="nama_mitra" class="form-control">
			<?php echo form_error('nama_mitra','<div class="text-small text-danger">','</div>') ?>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<input type="text" name="alamat" class="form-control">
			<?php echo form_error('alamat','<div class="text-small text-danger">','</div>') ?>
		</div>

		<button type="submit" class="btn btn-primary">Simpan</button>
		 <button type="reset" class="btn btn-danger">Reset</button>
	</form>

</div>