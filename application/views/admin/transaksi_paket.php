<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Transaksi</h1>
		</div>

		<table class="table-responsive table table-bordered table-striped">
			<tr>
				<th>NO.</th>
				<th>Customer</th>
				<th>Nama Paket</th>
				<th>Tgl.Rental</th>
				<th>Jumlah Tiket</th>
				<th>Harga</th>
				<th>Validasi</th>
				<th>Bukti bayar</th>
				<th>Action</th>

			</tr>

			<?php $no=1;
			foreach ($transaksi as $tr) : ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $tr->nama ?></td>
					<td><?php echo $tr->package_name ?></td>
					
					<td><?php echo date('d-m-Y',strtotime($tr->tgl_rental))?></td>
					<td><?php echo $tr->jumlah_orang ?></td>
					
					<td>Rp.<?php echo number_format($tr->total_harga,0,',','.') ?></td>
					


				<td><?php 
if($tr->status=="1"){

echo "Sudah Dibayar";

}else{

	echo "Belum Dibayar";
}

?></td>

				

				<td>
						<center>
							<?php if(empty($tr->bukti)) { ?>
								<button class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></button>
							<?php }else{ ?>
								<a class="btn btn-sm btn-success" href="<?php echo base_url('admin/transaksi_paket/pembayaran/'.$tr->id_transaksi_paket) ?>"><i class="fas fa-check-circle"></i></a>
							<?php } ?>
						</center>
					</td>
					
					
<td>
	<a onclick="return confirm('apakah anda yakin untuk menghapus ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/transaksi_paket/batal_transaksi/'.$tr->package_id) ?>"><i class="fas fa-times"></i></a>
</td>
				
				
				</tr>
			<?php endforeach; ?>
		</table>




	</section>



</div>