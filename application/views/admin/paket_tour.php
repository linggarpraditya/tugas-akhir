<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>Paket Tour</h1>
          </div>
          <a href="<?php echo base_url('admin/paket_tour/tambah_paket') ?>" class="btn btn-primary mb-3 "  ><i class="fas fa-user-plus"></i>Tambah Data</a>
          <?php echo $this->session->flashdata('pesan') ?>

          <table class="table table-hover table-striped table-borderd">
          	<thead>
          		<tr>
          			<th>No.</th>
          			<th>Gambar</th>
          			<th>Nama Destinasi</th>
          			<th>Aksi</th>
          		</tr>
          	</thead>

          	<tbody>
          		<?php $no=1;
          		foreach($paket_tour as $pt) : ?>
          			<tr>
          				<td><?php echo $no++; ?></td>
          				<td><img width="60px" src="<?php echo base_url().'assets/upload/'.$pt->gambar ?>"> </td>
          				<td><?php echo $pt->nama_destinasi; ?></td>
          				<td>
                                  
          					<a href="<?php echo base_url('admin/paket_tour/update_paket/'). $pt->id_paket ?>" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>

               				<a onclick="return confirm('yakin data akan dihapus ?')" href="<?php echo base_url('admin/paket_tour/delete_paket/'). $pt->id_paket ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
          				</td>
          			</tr>
          		<?php endforeach; ?>
          	</tbody>

          </table>
      </section>
</div>