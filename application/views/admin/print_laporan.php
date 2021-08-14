<br>
<h3 style="text-align: center; font-family: times new roman; color: black">Laporan Transaksi PO Siswantoro</h3>
<hr>
<table>
	<tr>
		<td>Dari Tanggal</td>
		<td>:</td>
		<td><?php echo date('d-M-Y', strtotime($_GET['dari'])) ?></td>
	</tr>
	<tr>
		<td>Sampai Tanggal</td>
		<td>:</td>
		<td><?php echo date('d-M-Y', strtotime($_GET['sampai'])) ?></td>
	</tr>
</table>

<!-- <table class="table-responsive table table-bordered table-striped mt-4" style="font-size: 11px">
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

      <?php $no = 1;
			foreach ($laporan as $tr) : ?>
        <tr>
         <td><?php echo $no++ ?></td>
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
          <td>Rp.<?php echo number_format($subtotalperusahaan, 0, ',', '.') ?></td>

        </tr>
      <?php endforeach; ?>
    </table> -->


<table class="table table-bordered table-striped">
	<tr>

		<th>Customer</th>
		<th>Mobil</th>
		<th>Pemilik</th>
		<th>Tgl.Rental</th>
		<th>Tgl.Kembali</th>
		<th>Harga</th>
		<th>Dendan/hari</th>
		<th>Total Denda</th>
		<th>Lama Sewa</th>
		<th>Tanggal Pengembalian</th>
		<th>Total Bayar</th>
	</tr>

	<?php
	$grandtotalperusahaan = 0;
	foreach ($laporan as $tr) : ?>
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
			<td>Rp.<?php echo number_format($subtotalperusahaan, 0, ',', '.') ?></td>

		</tr>

		<?php


		$grandtotalperusahaan += $subtotalperusahaan; ?>
	<?php endforeach; ?>

	<!-- <?php
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
        <td><div class="btn btn-sm btn-success"><b>Rp.<?php echo number_format($subtotal, 0, ',', '.') ?></b></div></td>

    </tr>

    <?php


					$grandtotal += $subtotal; ?>
  <?php endforeach; ?> -->

	<tr>
		<?php $darimitra = 60 / 100 * $grandtotal; ?>
		<td style="text-align:right" colspan="10">Pendapatan Perusahaan</td>
		<td>Rp.<?php echo number_format($grandtotalperusahaan + $darimitra, 0, ',', '.') ?></td>
	</tr>
</table><br><br>
<hr>
<h4 align="right" style="margin-right: 30px;"><?php echo "Yogyakarta,  " . date("d-M-Y") . ""; ?> </h4><br><br>
<h4 align="right" style="margin-right: 30px;">[ PO. Siswantoro ]</h4>

<script type="text/javascript">
	window.print();
</script>
