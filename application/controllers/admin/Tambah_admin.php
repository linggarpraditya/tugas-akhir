<?php 

class tambah_admin extends CI_Controller{


	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}
	}

	public function index()
	{

		$role_id = $this->session->userdata('role_id');
		if($role_id == '1')
		{
			$data['admin'] = $this->rental_model->get_data('admin')->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/tambah_admin',$data);
			$this->load->view('templates_admin/footer');
		}
		else{

			redirect('auth','refresh');
		}
	}

	public function tambah_admin()
	{
		$data['admin'] = $this->rental_model->get_data('admin')->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/tambah_admin',$data);
		$this->load->view('templates_admin/footer');
	}
	public function tambah_admin_aksi()
	{
		$this->_rules();
		if($this->form_validation->run() == FALSE)
		{
			$this->tambah_admin();
		}else{
			$nama					= $this->input->post('nama');
			$username				= $this->input->post('username');
			$password				= md5($this->input->post('password'));
			$jenis_kelamin			= $this->input->post('jenis_kelamin');
			$no_telepon				= $this->input->post('no_telepon');
			$role_id				= '1';

			$data = array (
				'nama'			=> $nama,
				'username'		=> $username,
				'password'		=> $password,
				'jenis_kelamin'	=> $jenis_kelamin,
				'no_telepon'	=> $no_telepon,
				'role_id'		=> $role_id
			);

			$this->rental_model->insert_data($data,'customer');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> ditambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/dashboard');
		}

	}
	public function _rules()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('no_telepon','No Telepon','required');
		$this->form_validation->set_rules('password','Password','required');
	}
}

?>