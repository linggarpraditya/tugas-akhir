<br><h3 style="text-align: center; font-family: times new roman; color: black">Laporan Transaksi PO Siswantoro</h3><hr>
<table>
	<tr>
		<td>Dari Tanggal</td>
		<td>:</td>
		<td><?php echo date('d-M-Y',strtotime($_GET['dari'])) ?></td>
	</tr>
	<tr>
		<td>Sampai Tanggal</td>
		<td>:</td>
		<td><?php echo date('d-M-Y',strtotime($_GET['sampai'])) ?></td>
	</tr>
</table>

 <table class="table-responsive table table-bordered table-striped" >
      <tr>
      	<th>NO</th>
        <th>Customer</th>
        <th>Nama Paket</th>
        <th>Tgl.Rental</th>
        <th>Jumlah Tiket</th>
        <th>Harga</th>
        <th>Kuota</th>
        <th>Total Harga</th>
      </tr>

      <?php $no=1;
      foreach ($laporan as $tr) : ?>
        <tr>
         <td><?php echo $no++ ?></td>
         <td><?php echo $tr->nama ?></td>
          <td><?php echo $tr->package_name ?></td>
          <td><?php echo date('d-m-Y',strtotime($tr->package_created_at))?></td>
          <td><?php echo $tr->jumlah_orang ?> Orang</td>
          <td>Rp.<?php echo number_format($tr->harga_paket,0,',','.') ?></td>
          <td><?php echo $tr->kuota ?></td>
          <td>Rp.<?php echo number_format($tr->total_harga,0,',','.') ?></td>
         
        </tr>
      <?php endforeach; ?>
    </table><br><br> <hr>
					<h4 align="right" style="margin-right: 30px;"><?php echo "Yogyakarta,  ". date("d-M-Y") . "";?> </h4><br><br>
					<h4 align="right" style="margin-right: 30px;">[ PO. Siswantoro ]</h4>

 <script type="text/javascript">
    	window.print();
    </script>