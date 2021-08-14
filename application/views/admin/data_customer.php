<div class="main-content">
    <section class="section">
     <div class="section-header">
        <h1>Data Customer</h1>
   </div>
   <!-- <a href="<?php echo base_url('admin/data_customer/tambah_customer') ?>" class="btn btn-primary mb-3 "  ><i class="fas fa-user-plus"></i>Tambah Data</a> -->
   <?php echo $this->session->flashdata('pesan') ?>

   <table class="table table-striped table-responsive table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>No. Telepon</th>
        <th>No. Identitas</th>
        <th>Password</th>
        <th>Aksi</th>
   </tr>

   <?php 
   $no=1;
   foreach($customer as $cs) :   ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $cs->nama ?></td>
            <td><?php echo $cs->username ?></td>
            <td><?php echo $cs->alamat ?></td>
            <td><?php echo $cs->jenis_kelamin ?></td>
            <td><?php echo $cs->no_telepon ?></td>
            <td><?php echo $cs->no_identitas?></td>
            <td><?php echo $cs->password ?></td>
            <td>
                <div class="row">
                    <a class="btn btn-sm btn-primary " href="<?php echo base_url('admin/data_customer/update_customer/'.$cs->id_customer) ?>"><i class="fas fa-edit " ></i></a>
                    <a onclick="return confirm('yakin menghapus ?')" class="btn btn-sm btn-danger " href="<?php echo base_url('admin/data_customer/delete_customer/'.$cs->id_customer) ?>"><i class="fas fa-trash"></i></a>          					
               </div>

          </td>
     </tr>
<?php endforeach; ?>

</table>
</section>
</div>