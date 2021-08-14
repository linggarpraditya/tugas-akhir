<!-- Content Header (Page header) -->
<div class="container mt-5 mb-5">

  <div class="card" style="margin-top: 150px">
    <div class="card-body">
      <center><h3>Destinasi Paket tour</h3></center>
     <?php 
                    $count=0;
                    foreach ($bawa->result() as $row) :
                      $count++; ?>
        <div class="row">
        <div class="col-md-6">
          <img style="width: 50%" src="<?php echo base_url().'assets/upload/'.$row->gambar ?>"><hr>
        </div>
          <div class="col-md-6">
          <table class="table">

            <tr>
              <th>No</th>
              <td>:</td>
              <td><?php echo $count;?></td>
            </tr>
            <tr>
              <th>Nama Paket</th>
              <td>:</td>
              <td><?php echo $row->nama_destinasi;?></td>
            </tr>
            <!-- <tr>
              <th>Harga</th>
              <td>:</td>
              <td><?php echo $row->harga_paket;?></td>
            </tr><br> -->

          </table>
        </div>
        </div>
      <?php endforeach; ?>
       <a href="javascript:history.back()"><button class="btn btn-primary btn-sm pull-right">Kembali</button></a>
    </div>
  </div>

</div>
