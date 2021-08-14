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
			<?php echo form_error('dari', '<span class="text-small text-danger">', '</span>') ?>
		</div>

		<div class="form-group">
			<label>Sampai Tanggal</label>
			<input type="date" name="sampai" class="form-control">
			<?php echo form_error('sampai', '<span class="text-small text-danger">', '</span>') ?>
		</div>

		<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>Tampilkan Data</button>
	</form>
	<hr>

	<div class="btn-group">
		<a class="btn btn-success" target="_blank" href="<?php echo base_url() . 'admin/laporan/print_laporan/?dari=' . set_value('dari') . '&sampai=.set_value(sampai)' ?>"><i class="fa fa-print"> Cetak Laporan</i></a>
		<a class="btn btn-warning" target="_blank" href="<?php echo base_url('admin/laporan/excel?dari=' . set_value('dari') . '&sampai=' . set_value('sampai')) ?>">Export excel</a>
	</div>

	<table class="table-responsive table table-bordered table-striped mt-4">
		<tr>
			<th>NO.</th>
			<th>Customer</th>
			<th>Mobil</th>
			<th>Pemilik</th>
			<th>Tgl.Rental</th>
			<th>Tgl.Kembali</th>
			<th>Harga</th>
			<th>Dendan/hari</th>
			<th>Total Denda</th>
			<th>Lama Sewa</th>
			<th>Tgl.Dikembalikan</th>
			<th>Total Bayar</th>



		</tr>

		<?php
		$grandtotalperusahaan = 0;
		foreach ($transaksi as $key => $tr) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
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
				$subtotalperusahaan = $tr->harga * $jmlhari2 + $tr->total_denda;
				?>
				<td><?php echo $jmlhari2 ?> Hari</td>
				<td>
					<?php
					if ($tr->tgl_pengembalian == "0000-00-00") {
						echo "-";
					} else {
						echo date('d-m-Y', strtotime($tr->tgl_pengembalian));
					}
					?>
				</td>
				<td>
					<div class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($subtotalperusahaan, 0, ',', '.') ?></b></div>
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
					<?php
					if ($tr->tgl_pengembalian == "0000-00-00") {
						echo "-";
					} else {
						echo date('d-m-Y', strtotime($tr->tgl_pengembalian));
					}
					?>
				</td>
				<td>
					<div class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($subtotalperusahaan, 0, ',', '.') ?></b></div>
				</td>



			</tr>
			<?php


			$grandtotal += $subtotal; ?>

		<?php endforeach; ?>

		<!--   <tr>
					
			<td colspan="3">Pendapatan Mitra :<?php echo 40 / 100 * $grandtotal; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<?php $darimitra = 60 / 100 * $grandtotal; ?>
			<td colspan="3">Pendapatan Dari Mitra : Rp. <?php echo number_format($darimitra, 0, ',', '.') ?></td>
			<td></td>
			<td></td>
			<td></td>
			
		</tr> -->
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


	<div class="card ">
		<div class="card-header">Pie cart</div>
		<div class="card-body d-flex justify-content-center">
			<div class="w-25">
				<canvas id="piechart"></canvas>
			</div>
		</div>
	</div>
	<!-- <div class="card">
		<div class="card-header">Line cart</div>
		<div class="card-body">
			<div>
				<canvas id="linechart"></canvas>
			</div>
		</div>
	</div> -->
</div>
<script>
	var colors = [
		"#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177", "#0d5ac1",
		"#f205e6", "#1c0365", "#14a9ad", "#4ca2f9", "#a4e43f", "#d298e2", "#6119d0",
		"#d2737d", "#c0a43c", "#f2510e", "#651be6", "#79806e", "#61da5e", "#cd2f00",
		"#9348af", "#01ac53", "#c5a4fb", "#996635", "#b11573", "#4bb473", "#75d89e",
		"#2f3f94", "#2f7b99", "#da967d", "#34891f", "#b0d87b", "#ca4751", "#7e50a8",
		"#c4d647", "#e0eeb8", "#11dec1", "#289812", "#566ca0", "#ffdbe1", "#2f1179",
		"#935b6d", "#916988", "#513d98", "#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
		"#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
		"#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
		"#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
		"#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
		"#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
		"#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
		"#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
		"#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
		"#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
		"#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
		"#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
		"#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
		"#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
		"#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
		"#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
		"#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
		"#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
		"#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
		"#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
		"#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
		"#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
		"#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
		"#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
		"#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
		"#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
		"#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
		"#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
		"#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
		"#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
		"#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
		"#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
		"#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
		"#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"
	];




	// === include 'setup' then 'config' above ===
	const data = {
		labels: [
			<?php
			foreach ($pie_mobil as $key => $value) {
				echo "'$value->merk',";
			}
			?>
		],
		datasets: [{
			label: 'Perbandingan mobil',
			data: [
				<?php
				foreach ($pie_mobil as $key => $value) {
					echo "$value->jumlah_mobil,";
				}
				?>
			],
			backgroundColor: colors,
			hoverOffset: 4
		}]
	};

	const config = {
		type: 'doughnut',
		data: data,
	};


	var piechart = new Chart(
		document.getElementById('piechart'),
		config
	);
</script>



<!-- <script>
	const labels_line = [
		'Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agusstus', 'September', 'Oktober', 'November', 'Desember'
	];
	const data_line = {
		labels: labels_line,
		datasets: [{
			label: 'My First Dataset',
			data: [65, 59, 80, 81, 56, 55, 40],
			fill: false,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		}]
	};

	const config_line = {
		type: 'line',
		data: data_line,
	};


	var linechart = new Chart(
		document.getElementById('linechart'),
		config_line
	);
</script> -->
