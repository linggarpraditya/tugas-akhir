<?php 
class Data_gambar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}
	}
	
	function index()
	{
		$role_id = $this->session->userdata('role_id');
		if($role_id == '1')
		{
			$data['mobil']= $this->rental_model->get_data_mobil();
			$data['gambar']= $this->rental_model->get_data('gambar')->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/data_gambar',$data);
			$this->load->view('templates_admin/footer');
		}

		else{

			redirect('auth','refresh');
		}
	}

	public function tambah_gambar()
	{
		$data['mobil']= $this->rental_model->get_data('mobil')->result();
		$data['gambar']= $this->rental_model->get_data('gambar')->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_gambar',$data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_gambar_aksi()
	{
		$this->_rules();
		if($this->form_validation->run() == FALSE)
		{
			$this->tambah_gambar();
		}else{
			$id_mobil	= $this->input->post('id_mobil');
			$gambar		= $_FILES['gambar']['name'];
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

			$data = array (
				'id_mobil'	=> $id_mobil,
				'gambar'	=> $gambar
			);

			$this->rental_model->insert_data($data,'gambar');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> ditambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_gambar');
		}

	}

	public function delete_gambar($id){
		$where = array('id_gambar' => $id);
		$this->rental_model->delete_data($where,'gambar');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> diHapus!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/data_gambar');
	}





	public function _rules()
	{
		$this->form_validation->set_rules('id_mobil','Id Mobil','required');
	}

}
?>