 <?php
	$role_id    = $this->session->userdata('role_id');
	?>

 <section id="page-title-area" class="section overlay">
 	<div class="container">
 		<?php echo $this->session->flashdata('pesan') ?>
 		<div class="row">
 			<div class="col-lg-12">
 				<div class="section-title  text-center mb-5">
 					<h2>Daftar Mobil</h2>
 					<span class="title-line"><i class="fa fa-car"></i></span>

 				</div>
 			</div>
 		</div>
 	</div>
 </section>

 <section id="car-list-area" class="section-padding">
 	<div class="container">
 		<div class="row">
 			<!-- Car List Content Start -->
 			<div class="col-lg-12">
 				<div class="car-list-content">
 					<div class="row">
 						<!-- Single Car Start -->
 						<?php foreach ($mobil as $mb) : ?>
 							<div class="col-lg-6 col-md-6">
 								<div class="single-car-wrap" style="min-height: 50vh;">
 									<div style="
									 background-image: url('<?php echo base_url("assets/upload/$mb->gambar") ?>');
									 width: 100%;
									 height:30vh;
									 background-size: cover;
									 background-repeat: no-repeat;
									 background-position: center;
									 "></div>
 									<!-- <img src="<?php echo base_url('assets/upload/') . $mb->gambar ?>"> -->
 									<div class="car-list-info without-bar">
 										<h2><a href="#"><?php echo $mb->merk ?></a></h2>
 										<h5>Rp. <?php echo number_format($mb->harga, 0, ',', '.') ?> /Hari</h5>
 										<!--  <ul class="car-info-list">
                                            <li><?php
												if ($mb->ac == "1") {
													echo "<i class='fa fa-check-square text-success'></i>";
												} else {
													echo "<i class='fa fa-times-circle text-danger'></i>";
												} ?> AC</li>
                                            
                                            <li><?php
												if ($mb->supir == "1") {
													echo "<i class='fa fa-check-square text-success'></i>";
												} else {
													echo "<i class='fa fa-times-circle text-danger'></i>";
												} ?> Supir</li>

                                            <li><?php
												if ($mb->mp3_player == "1") {
													echo "<i class='fa fa-check-square text-success'></i>";
												} else {
													echo "<i class='fa fa-times-circle text-danger'></i>";
												} ?> Mp3 Player</li>
                                            
                                        </ul> -->


 										<?php if ($mb->status == "Tersedia") {
												echo anchor('customer/rental/tambah_rental/' . $mb->id_mobil, '<span class="rent-btn">Sewa</span>');
											} else {
												echo "<span class='rent-btn'>Tidak Tersedia</span>";
											}
											?>
 										<a href="<?php echo base_url('customer/data_mobil/read/' . $mb->id_mobil) ?>" class="rent-btn">Detail</a>
 									</div>
 								</div>
 							</div>
 						<?php endforeach ?>

 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
