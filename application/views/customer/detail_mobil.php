<div class="container mt-5 mb-5">
	<div class="card" style="margin-top: 200px">
		<div class="card-body">
			
			<div class="row">
				<div class="col-md-6">



					<?php 


					foreach ($gambar as $data) { ?>


						<img style="width: 70%;margin: 2px;" src="<?php echo base_url('assets/upload/'.$data['gambar']) ?>" > 
						<?php
					}


					?>

				</div>
				<?php foreach ($detail as $dt ) : ?>
					<div class="col-md-6">
						<table class="table">
							<tr>
								<th>Merk</th>
								<td><?php echo $dt['merk']; ?></td>
							</tr>
							<tr>
								<th>No Plat</th>
								<td><?php echo $dt['no_plat']; ?></td>
							</tr>
							<tr>
								<th>Warna</th>
								<td><?php echo $dt['warna']; ?></td>
							</tr>
							<tr>
								<th>Tahun Produksi</th>
								<td><?php echo $dt['tahun']; ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td><?php
								if($dt['status'] == '0'){
									echo "Tersedia";
								}else{
									echo "Tidak Tersedia";
								}?>
							</td>
						</tr>
						
					</table>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</div>

</div>