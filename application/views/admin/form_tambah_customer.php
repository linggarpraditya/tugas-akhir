<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>Data Customer</h1>
          </div>
      </section>
      <form method="POST" action="<?php echo base_url('admin/data_customer/tambah_customer_aksi') ?>">
      	<div class="form-group">
      	<label>Nama</label>
      	<input type="text" name="nama" class="form-control">
      	<?php echo form_error('nama','<span class="text-small text-danger">','</span>') ?>
      	</div>

      	<div class="form-group">
      	<label>Username</label>
      	<input type="text" name="username" class="form-control">
      	<?php echo form_error('username','<span class="text-small text-danger">','</span>') ?>
      	</div>

      	<div class="form-group">
      	<label>Alamat</label>
      	<input type="text" name="alamat" class="form-control">
      	<?php echo form_error('alamat','<span class="text-small text-danger">','</span>') ?>	
      	</div>

      	<div class="form-group">
      		<label>Jenis Kelamin</label>
      		<select class="form-control" name="jenis_kelamin">
      			<option value="">--Pilih Jenis Kelamin--</option>
      			<option value="Laki-laki">Laki-laki</option>
      			<option value="Perempuan">Perempuan</option>
      		</select>
      	<?php echo form_error('jenis_kelamin','<span class="text-small text-danger">','</span>') ?>
      	</div>

      	<div class="form-group">
      	<label>No Telepon</label>
      	<input type="number" name="no_telepon" class="form-control">
      	<?php echo form_error('no_telepon','<span class="text-small text-danger">','</span>') ?>	
      	</div>

      	<div class="form-group">
      	<label>No Identitas</label>
      	<input type="number" name="no_identitas" class="form-control">
      	<?php echo form_error('no_identitas','<span class="text-small text-danger">','</span>') ?>	
      	</div>

      	<div class="form-group">
      	<label>Password</label>
      	<input type="password" name="password" class="form-control">
      	<?php echo form_error('password','<span class="text-small text-danger">','</span>') ?>	
      	</div>

      	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
      	<button type="submit" class="btn btn-sm btn-danger">Reset</button>

      </form>
</div>