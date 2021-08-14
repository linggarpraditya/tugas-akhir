
<!--== Page Title Area Start ==-->
<section id="page-title-area" class="section-padding overlay">
  <div class="container">
    <?php echo $this->session->flashdata('pesan') ?>
    <div class="row">
      <!-- Page Title Start -->
      <div class="col-lg-12">
        <div class="section-title  text-center">
          <h2>Daftar Paket Tour</h2>
          <span class="title-line"><i class="fa fa-car"></i></span>
          
        </div>
      </div>
      <!-- Page Title End -->
    </div>
  </div>
</section>
<!--== Page Title Area End ==-->

<!--== Car List Area Start ==-->
<section class="section">
  <div class="section-header mt-3">
    
   <div class="container">
     
     
     
     <div class="row">
      <?php 
      $count=0;
      foreach ($package->result() as $row) :
        $count++;
        ?>
        <div class="col-sm-6 mb-2">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title"><?php echo $row->package_name;?></h3>
              <img src="<?php echo base_url('assets/upload/').$row->foto ?>">
              <div class="car-list-info without-bar">
                <h6>Rp. <?php echo number_format($row->harga_paket,0,',','.');?> /Orang</h6>
                <h5>Kuota <?php echo $row->kuota; ?></h5><br>
                <?php  echo anchor('customer/paket_tour/tambah_paket/'.$row->package_id,'<span class="rent-btn">Sewa</span>'); ?>
                <a class="rent-btn" href="<?php echo base_url('admin/package/detail/'). $row->package_id?>" class="btn btn-sm btn-success">Detail</a>
                
              </div>
            </div>
          </div>
        </div>
      <?php endforeach;?>


    </div>



  </div>
</section>
<!--== Car List Area End ==-->
