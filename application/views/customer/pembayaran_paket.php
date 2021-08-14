<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-8">
			<div class="card" style="margin-top: 130px">
				<div class="card-header alert alert-success" >
					Invoice Pembayaran Anda
				</div>
				<div class="card-body">
					<table class="table">
						<?php foreach($transaksi_paket as $tr) : ?>
						<tr>
							<td>Nama Paket</td>
							<td>:</td>
							<td><?php echo $tr->package_name ?></td>
						</tr>
						<tr>
							<td>Tanggal Booking</td>
							<td>:</td>
							<td><?php echo date('d/m/Y',strtotime($tr->package_created_at))?></td>
						</tr>
						<tr>
							<td>Harga Paket</td>
							<td>:</td>
							<td>Rp.<?php echo number_format($tr->harga_paket,0,',','.') ?></td>
						</tr>

						<tr>
							<td>TOTAL BAYAR</td>
							<td>:</td>
							<td><button class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($tr->total_harga,0,',','.') ?></b></button></td>
						</tr>
						<tr>
							<td></td><td></td>
							<td><a href="<?php echo base_url('customer/transaksi/cetak_invoice_paket/'.$tr->id_transaksi_paket) ?>" class="btn btn-sm btn-warning ">Print Invoice</a></td>
						</tr>

						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card" style="margin-top: 130px">
				<div class="card-header alert alert-primary">
				Informasi Pembayaran
			</div>
			<div class="card-body">
				<h5 class="text-black">Silahkan Melakukan Pembayaran Melalui No-Rekening dibawah ini :</h5>
				<ul class="list-group mt-2">
				 <li class="list-group-item"><img width="80px" align="center" src="<?php echo base_url() ?>assets/assets_customer/img/bri.png"></li>
						<li class="list-group-item">6438-01-009908-53-1</li>
						<li class="list-group-item">a.n Sis Ari Prasetyo</li>
				</ul>
				<?php 
					if(empty($tr->bukti)) { ?>
						<button style="width: 100%" type="button " class="btn btn-sm btn-primary mt-2" 
						data-toggle="modal" data-target="#exampleModal">
						  Upload Bukti Pembayaran
						</button>
					<?php }elseif($tr->status == '0'){ ?>
						<button style="width: 100%" class="btn btn-sm btn-danger mt-2"><i class="fa fa-clock-o"></i>  Menunggu Konfirmasi</button>
					<?php }elseif($tr->status == '1') { ?>
						<button style="width: 100%" class="btn btn-sm btn-success mt-2"><i class="fa fa-check"></i>  Pembayaran Selesai</button>
					<?php } ?>
			</div>
			</div>
			
		</div>
	</div>
</div>



<!-- Modal upload -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="<?php echo base_url('customer/transaksi/pembayaran_paket_aksi') ?>" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
       	<label>Upload Bukti Pembayaran</label>
       	<input type="hidden" name="id_transaksi_paket" class="form-control" value="<?php echo $tr->id_transaksi_paket ?>">
       	<input type="file" name="bukti" class="form-control">
       </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>