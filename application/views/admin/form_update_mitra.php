<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h1>Form Edit Mitra</h1>
		</div>
	</div>

<?php foreach($mitra as $cs ) : ?>
	<form method="POST" action="<?php echo base_url('admin/mitra/tambah_mitra_aksi') ?>">
		<div class="form-group">
			<label>Nama Mitra</label>
			<input type="hidden" name="id_mitra" value="<?php echo $cs->id_mitra ?>">
          <input type="text" name="nama_mitra" class="form-control" value="<?php echo $cs->nama_mitra ?>">
			<?php echo form_error('nama_mitra','<div class="text-small text-danger">','</div>') ?>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<input type="text" name="alamat" class="form-control" value="<?php echo $cs->alamat ?>">
			<?php echo form_error('alamat','<div class="text-small text-danger">','</div>') ?>
		</div>

		<button type="submit" class="btn btn-primary">Simpan</button>
		 <button type="reset" class="btn btn-danger">Reset</button>
	</form>
<?php endforeach; ?>
</div>