<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>Detail Paket tour</h1>
          </div>

       </section>

       <?php foreach ($bawa as $row) : ?>
          <div class="card">
               <div class="card-body">
                    
                    <div class="row">
                         
                         <div class="col-md-5">
                              <table class="table">

                                   <tr>
                                        <td>Nama Paket</td>
                                        <td><?php echo $row->nama_paket ?></td>
                                   </tr>                  
                                
                              </table>
                              <a class="btn btn-sm btn-danger ml-3" href="<?php echo base_url('admin/paket_tour') ?>">Kembali</a>
                              <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/paket_tour/update_paket/'.$row->id_paket) ?>">Update</a>
                         </div>
                    </div>
               </div>
          </div>
       <?php endforeach;  ?>
 </div>