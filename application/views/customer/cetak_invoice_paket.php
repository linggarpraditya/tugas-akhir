<table class="table" style="width: 80%">
	<div class="card" style="margin-top: 50px">
	<div align="center" class="card-header alert alert-success" ><h2>Invoice Pembayaran Anda</h2></div>
<?php echo "Tanggal Cetak Invoice:  " . date("d/M/Y") . "<br>";?> 
	<hr>

				<?php foreach($transaksi_paket as $tr) : ?>
						<tr>
							<td>Nama Customer</td>
							<td>:</td>
							<td><?php echo $tr->nama ?></td>
						</tr>
						<tr>
							<td>No Telepon</td>
							<td>:</td>
							<td><?php echo $tr->no_telepon ?></td>
						</tr>
						<tr>
							<td>Tanggal Booking</td>
							<td>:</td>
							<td><?php echo date('d-M-Y',strtotime($tr->package_created_at))?></td>
						</tr>
						<tr>
							<td>Harga Paket</td>
							<td>:</td>
							<td>Rp.<?php echo number_format($tr->harga_paket,0,',','.') ?></td>
						</tr>

						<tr>
							<td>Jumlah</td>
							<td>:</td>
							<td><?php echo $tr->jumlah_orang; ?> Orang</td>
						</tr>

						<tr>
							<td>Status Pembayaran</td>
							<td>:</td>
							<td><?php if($tr->status == '1'){
								echo "Lunas";
							}else{ echo "Belum Lunas";}  ?>
							</td>
						</tr>

						<tr>
							<td>TOTAL BAYAR</td>
							<td>:</td>
							<td><button class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($tr->total_harga,0,',','.') ?></b></button></td>
						</tr>
						
				
						<?php endforeach; ?>
					</div>
					</table><br><br> <hr>
					<h4 align="right" style="margin-right: 30px;"><?php echo "Yogyakarta,  ". date("d-M-Y") . "";?> </h4><br><br>
					<h4 align="right" style="margin-right: 30px;">[ PO. Siswantoro ]</h4>

					<script type="text/javascript">
						window.print();
					</script>