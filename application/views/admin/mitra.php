<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Mitra</h1>
    </div>

    <a href="<?php echo base_url('admin/mitra/tambah_mitra') ?>" class="btn btn-primary mb-3 " ><i class="fas fa-user-plus"></i>Tambah Data</a>

    <?php echo $this->session->flashdata('pesan') ?>
    <table class="table table-hover table-striped table-borderd">
     <thead>
      <tr>
        <th>No</th>
        <th>Nama Mitra</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
     
      <?php 
      $no=1;
      foreach ($mitra as $mi) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $mi->nama_mitra; ?></td>
          <td><?php echo $mi->alamat; ?></td>
          
          <td>

           <a href="<?php echo base_url('admin/mitra/update_mitra/'). $mi->id_mitra ?>" class="btn btn-sm btn-primary">
            <i class="   fas fa-edit"></i></a>

            <a onclick="return confirm('apakah anda yakin untuk menghapus ?')" href="<?php echo base_url('admin/mitra/delete_mitra/'). $mi->id_mitra ?>" class="btn btn-sm btn-danger">
              <i class="fas fa-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
        
      </tbody>

    </table>
  </section>

</div>