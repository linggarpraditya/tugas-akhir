<?php

class Dashboard extends CI_Controller
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
		if ($role_id == '1') {
			$data['jumlahmobil'] = $this->Dashboard_model->hitungjumlahmobil();
			$data['jumlahcustomer'] = $this->Dashboard_model->hitungjumlahcustomer(); //memanggil query untuk mengetahui berapa jumlah customer 
			$data['jumlahadmin'] = $this->Dashboard_model->hitungjumlahadmin();

			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/dashboard', $data);
			$this->load->view('templates_admin/footer');
		} else {

			redirect('auth', 'refresh');
		}
	}
}
