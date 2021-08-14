<!DOCTYPE html>
<html>
<head>
	<title>Package</title>
	<!--Load CSS File-->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css');?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css');?>">
</head>
<body>

	<div class="main-content">
		<section class="section">
			<div class="section-header mt-3">

				<div class="container">
					<h4 style="font-family: calibri; color: black">Tambah Paket Tour</h4>
					<button type="button" class="btn btn-success btn-sm mt-3 mb-3" data-toggle="modal" data-target="#addNewModal"><i class="fas fa-user-plus"></i> Tambah Paket Tour</button><br>
					<?php echo $this->session->flashdata('pesan') ?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Gambar</th>
								<th>Nama Paket</th>
								<th>Booking</th>
								<th>Destinasi</th>
								<th>Harga Paket</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$count=0;
							foreach ($package->result() as $row) :
								$count++;
								?>
								<tr>
									<td><?php echo $count;?></td>
									<td>
										<img width="60px" src="<?php echo base_url().'assets/upload/'. $row->foto ?>">   
									</td>
									<td><?php echo $row->package_name;?></td>
									<td><?php echo $row->package_created_at;?></td>
									<td><?php echo $row->item_product.' Items';?></td>
									<td><?php echo $row->harga_paket;?></td>



									<!-- disini increment harga=harga+harga -->
									<td>
										<a href="<?php echo base_url('admin/package/detail/'). $row->package_id?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
										<a href="" class="btn btn-info btn-sm update-record" data-package_id="<?php echo $row->package_id;?>" data-package_name="<?php echo $row->package_name;?>" data-package_harga="<?php echo $row->harga_paket;?>"><i class="fas fa-edit"></i></a>
										<a href="#" class="btn btn-danger btn-sm delete-record" data-package_id="<?php echo $row->package_id;?>"><i class="fas fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach;?>

						</tbody>

					</table>
				</div>
			</div>
		</section>
	</div>

	

	<!-- Modal Add New Package-->
	<form action="<?php echo site_url('admin/package/create');?>" method="post" enctype="multipart/form-data">
		<div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Paket</label>
							<div class="col-sm-10">
								<input type="text" name="package" class="form-control" placeholder="Nama Paket" required>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Harga</label>
							<div class="col-sm-10">
								<input type="text" name="harga_paket" class="form-control" placeholder="Harga Paket" required>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Gambar</label>
							<div class="col-sm-10">
								<input type="file" name="foto" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Pilih Destinasi</label>
							<div class="col-sm-10">
								<select class="bootstrap-select" name="product[]" data-width="100%" data-live-search="true" multiple required>
									<?php foreach ($product->result() as $row) :?>
										<option value="<?php echo $row->id_paket;?>"><?php echo $row->nama_destinasi;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<!-- Modal Update Package-->
	<form action="<?php echo site_url('admin/package/update');?>" method="post">
		<div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Paket Tour</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Paket</label>
							<div class="col-sm-10">
								<input type="text" name="package_edit" class="form-control" placeholder="Package Name" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Paket</label>
							<div class="col-sm-10">
								<input type="text" name="package_edit2" class="form-control" placeholder="Package Name" required>
							</div>
						</div>
						
						

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Pilih Destinasi</label>
							<div class="col-sm-10">
								<select class="bootstrap-select strings" name="product_edit[]" data-width="100%" data-live-search="true" multiple required>
									<?php foreach ($product->result() as $row) :?>
										<option value="<?php echo $row->id_paket;?>"><?php echo $row->nama_destinasi;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<input type="hidden" name="edit_id" required>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Update</button>
					</div>
				</div>
			</div>
		</div>
	</form>


	<!-- Modal Delete Package-->
	<form action="<?php echo site_url('admin/package/delete');?>" method="post">
		<div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<p class="modal-title" id="exampleModalLabel">Hapus Data</p>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<h5>Apakah kamu yakin untuk menghapus ?</h5>

					</div>
					<div class="modal-footer">
						<input type="hidden" name="delete_id" required>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-success btn-sm">Yes</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<!--Load JavaScript File-->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js');?>"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.bootstrap-select').selectpicker();

			//GET UPDATE
			$('.update-record').on('click',function(){
				var package_id = $(this).data('package_id');
				var package_name = $(this).data('package_name');
				var harga_paket = $(this).data('package_harga');

				$(".strings").val('');
				$('#UpdateModal').modal('show');
				$('[name="edit_id"]').val(package_id);
				$('[name="package_edit"]').val(package_name);
				$('[name="package_edit2"]').val(harga_paket);

				$.ajax({
					url: "<?php echo site_url('admin/package/get_product_by_package');?>",
					method: "POST",
					data :{package_id:package_id},
					cache:false,
					success : function(data){
						var item=data;
						var val1=item.replace("[","");
						var val2=val1.replace("]","");
						var values=val2;
						$.each(values.split(","), function(i,e){
							$(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
							$(".strings").selectpicker('refresh');

						});
					}

				});
				return false;
			});

			//GET CONFIRM DELETE
			$('.delete-record').on('click',function(){
				var package_id = $(this).data('package_id');
				$('#DeleteModal').modal('show');
				$('[name="delete_id"]').val(package_id);
			});

		});
	</script>
</body>
</html>