<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>Edit Data Customer</h1>
          </div>
      </section>

      <?php foreach($customer as $cs ) : ?>

      <form method="POST" action="<?php echo base_url('admin/data_customer/update_customer_aksi') ?>">
          <div class="form-group">
          <label>Nama</label>
          <input type="hidden" name="id_customer" value="<?php echo $cs->id_customer ?>">
          <input type="text" name="nama" class="form-control" value="<?php echo $cs->nama ?>">
          <?php echo form_error('nama','<span class="text-small text-danger">','</span>') ?>
          </div>

          <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?php echo $cs->username ?>">
          <?php echo form_error('username','<span class="text-small text-danger">','</span>') ?>
          </div>

          <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?php echo $cs->alamat ?>">
          <?php echo form_error('alamat','<span class="text-small text-danger">','</span>') ?> 
          </div>

          <div class="form-group">
               <label>Jenis Kelamin</label>
               <select class="form-control" name="jenis_kelamin">
                    <option value="<?php echo $cs->jenis_kelamin ?>"><?php echo $cs->jenis_kelamin ?></option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
               </select>
          <?php echo form_error('jenis_kelamin','<span class="text-small text-danger">','</span>') ?>
          </div>

          <div class="form-group">
          <label>No Telepon</label>
          <input type="text" name="no_telepon" class="form-control" value="<?php echo $cs->no_telepon ?>">
          <?php echo form_error('no_telepon','<span class="text-small text-danger">','</span>') ?>  
          </div>

          <div class="form-group">
          <label>No Identitas</label>
          <input type="text" name="no_identitas" class="form-control" value="<?php echo $cs->no_identitas ?>">
          <?php echo form_error('no_identitas','<span class="text-small text-danger">','</span>') ?>     
          </div>

          <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" value="<?php echo $cs->password ?>">
          <?php echo form_error('password','<span class="text-small text-danger">','</span>') ?>    
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          <button type="submit" class="btn btn-sm btn-danger">Reset</button>

      </form>
 <?php endforeach; ?>
</div>