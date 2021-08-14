<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller{


	
	function __construct(){
		parent::__construct();
		$this->load->model('Package_model','package_model');


		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}
	}

	// READ
	function index(){

		$role_id = $this->session->userdata('role_id');
		if($role_id == '1')
		{

			$data['product'] = $this->package_model->get_products();
			$data['package'] = $this->package_model->get_packages();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/package_view',$data);
		// $this->load->view('templates_admin/footer');
		}
		else
		{

			redirect('auth','refresh');
		}


	}



	//CREATE
	function create(){
		$package = $this->input->post('package',TRUE);
		$harga_paket = $this->input->post('harga_paket',TRUE);
		$product = $this->input->post('product',TRUE);
		$foto		= $_FILES['foto']['name'];
		if ($foto='') {}else{
			$config ['upload_path']		='./assets/upload';
			$config ['allowed_types']	='jpg|jpeg|png|tiff';

			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('foto')){
				echo "Gambar Gagal di Upload !";
			}else{
				$foto=$this->upload->data('file_name');
			}
		}
		$data = array(

			'foto'			=> $foto
		);
		$this->package_model->create_package($package,$product,$harga_paket,$foto);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> ditambahkan !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/package');
	}



	public function tambah_paket_aksi()
	{
		

		$nama_destinasi		= $this->input->post('nama_destinasi');
		$gambar			= $_FILES['gambar']['name'];

		if ($gambar='') {}else{
			$config ['upload_path']		='./assets/upload';
			$config ['allowed_types']	='jpg|jpeg|png|tiff';

			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('gambar')){
				echo "Gambar Gagal di Upload !";
			}else{
				$gambar=$this->upload->data('file_name');
			}
		}
		$data = array(
			'nama_destinasi'		=> $nama_destinasi,
			'gambar'			=> $gambar
		);
		$this->rental_model->insert_data($data,'paket_tour');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> ditambahkan !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/paket_tour');
		
	}

	function get_product_by_package(){
		$package_id=$this->input->post('package_id');
		$data=$this->package_model->get_product_by_package($package_id)->result();
		foreach ($data as $result) {
			$value[] = (float) $result->product_id;
		}
		echo json_encode($value);
	}

	//UPDATE
	function update(){
		$id = $this->input->post('edit_id',TRUE);
		$package = $this->input->post('package_edit',TRUE);
		$product = $this->input->post('product_edit',TRUE);
		$harga_paket = $this->input->post('harga_paket_edit',TRUE);
		
		$this->package_model->update_package($id,$package,$product,$harga_paket,$foto);
		redirect('admin/package');
	}

	
	function delete(){
		$id = $this->input->post('delete_id',TRUE);
		$this->package_model->delete_package($id);
		redirect('admin/package');
	}

	public function detail($id=0){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$data_now = $this->Package_model->get_detail($id);
			if(count($data_now) > 0){
				$this->Package_model->update($id);
				
				redirect('admin/package','refresh');

			}
		}
		$data_now = $this->Package_model->get_detail($id);

		$data['bawa'] = $this->Package_model->get_detail($id);


		// $tmp['contents'] = $this->load->view('admin/dashboard/home', null, true);
		$this->load->view('templates_customer/header');
		$tmp['contents'] = $this->load->view('admin/paket_detail', $data);
		$this->load->view('templates_customer/footer');
		
		
	}
	
}