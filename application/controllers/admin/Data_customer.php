<?php 
class Data_customer extends CI_Controller
{
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

			$data['customer'] = $this->rental_model->get_data('customer')->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/data_customer',$data);
			$this->load->view('templates_admin/footer'); 
		}

		else{

			redirect('auth','refresh');
		}
	}

	public function tambah_customer()
	{
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_customer');
		$this->load->view('templates_admin/footer'); 
	}

	public function tambah_customer_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambah_customer();
		}else{
			$nama					= $this->input->post('nama');
			$username				= $this->input->post('username');
			$alamat					= $this->input->post('alamat');
			$jenis_kelamin			= $this->input->post('jenis_kelamin');
			$no_telepon				= $this->input->post('no_telepon');
			$no_identitas			= $this->input->post('no_identitas');
			$password				= md5($this->input->post('password'));

			$data = array (
				'nama'			=> $nama,
				'username'		=> $username,
				'alamat'		=> $alamat,
				'jenis_kelamin'	=> $jenis_kelamin,
				'no_telepon'	=> $no_telepon,
				'no_identitas'	=> $no_identitas,
				'password'		=> $password
			);
			$this->rental_model->insert_data($data,'customer');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> Tambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_customer');
		}
	}

	public function update_customer($id)
	{
		$where = array('id_customer' => $id);
		$data['customer'] = $this->db->query("SELECT* FROM customer WHERE id_customer = '$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_customer',$data);
		$this->load->view('templates_admin/footer'); 
	}

	public function update_customer_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_customer();
		}else{
			$id 					= $this->input->post('id_customer');
			$nama					= $this->input->post('nama');
			$username				= $this->input->post('username');
			$alamat					= $this->input->post('alamat');
			$jenis_kelamin			= $this->input->post('jenis_kelamin');
			$no_telepon				= $this->input->post('no_telepon');
			$no_identitas			= $this->input->post('no_identitas');
			$password				= md5($this->input->post('password'));

			$data = array (
				'nama'			=> $nama,
				'username'		=> $username,
				'alamat'		=> $alamat,
				'jenis_kelamin'	=> $jenis_kelamin,
				'no_telepon'	=> $no_telepon,
				'no_identitas'	=> $no_identitas,
				'password'		=> $password
			);
			$where = array(
				'id_customer'	=> $id
			);
			$this->rental_model->update_data('customer',$data,$where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> Di update !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_customer');
		}
	}

	public function delete_customer($id)
	{
		$where = array('id_customer' => $id);
		$this->rental_model->delete_data($where, 'customer');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> Dihapus !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button></div>');
		redirect('admin/data_customer');

	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('no_telepon','No Telepon','required|numeric');
		$this->form_validation->set_rules('no_identitas','No Identitas','required');
		$this->form_validation->set_rules('password','Password','required');
	}
} 

?>