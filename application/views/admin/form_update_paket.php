<div class="main-content">
  <div class="section">
    <div class="section-header">
      <h1>Form Edit Paket</h1>
    </div>
  </div>

  <?php foreach ($paket_tour as $pt) : ?>
  <form method="POST" action="<?php echo base_url('admin/paket_tour/update_paket_aksi') ?>" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Destinasi</label>
      <input type="hidden" name="id_paket" value="<?php echo $pt->id_paket ?>">
      <input type="text" name="nama_destinasi" class="form-control" value="<?php echo $pt->nama_destinasi ?>">
      <?php echo form_error('nama_destinasi','<div class="text-small text-danger">','</div>') ?>
    </div>

    <div class="form-group">
      <label>Gambar</label>
      <input type="file" name="gambar" class="form-control">
      <?php echo form_error('gambar','<div class="text-small text-danger">','</div>') ?>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
     <button type="reset" class="btn btn-danger">Reset</button>
  </form>
  <?php endforeach; ?>

</div>