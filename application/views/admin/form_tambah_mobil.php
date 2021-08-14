<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Tambah Mobil</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?php echo base_url('admin/data_mobil/tambah_mobil_aksi') ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Type Mobil</label>
								<select name="kode_type" class="form-control">
									<option value="">--Pilih Type--</option>
									<?php foreach ($type as $tp) : ?>
										<option value="<?php echo $tp->kode_type ?>">
											<?php echo $tp->nama_type ?></option>
									<?php endforeach; ?>
								</select>
								<?php echo form_error('kode_type', '<div class="text-small 
       text-danger">', '</div>') ?>
							</div>



							<div class="form-group">
								<label>Pilih Pemilik</label>
								<select name="filter" id="filter" class="form-control">
									<option value="">Pilih</option>
									<option value="1">Perusahaan</option>
									<option value="3">Mitra</option>
								</select>



							</div>

							<div class="form-group">

								<div id="form-tahun">
									<label>Pilih Mitra</label><br>
									<select name="mitra" class="form-control">
										<option value="">Pilih Mitra</option>
										<?php
										foreach ($option_mitra as $data) { // Ambil data tahun dari model yang dikirim dari controller
											echo '<option value="' . $data->id_mitra . '">' . $data->nama_mitra . '</option>';
										}
										?>
									</select>

								</div>




							</div>

							<div class="form-group">
								<div id="form-status">
									<label>Status Mitra</label>
									<input id="nilai" type="text" name="status_mitra" class="form-control" value="">
									<?php echo form_error('setat', '<div class="text-small 
              text-danger">', '</div>') ?>
								</div>
							</div>

							<!--  <div class="form-group">
            <div id="form-status2">
              <label>Perusahaan</label>
              <input type="text" name="status_perusahaan" class="form-control" value="perusahaan">
              <?php echo form_error('setat_perusahaan', '<div class="text-small 
              text-danger">', '</div>') ?>
            </div>
          </div>
        -->


							<div class="form-group">
								<label>Merk</label>
								<input type="text" name="merk" class="form-control">
								<?php echo form_error('merk', '<div class="text-small 
         text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>No.Plat</label>
								<input type="text" name="no_plat" class="form-control">
								<?php echo form_error('no_plat', '<div class="text-small 
         text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Warna</label>
								<input type="text" name="warna" class="form-control">
								<?php echo form_error('warna', '<div class="text-small 
         text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>AC</label>
								<select name="ac" class="form-control">
									<option value="1">Tersedia</option>
									<option value="0">Tidak Tersedia</option>
								</select>
								<?php echo form_error('ac', '<div class="text-small 
        text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Supir</label>
								<select name="supir" class="form-control">
									<option value="1">Tersedia</option>
									<option value="0">Tidak Tersedia</option>
								</select>
								<?php echo form_error('supir', '<div class="text-small 
      text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>MP3 Player</label>
								<select name="mp3_player" class="form-control">
									<option value="1">Tersedia</option>
									<option value="0">Tidak Tersedia</option>
								</select>
								<?php echo form_error('mp3_player', '<div class="text-small 
    text-danger">', '</div>') ?>
							</div>


						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Harga Sewa</label>
								<input type="number" name="harga" class="form-control">
								<?php echo form_error('harga', '<div class="text-small 
  text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Denda</label>
								<input type="number" name="denda" class="form-control">
								<?php echo form_error('denda', '<div class="text-small 
  text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Tahun</label>
								<input type="number" name="tahun" class="form-control">
								<?php echo form_error('tahun', '<div class="text-small 
  text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="">--Pilih Status--</option>
									<option value="Tersedia">Tersedia</option>
									<option value="Tidak Tersedia">Tidak Tersedia</option>
								</select>
								<?php echo form_error('status', '<div class="text-small 
 text-danger">', '</div>') ?>
							</div>

							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar" class="form-control">
							</div>

							<button class="btn btn-primary">Simpan</button>
							<button class="btn btn-danger ml-2">reset</button>

						</div>

					</div>
				</form>
			</div>
		</div>

	</section>
</div>



<script>
	$(document).ready(function() { // Ketika halaman selesai di load
		$('.input-tanggal').datepicker({
			dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
		});

		$('#form-tanggal,#form-status, #form-status2,#form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

		$('#filter').change(function() { // Ketika user memilih filter
			if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
				$('#form-bulan, #form-tahun,#form-status').hide(); // Sembunyikan form bulan dan tahun
				$('#form-status').show(); // Tampilkan form tanggal
				$('#nilai').val('perusahaan'); // Clear data pada textbox tanggal, combobox bulan & tahun
			} else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
				$('#form-tanggal').hide(); // Sembunyikan form tanggal
				$('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
			} else if ($(this).val() == '3') { // Jika filternya 3 (per tahun)
				$('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
				$('#form-tahun,#form-status').show(); // Tampilkan form tahun
				$('#nilai').val('mitra'); // Clear data pada textbox tanggal, combobox bulan & tahun
			} else { // Jika filternya 3 (per tahun)
				$('#form-tanggal, #form-bulan,#form-tahun,#form-status,#form-status2').hide(); // Sembunyikan form tanggal dan bulan

			}

			$('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
		})
	})
</script>
