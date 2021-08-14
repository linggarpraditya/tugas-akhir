<table class="table" style="width: 80%">
	<div class="card" style="margin-top: 50px">
	<h2 align="center">Invoice Pembayaran Anda</h2>
<?php echo "Tanggal Cetak Invoice:  " . date("d/M/Y") . "<br>";?>
	<hr>
				<?php foreach($transaksi as $tr) : ?>
						<tr>
							<td>Nama Customer</td>
							<td>:</td>
							<td><?php echo $tr->nama ?></td>
						</tr>
						<tr>
							<td>Merk Mobil</td>
							<td>:</td>
							<td><?php echo $tr->merk ?></td>
						</tr>
						<tr>
							<td>Tanggal Rental</td>
							<td>:</td>
							<td><?php echo date('d/m/Y',strtotime($tr->tgl_rental))?></td>
						</tr>
						<tr>
							<td>Tanggal Kembali</td>
							<td>:</td>
							<td><?php echo date('d/m/Y',strtotime($tr->tgl_kembali))?></td>
						</tr>
						<tr>
							<td>Biaya Sewa/Hari</td>
							<td>:</td>
							<td>Rp.<?php echo number_format($tr->harga,0,',','.') ?></td>
						</tr>
						<tr>
							<?php 
							$x= strtotime($tr->tgl_kembali);
							$y= strtotime($tr->tgl_rental);
							$jmlhari = abs(($x-$y)/(60*60*24));
							 ?>
							<td>Jumlah Hari Sewa</td>
							<td>:</td>
							<td><?php echo $jmlhari ?> Hari</td>
						</tr>
						<tr>
							<td>Status Pembayaran</td>
							<td>:</td>
							<td><?php if($tr->status_pembayaran == '0'){
								echo "Belum Lunas";
							}else{ echo "Lunas";}  ?>
							</td>
						</tr>
						<tr style="color: red; font-weight: bold">
							<td>TOTAL BAYAR</td>
							<td>:</td>
							<td><button class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($tr->harga * $jmlhari,0,',','.') ?></b></button></td>
						</tr>
				
						<?php endforeach; ?>
					</div>
					</table> <br><br> <hr>
					<h4 align="right" style="margin-right: 30px;"><?php echo "Yogyakarta,  ". date("d-M-Y") . "";?> </h4><br><br>
					<h4 align="right" style="margin-right: 30px;">[ PO. Siswantoro ]</h4>

					<script type="text/javascript">
						window.print();
					</script>