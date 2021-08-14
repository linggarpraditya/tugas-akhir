<?php

/**
 * 
 */
class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{

		$path = "./assets/captcha/";
		if (!file_exists($path)) {
			$buat = mkdir($path, @777);
			if (!$buat) {
				return;
			}
		}
		$kata = array_merge(range('0', '9'));
		$acak = shuffle($kata);
		$str = substr(implode($kata), 0, 5);
		$data_ses = array('captcha_str' => $str);
		$this->session->set_userdata($data_ses);

		$vals = array(
			'word' => $str,
			'img_path' => $path,
			'font_size' => '48',
			'img_url' => base_url() . 'assets/captcha/',
			'img_width' => '222',
			'img_height' => 55,
			'expiration' => 7200
		);
		$capc = create_captcha($vals);
		$tmp['captcha_image'] = $capc['image'];
		$this->load->view('templates_admin/header');
		$this->load->view('form_login', $tmp);
		$this->load->view('templates_admin/footer');
	}


	public function login()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates_admin/header');
			$this->load->view('form_login');
			$this->load->view('templates_admin/footer');
		} else {
			$username	= $this->input->post('username');
			$password	= md5($this->input->post('password'));
			$po_captcha = $this->input->post('captcha');

			$cek	= $this->rental_model->cek_login($username, $password);

			$po_captcha = $this->input->post('captcha');
			if ($po_captcha != $this->session->userdata('captcha_str')) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">Captcha Salah</div>');
				redirect('auth/index');
			} else {
				if ($cek == FALSE) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Username atau Password Salah !.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');

					redirect('auth/index', 'refresh');
				} else {

					$this->session->set_userdata('id_customer', $cek->id_customer);
					$this->session->set_userdata('username', $cek->username);
					$this->session->set_userdata('role_id', $cek->role_id);
					$this->session->set_userdata('nama', $cek->nama);

					switch ($cek->role_id) {
						case 1:
							redirect('admin/dashboard');
							break;

						case 2:
							redirect('customer/dashboard');
							break;
						case 3:
							redirect('admin/laporan');
							break;

						default:
							break;
					}
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function ganti_password()
	{
		$this->load->view('templates_admin/header');
		$this->load->view('change_password');
		$this->load->view('templates_admin/footer');
	}

	public function ganti_password_aksi()
	{
		$pass_baru	= $this->input->post('pass_baru');
		$ulang_pass	= $this->input->post('ulang_pass');

		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass', 'Ulang Password', 'required');

		if ($this->form_validation->run() != false) {
			$data = array('password' => md5($pass_baru));
			$id = array('id_customer' => $this->session->userdata('id_customer'));
			$this->rental_model->update_password($id, $data, 'customer');
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				Password Berhasil Diupdate, Silahkan Login !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/login');
		} else {
			$this->load->view('templates_admin/header');
			$this->load->view('change_password');
			$this->load->view('templates_admin/footer');
		}
	}


	public function sopir()
	{

		$path = "./assets/captcha/";
		if (!file_exists($path)) {
			$buat = mkdir($path, @777);
			if (!$buat) {
				return;
			}
		}
		$kata = array_merge(range('0', '9'));
		$acak = shuffle($kata);
		$str = substr(implode($kata), 0, 5);
		$data_ses = array('captcha_str' => $str);
		$this->session->set_userdata($data_ses);

		$vals = array(
			'word' => $str,
			'img_path' => $path,
			'font_size' => '48',
			'img_url' => base_url() . 'assets/captcha/',
			'img_width' => '222',
			'img_height' => 55,
			'expiration' => 7200
		);
		$capc = create_captcha($vals);
		$tmp['captcha_image'] = $capc['image'];
		$this->load->view('templates_admin/header');
		$this->load->view('form_login_sopir', $tmp);
		$this->load->view('templates_admin/footer');
	}


	public function login_sopir()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->login_sopir();
		} else {
			$username	= $this->input->post('username');
			$password	= md5($this->input->post('password'));
			$po_captcha = $this->input->post('captcha');

			$result		= $this->db
				->where('username', $username)
				->where('password', $password)
				->limit(1)
				->get('sopir');

			if ($result->num_rows() > 0) {
				$cek	= $result->row();
			} else {
				$cek	= FALSE;
			}

			$po_captcha = $this->input->post('captcha');
			if ($po_captcha != $this->session->userdata('captcha_str')) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">Captcha Salah</div>');
				redirect('auth/sopir');
			} else {
				if ($cek == FALSE) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Username atau Password Salah !.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');

					redirect('auth/sopir', 'refresh');
				} else {
					$this->session->set_userdata('id_sopir', $cek->id_sopir);
					$this->session->set_userdata('username', $cek->username);
					$this->session->set_userdata('nama_sopir', $cek->nama_sopir);

					redirect('sopir');
				}
			}
		}
	}
}
