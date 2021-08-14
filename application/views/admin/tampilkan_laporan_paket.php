<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan Transaksi</h1>
    </div>
  </section>

  <form method="POST" action="<?php echo base_url('admin/laporan') ?>">
   <div class="form-group">
    <label>Dari Tanggal</label>
    <input type="date" name="dari" class="form-control">
    <?php echo form_error('dari','<span class="text-small text-danger">','</span>') ?>
  </div>

  <div class="form-group">
    <label>Sampai Tanggal</label>
    <input type="date" name="sampai" class="form-control">
    <?php echo form_error('sampai','<span class="text-small text-danger">','</span>') ?>
  </div>

  <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>Tampilkan Data</button>
</form><hr>

<div class="btn-group">
  <a class="btn btn-success" target="_blank" href="<?php echo base_url().'admin/laporan/print_laporan_paket/?dari='.set_value('dari').'&sampai=.set_value(sampai)' ?>"><i class="fa fa-print"> Cetak Laporan</i></a>
</div>

<table class="table-responsive table table-bordered table-striped mt-4">
  <tr>
    <th>NO.</th>
    <th>Customer</th>
    <th>Nama Paket</th>
    <th>Harga</th>
    <th>Tanggal Booking</th>


  </tr>

  <?php $no=1;
  foreach ($laporan as $tr) : ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $tr->nama ?></td>
      <td><?php echo $tr->package_name ?></td>
      <td>Rp.<?php echo number_format($tr->harga_paket,0,',','.') ?></td>
     

    </tr>
  <?php endforeach; ?>
</table>

</div>