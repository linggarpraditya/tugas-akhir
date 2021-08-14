<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Transaksi</h1>
		</div>

		<table class="table-responsive table table-sm table-bordered table-striped">
			<tr>

				<th>Customer</th>
				<th>Sopir</th>
				<th>Mobil</th>
				<th>Pemilik</th>
				<th>Tgl.Rental</th>
				<th>Tgl.Kembali</th>
				<th>Harga</th>
				<th>Dendan/hari</th>
				<th>Total Denda</th>
				<th>Lama Sewa</th>
				<th>Total Bayar</th>
				<th>Tgl.Dikembalikan</th>
				<th>Status Pengembalian</th>
				<th>Status Rental</th>
				<th>Konfirmasi Pembayaran</th>
				<th>Status Transaksi Midtrans</th>
				<th>Action</th>

			</tr>

			<?php
			$grandtotalperusahaan = 0;
			foreach ($transaksi as $tr) : ?>
				<tr>

					<td><?php echo $tr->nama ?></td>
					<td><?php echo $tr->id_sopir ? $this->db->where('id_sopir', $tr->id_sopir)->get('sopir')->row()->nama_sopir : 'Tidak ada sopir' ?></td>
					<td><?php echo $tr->merk ?></td>
					<td><?php echo $tr->status_mitra ?></td>
					<td><?php echo date('d-m-Y', strtotime($tr->tgl_rental)) ?></td>
					<td><?php echo date('d-m-Y', strtotime($tr->tgl_kembali)) ?></td>
					<td>Rp.<?php echo number_format($tr->harga ?: 0, 0, ',', '.') ?></td>
					<td>Rp.<?php echo number_format($tr->denda ?: 0, 0, ',', '.') ?></td>
					<td>Rp.<?php echo number_format($tr->total_denda ?: 0, 0, ',', '.') ?></td>

					<?php
					$x = strtotime($tr->tgl_kembali);
					$y = strtotime($tr->tgl_rental);
					$jmlhari = abs(($x - $y) / (60 * 60 * 24));
					$jmlhari2 = $jmlhari + 1;
					$subtotalperusahaan = $tr->harga * $jmlhari2 + $tr->total_denda;
					?>
					<td><?php echo $jmlhari2 ?> Hari</td>
					<td>
						<div class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($subtotalperusahaan, 0, ',', '.') ?></b></div>
					</td>
					<td>
						<?php
						if ($tr->tgl_pengembalian == "0000-00-00") {
							echo "-";
						} else {
							echo date('d-m-Y', strtotime($tr->tgl_pengembalian));
						}
						?>
					</td>
					<td><?php if ($tr->status_pengembalian == "Kembali") {
							echo "Kembali";
						} else {
							echo "Belum Kembali";
						} ?></td>
					<td>
						<?php
						if ($tr->status_rental == "Selesai") {
							echo "Selesai";
						} else {
							echo "Belum Selesai";
						}
						?>
					</td>
					<td>
						<center>
							<?php if ($tr->status_pembayaran == 1) { ?>
								Sudah bayar
							<?php } else { ?>
								Belum bayar
							<?php } ?>
						</center>
					</td>
					<td>
						<?php
						if (!$tr->id_midtrans) {
							echo 'Belum memilih pembayaran';
						} else {
							$notif = $this->veritrans->status($tr->id_midtrans);
							echo $notif->transaction_status ?: 'Gagal mendapatkan status';
						}
						?>

					</td>

					<td>
						<?php
						if ($tr->status == "1") {
							echo "-";
						} else { ?>
							<div class="btn-group">
								<?php if ($tr->id_sopir) { ?>
									<a href="<?php echo base_url('admin/transaksi/tracking/') . $tr->id_rental ?>" class="btn btn-sm btn-warning">
										<i class="fas fa-map"></i>
									</a>
								<?php } ?>
								<a class="btn btn-sm btn-success" href="<?php echo base_url('admin/transaksi/transaksi_selesai/' . $tr->id_rental) ?>"><i class="fas fa-check"></i></a>
								<a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/transaksi/transaksi_batal/' . $tr->id_rental) ?>"><i class="fas fa-times"></i></a>
							</div>
						<?php } ?>
					</td>
				</tr>

				<?php


				$grandtotalperusahaan += $subtotalperusahaan; ?>
			<?php endforeach; ?>


			<?php
			$grandtotal = 0;
			foreach ($mitra as $tr) : ?>
				<tr>


					<td><?php echo $tr->nama ?></td>
					<td><?php echo $tr->merk ?></td>
					<td><?php echo $tr->status_mitra ?></td>
					<td><?php echo date('d-m-Y', strtotime($tr->tgl_rental)) ?></td>
					<td><?php echo date('d-m-Y', strtotime($tr->tgl_kembali)) ?></td>
					<td>Rp.<?php echo number_format($tr->harga, 0, ',', '.') ?></td>
					<td>Rp.<?php echo number_format($tr->denda, 0, ',', '.') ?></td>
					<td>Rp.<?php echo number_format($tr->total_denda, 0, ',', '.') ?></td>

					<?php
					$x = strtotime($tr->tgl_kembali);
					$y = strtotime($tr->tgl_rental);
					$jmlhari = abs(($x - $y) / (60 * 60 * 24));
					$jmlhari2 = $jmlhari + 1;
					$subtotal = $tr->harga * $jmlhari2 + $tr->total_denda;
					?>
					<td><?php echo $jmlhari2 ?> Hari</td>
					<td>
						<div class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($subtotal, 0, ',', '.') ?></b></div>
					</td>
					<td>
						<?php
						if ($tr->tgl_pengembalian == "0000-00-00") {
							echo "-";
						} else {
							echo date('d-m-Y', strtotime($tr->tgl_pengembalian));
						}
						?>
					</td>
					<td><?php if ($tr->status_pengembalian == "Kembali") {
							echo "Kembali";
						} else {
							echo "Belum Kembali";
						} ?></td>
					<td>
						<?php
						if ($tr->status_rental == "Selesai") {
							echo "Selesai";
						} else {
							echo "Belum Selesai";
						}
						?>
					</td>

					<td>
						<center>
							<?php if (empty($tr->bukti_pembayaran)) { ?>
								<button class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></button>
							<?php } else { ?>
								<a class="btn btn-sm btn-success" href="<?php echo base_url('admin/transaksi/pembayaran/' . $tr->id_rental) ?>"><i class="fas fa-check-circle"></i></a>
							<?php } ?>
						</center>
					</td>

					<td>
						<?php
						if ($tr->status == "1") {
							echo "-";
						} else { ?>
							<div class="row">
								<a class="btn btn-sm btn-success mr-2" href="<?php echo base_url('admin/transaksi/transaksi_selesai/' . $tr->id_rental) ?>"><i class="fas fa-check"></i></a>
								<a onclick="return confirm('apakah anda yakin untuk menghapus ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/transaksi/transaksi_batal/' . $tr->id_rental) ?>"><i class="fas fa-times"></i></a>
							</div>
						<?php } ?>
					</td>
				</tr>

				<?php


				$grandtotal += $subtotal; ?>
			<?php endforeach; ?>





			<tr>
				<td colspan="7">Pendapatan Perusahaan :Rp. <?php echo number_format($grandtotalperusahaan, 0, ',', '.') ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>


			</tr>
		</table>
	</section>
</div>
