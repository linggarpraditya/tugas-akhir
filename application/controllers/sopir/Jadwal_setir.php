<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_setir extends CI_Controller
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
		$q = $this->input->get('q');

		$jadwal = $this->db->join('customer', 'transaksi.id_customer = customer.id_customer')
			->where('id_sopir', $this->session->userdata('id_sopir'))
			->where('status_rental', 'Belum selesai')
			->group_start()
			->like('nama', $q)
			->or_like('tgl_rental', $q)
			->group_end()
			->get('transaksi')->result();

		$data = [
			'jadwal' => $jadwal,
			'q' => $q
		];
		$this->load->view('templates_sopir/header');
		$this->load->view('templates_sopir/sidebar');
		$this->load->view('sopir/jadwal_setir/list', $data);
		$this->load->view('templates_sopir/footer');
	}
	public function setir($id_rental = null)
	{
		$transaksi = $this->db->where('id_sopir', $this->session->userdata('id_sopir'))->where('id_rental', $id_rental)->get('transaksi')->row();
		$data = [
			'transaksi' => $transaksi,
		];
		$this->load->view('templates_sopir/header');
		$this->load->view('templates_sopir/sidebar');
		$this->load->view('sopir/jadwal_setir/setir', $data);
		$this->load->view('templates_sopir/footer');
	}
	public function setir_aksi($id_rental = null)
	{
		$this->form_validation->set_rules('lat', 'lat', 'trim|required');
		$this->form_validation->set_rules('long', 'long', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400);
			echo json_encode([
				'error' => validation_errors()
			]);
			die;
		} else {
			$transaksi = $this->db->where('id_sopir', $this->session->userdata('id_sopir'))->where('id_rental', $id_rental)->get('transaksi')->row();
			if (!$transaksi) {
				$this->output->set_status_header(400);
				echo json_encode([
					'error' => 'Data tidak ditemukan'
				]);
				die;
			}

			$lat = $this->input->post('lat');
			$long = $this->input->post('long');

			$cek = $this->db->where('id_rental', $id_rental)->update('transaksi', [
				'lat' => $lat,
				'long' => $long,
			]);
			if (!$cek) {
				$this->output->set_status_header(400);
				echo json_encode([
					'error' => 'Data tidak ditemukan'
				]);
				die;
			} else {
				$this->output->set_status_header(200);
				echo json_encode([
					'message' => 'Berhasil mengubah lokasi'
				]);
				die;
			}
		}
	}
}
        
    /* End of file  sopir/Jadwal_setir.php */
