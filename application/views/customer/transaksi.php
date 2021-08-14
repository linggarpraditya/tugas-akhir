<div class="container">
	<div class="card mx-auto" style="margin-top: 180px; width: 89%; margin-bottom:10px">
		<div class="card-header bg-info">
			Data Transaksi Rental Anda
		</div>
		<span class="mt-2 p-2"><?php echo $this->session->flashdata('pesan') ?></span>
		<div class="card-body">
			<table class="table rable-bordered table-striped">
				<tr>
					<th>No.</th>
					<th>Nama Customer</th>
					<th>Merk Mobil</th>
					<th>No Plat</th>
					<th>Harga Sewa</th>
					<th>Tgl.Rental</th>
					<th>Tgl.Kembali</th>
					<th>Action</th>
					<th>Batal</th>

				</tr>
				<?php $no=1; foreach($transaksi as $tr) : ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $tr->nama ?></td>
					<td><?php echo $tr->merk ?></td>
					<td><?php echo $tr->no_plat ?></td>
					<td>Rp.<?php echo number_format($tr->harga,0,',','.') ?></td>
					<td><?php echo date('d/M/Y',strtotime($tr->tgl_rental))?></td>
					<td><?php echo date('d/M/Y',strtotime($tr->tgl_kembali))?></td>
					<td>
						<?php if($tr->status_rental == "Selesai") { ?>
							<button class="btn btn-sm btn-success">Rental Selesai</button>
						<?php }else{ ?>
							<a href="<?php echo base_url('customer/transaksi/pembayaran/'.$tr->id_rental) ?>" class="btn btn-sm btn-success">Cek Pembayaran</a>
						<?php } ?>
					</td>

				<!-- <td>
					<?php 
						if ($tr->status_rental == 'Belum Selesai') {?>
							<a onclick="return confirm('apakah anda yakin untuk membatalkan ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('customer/transaksi/batal_transaksi/'.$tr->id_rental) ?>">Batal</a> 
					<?php }else { ?>
							<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
							 Batal
							</button>
					<?php } ?>

				</td> -->
				<?php if($tr->status_rental == "Belum selesai") {?>
					<td>
						<a class="btn btn-sm btn-danger" href="<?php echo base_url('customer/transaksi/batal_transaksi/').$tr->id_rental ?>">Batal</a>
					</td>
				<?php }?>
			</tr>
		<?php endforeach; ?>
	</table>
</div>


</div>

<!-- <div class="card mx-auto" style="margin-top: 50px; width: 89%; margin-bottom:150px">
	<div class="card-header bg-info">
		Data Transaks Paket Tour Anda
	</div>
	<span class="mt-2 p-2"><?php echo $this->session->flashdata('pesan') ?></span>

	<div class="card-body">
		<table class="table rable-bordered table-striped">
			<tr>
				<th>No.</th>
				<th>Nama Paket</th>
				<th>Harga</th>
				<th>Tanggal Booking</th>

				<th>Action</th>
				<th>Batal</th>

			</tr>
			<?php $no=1; foreach($transaksi_paket as $tr) : ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $tr->package_name ?></td>
				
				<td>Rp.<?php echo number_format($tr->total_harga,0,',','.') ?></td>
				<td><?php echo date('d-M/Y',strtotime($tr->tgl_rental))?></td>

				<td>
					<?php if($tr->status == "Selesai") { ?>
						<button class="btn btn-sm btn-success">Rental Selesai</button>
					<?php }else{ ?>
						<a href="<?php echo base_url('customer/transaksi/pembayaran_paket/'.$tr->id_transaksi_paket) ?>" class="btn btn-sm btn-success">Cek Pembayaran</a>
					<?php } ?>
				</td>

				<td>
					<?php 
					if ($tr->status == 'Menunggu') {?>
						<a onclick="return confirm('apakah anda yakin untuk membatalkan ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('customer/transaksi/batal_transaksi/'.$tr->id_transaksi_paket) ?>">Batal</a> 
					<?php }else { ?>
						<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
							Batal
						</button>
					<?php } ?>

				</td>

			</tr>
		<?php endforeach; ?>
	</table>
</div>
</div> -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Informasi Batal Transaksi </h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Transaksi Sudah Selesai! tidak Bisa Dibatalkan.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>