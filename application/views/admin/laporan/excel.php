<table border="1">
	<tr><th align="center" colspan="12"><h2>Laporan Rental Mobil PO. Siswantoro</h2></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<tr>
		<td>Tanggal : <?php echo "Yogyakarta,  " . date("d-M-Y") . ""; ?> </td>
	</tr>
	<tr>
		<th>No</th>
		<th>Customer</th>
		<th>Mobil</th>
		<th>Pemilik</th>
		<th>Tgl Rental</th>
		<th>Tgl Kembali</th>
		<th>Harga</th>
		<th>Dendan/hari</th>
		<th>Total Denda</th>
		<th>Lama Sewa</th>
		<th>Tgl dikembalikan</th>
		<th>Total Bayar</th>
	</tr>
	<?php
	foreach ($query as $no => $row) { ?>
		<td><?= $no++ ?></td>
		<td><?= $row->nama ?></td>
		<td><?= $row->merk ?></td>
		<td><?= $row->status_mitra ?></td>
		<td><?= $row->tgl_rental ?></td>
		<td><?= $row->tgl_kembali ?></td>
		<td><?= $row->harga ?></td>
		<td><?= $row->denda ?></td>
		<td><?= $row->total_denda ?></td>
		<td><?= 'belum' ?></td>
		<td><?= $row->tgl_pengembalian ?></td>
		<td><?= 'belum' ?></td>
	<?php } ?>
</table>
