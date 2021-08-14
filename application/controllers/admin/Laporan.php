<?php

/**
 * 
 */
class Laporan extends CI_Controller
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
		if ($role_id == '1' or $role_id == '3') {

			$dari = $this->input->post('dari');
			$sampai = $this->input->post('sampai');
			$this->_rules();
			if ($this->form_validation->run() == FALSE) {
				$data['transaksi'] = $this->db->query("SELECT * 
				FROM transaksi tr, mobil mb, customer cs
				WHERE tr.id_mobil=mb.id_mobil
				AND tr.id_customer=cs.id_customer
				AND status_mitra='perusahaan'
				")->result();
				$data['mitra'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='mitra'")->result();
				$this->load->view('templates_admin/header');
				$this->load->view('templates_admin/sidebar');
				$this->load->view('admin/filter_laporan', $data);
				$this->load->view('templates_admin/footer');
			} else {

				$data['laporan'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil = mb.id_mobil AND tr.id_customer=cs.id_customer AND date(tgl_rental) >= '$dari' AND date(tgl_rental) >= '$sampai'
				AND status_pembayaran=1
				AND status_rental = 'Selesai'
				")->result();

				$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='perusahaan'
				AND status_rental = 'Selesai'")->result();

				$data['mitra'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='mitra'")->result();

				$pie_mobil =  $this->db->select('count(transaksi.id_mobil) as jumlah_mobil,mobil.merk')
					->join('mobil', 'transaksi.id_mobil = mobil.id_mobil')
					->where('status_rental', 'Selesai')
					->where("tgl_rental between '$dari' AND '$sampai' ")
					->group_by('transaksi.id_mobil')
					->get('transaksi')->result();

				$data['pie_mobil'] = $pie_mobil;


				$this->load->view('templates_admin/header');
				$this->load->view('templates_admin/sidebar');
				$this->load->view('admin/tampilkan_laporan', $data);
				$this->load->view('templates_admin/footer');
			}
		} else {

			redirect('auth', 'refresh');
		}
	}

	public function print_laporan()
	{
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');
		$data['title'] = "Print Laporan Transaksi";
		$data['laporan'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil = mb.id_mobil AND tr.id_customer=cs.id_customer AND date(tgl_rental) >= '$dari' AND date(tgl_rental) >= '$sampai'
		AND status_pembayaran=1
		AND status_rental = 'Selesai'")->result();
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='perusahaan'
				AND status_pembayaran=1
				AND status_rental = 'Selesai'")->result();
		$data['mitra'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='mitra'")->result();

		$this->load->view('templates_admin/header');
		$this->load->view('admin/print_laporan', $data);
	}

	public function print_laporan_paket()
	{
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');
		$data['title'] = "Print Laporan Transaksi";
		$data['laporan'] = $this->db->query("SELECT * FROM transaksi_paket tr, package pb, customer cs WHERE tr.package_id = pb.package_id AND tr.id_customer=cs.id_customer AND date(package_created_at) >= 'dari' AND date(package_created_at) >= 'sampai'AND status = '1'")->result();

		$this->load->view('templates_admin/header');
		$this->load->view('admin/print_laporan_paket', $data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('dari', 'Dari Tanggal', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai Tanggal', 'required');
	}


	public function excel()
	{
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$query = $this->db->join('mobil', 'transaksi.id_mobil = mobil.id_mobil')
			->join('customer', 'transaksi.id_customer = customer.id_customer')
			->where('status_rental', 'Selesai')
			->where("tgl_pengembalian BETWEEN '$dari' AND '$sampai'")
			->get('transaksi')->result();

		$filename = 'Laporan';

		header("Content-type: application/vnd-ms-excel");

		header("Content-Disposition: attachment; filename=$filename.xls");

		header("Pragma: no-cache");

		header("Expires: 0");

		$data = [
			'query' => $query
		];
		$this->load->view('admin/laporan/excel', $data);
	}
}
