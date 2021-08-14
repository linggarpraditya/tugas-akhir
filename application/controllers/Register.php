<?php

class Register extends CI_Controller
{
	public function index()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates_admin/header');
			$this->load->view('register_form');
			$this->load->view('templates_admin/footer');
		} else {
			$nama					= $this->input->post('nama');
			$email					= $this->input->post('email');
			$username				= $this->input->post('username');
			$alamat					= $this->input->post('alamat');
			$jenis_kelamin			= $this->input->post('jenis_kelamin');
			$no_telepon				= $this->input->post('no_telepon');
			$no_identitas			= $this->input->post('no_identitas');
			$password				= md5($this->input->post('password'));
			$role_id				= '2';

			$data = array(
				'nama'			=> $nama,
				'email'			=> $email,
				'username'		=> $username,
				'alamat'		=> $alamat,
				'jenis_kelamin'	=> $jenis_kelamin,
				'no_telepon'	=> $no_telepon,
				'no_identitas'	=> $no_identitas,
				'password'		=> $password,
				'role_id'		=> $role_id
			);
			$this->rental_model->insert_data($data, 'customer');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				 Registrasi Telah <strong>Berhasil!</strong> ,Silahkan Login!.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('customer/dashboard');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
		$this->form_validation->set_rules('no_identitas', 'No Identitas', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}
}
