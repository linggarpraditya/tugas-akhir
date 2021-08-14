<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-8">
			<div class="card" style="margin-top: 130px">
				<div class="card-header alert alert-success">
					Invoice Pembayaran Anda
				</div>
				<div class="card-body">
					<table class="table">
						<?php $tr = $transaksi ?>
						<tr>
							<td>Nama Penyewa</td>
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
							<td><?php echo date('d/m/Y', strtotime($tr->tgl_rental)) ?></td>
						</tr>
						<tr>
							<td>Tanggal Kembali</td>
							<td>:</td>
							<td><?php echo date('d/m/Y', strtotime($tr->tgl_kembali)) ?></td>
						</tr>
						<tr>
							<td>Biaya Sewa/Hari</td>
							<td>:</td>
							<td>Rp.<?php echo number_format($tr->harga, 0, ',', '.') ?></td>
						</tr>
						<tr>
							<?php
							$x = strtotime($tr->tgl_kembali);
							$y = strtotime($tr->tgl_rental);
							$jmlhari = abs(($x - $y) / (60 * 60 * 24)) ?: 1;
							?>
							<td>Jumlah Hari Sewa</td>
							<td>:</td>
							<td><?php echo $jmlhari ?> Hari</td>
						</tr>
						<tr>
							<td>TOTAL BAYAR</td>
							<td>:</td>
							<td><button class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($tr->harga * $jmlhari, 0, ',', '.') ?></b></button></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php if ($tr->id_midtrans) {
							$notif = $this->veritrans->status($tr->id_midtrans);

							// echo "<pre>";
							// print_r($tr);
							// echo "</pre>";
							// die;

							if ($notif->transaction_status == 'settlement' && $tr->status_pembayaran != 1) {
								redirect('customer/transaksi/transaksi_selesai/' . $id);
							}
						?>
							<table class="table table-sm">
								<?php if (isset($notif->store)) { ?>
									<tr>
										<td class="text-bold">Tempat Pembayaran</td>
										<td><?= $notif->store ?></td>
									</tr>
									<tr>
										<td class="text-bold">Kode Transaksi</td>
										<td><?= $notif->payment_code ?></td>
									</tr>
								<?php } ?>
								<?php if (isset($notif->payment_type)) { ?>
									<tr>
										<td class="text-bold">Tipe Pembayaran</td>
										<td><?= $notif->payment_type ?></td>
									</tr>
								<?php } ?>
								<?php if (isset($notif->approval_code)) { ?>
									<tr>
										<td class="text-bold">Approval Code</td>
										<td><?= $notif->approval_code ?></td>
									</tr>
								<?php } ?>
								<?php if (isset($notif->va_numbers)) { ?>
									<tr>
										<td class="text-bold">Bank</td>
										<td><?= $notif->va_numbers[0]->bank ?></td>
									</tr>
									<tr>
										<td class="text-bold">Va Number</td>
										<td><?= $notif->va_numbers[0]->va_number ?></td>
									</tr>

								<?php } ?>
								<tr>
									<td class="text-bold">Biaya</td>
									<td><?= ($notif->gross_amount) ?></td>
								</tr>
								<tr>
									<td class="text-bold">Status Transaksi</td>
									<td><?= $notif->transaction_status ?></td>
								</tr>
								<?php if (!empty($url_panduan_pembayaran)) { ?>
									<tr>
										<td colspan="2" class="text-bold text-center"><a href="<?= $url_panduan_pembayaran ?>">Download Panduan Pembayaran</a></td>
									</tr>
								<?php } ?>
							</table>

							<?php if ($tr->status_pembayaran == 0) { ?>
								<tr>
									<td></td>
									<td><a href="<?php echo base_url('customer/transaksi/cetak_invoice/' . $tr->id_rental) ?>" class="btn btn-sm btn-warning mt-5"><i class="fa fa-print"></i> Print Invoice</a></td>
									<td><button class="btn btn-sm btn-warning mt-5" id="pay-button" style="width: 230px; border-radius: 5px; font-weight: bold;"> GANTI PEMBAYARAN </button></td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td></td>
								<td><a href="<?php echo base_url('customer/transaksi/cetak_invoice/' . $tr->id_rental) ?>" class="btn btn-sm btn-warning mt-5"><i class="fa fa-print"></i> Print Invoice</a></td>
								<td><button class="btn btn-sm btn-warning mt-5" id="pay-button" style="width: 230px; border-radius: 5px; font-weight: bold;"> BAYAR SEKARANG </button></td>
							</tr>
						<?php } ?>


					</table>

					<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
					<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-DutR918PIZV-1JwS"></script>
					<script type="text/javascript">
						var url = `<?= site_url("customer/transaksi/handletransaksimidtrans/$id") ?>`;

						var handlerespon = (data) => {
							window.location.href = url + `?data=${JSON.parse(data)}`;
							// $.ajax({
							// 	type: "POST",
							// 	url: `<?= site_url("customer/transaksi/handletransaksimidtrans/$id") ?>`,
							// 	data: {
							// 		data: data,
							// 	},
							// 	dataType: "json",
							// 	success: function(response) {
							// 		console.log(data)
							// 		console.log(response)
							// 	},
							// 	error(x, y, z) {
							// 		console.log(x)
							// 		console.log(y)
							// 		console.log(z)
							// 	}
							// });
						}

						document.getElementById('pay-button').onclick = function() {
							// SnapToken acquired from previous step
							snap.pay('<?= $token ?>', {
								// Optional
								onSuccess: function(result) {
									/* You may add your own js here, this is just example */
									// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
									console.log(result);
									handlerespon(result);
								},
								// Optional
								onPending: function(result) {
									/* You may add your own js here, this is just example */
									// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
									console.log(result);
									handlerespon(result);
								},
								// Optional
								onError: function(result) {
									/* You may add your own js here, this is just example */
									// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
									console.log(result);
									handlerespon(result);
								}
							});
						};
					</script>
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
					if (empty($tr->bukti_pembayaran)) { ?>
						<button style="width: 100%" type="button " class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#exampleModal">
							Upload Bukti Pembayaran
						</button>
					<?php } elseif ($tr->status_pembayaran == '0') { ?>
						<button style="width: 100%" class="btn btn-sm btn-danger mt-2"><i class="fa fa-clock-o"></i> Menunggu Konfirmasi</button>
					<?php } elseif ($tr->status_pembayaran == '1') { ?>
						<button style="width: 100%" class="btn btn-sm btn-success mt-2"><i class="fa fa-check"></i> Pembayaran Selesai</button>
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

			<form method="POST" action="<?php echo base_url('customer/transaksi/pembayaran_aksi') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>Upload Bukti Pembayaran</label>
						<input type="hidden" name="id_rental" class="form-control" value="<?php echo $tr->id_rental ?>">
						<input type="file" name="bukti_pembayaran" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
