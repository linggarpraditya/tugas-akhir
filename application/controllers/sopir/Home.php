<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_sopir')) {
			redirect('auth/sopir');
		}
	}

	public function index()
	{
		$data = [];

		$this->load->view('templates_sopir/header');
		$this->load->view('templates_sopir/sidebar');
		$this->load->view('sopir/home', $data);
		$this->load->view('templates_sopir/footer');
	}
}
        
    /* End of file  sopir/Home.php */
