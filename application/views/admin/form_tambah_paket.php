<div class="main-content">
      <section class="section">
          <div class="section-header mt-3">
            <h4 style="font-family: calibri; color: black">Tambah Paket Tour</h4>
          </div>

          		<form method="POST" action="<?php echo base_url('admin/paket_tour/add') ?>" enctype="multipart/form-data">
          		<div class="row">
          			<div class="col-md-6">
          				<div class="form-group">
          					<label>Nama Destinasi</label>
          					<input type="text" name="nama_destinasi" class="form-control">
          					<?php echo form_error('nama_destinasi','<div class="text-small 
          					text-danger">','</div>') ?>
          				</div>
          

          				<div class="form-group">
          					<label>Gambar</label>
          					<input type="file" name="gambar" class="form-control">
          				</div>

          				<button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" class="btn btn-danger ml-2">Reset</button>
          			</div>
          			
          		</div>
          	</form>
      

      </section>
    </div>
