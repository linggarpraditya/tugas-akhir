<?php

/**
 * 
 */
class Transaksi extends CI_controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}

		// Your own constructor code
		$params = array('server_key' => 'SB-Mid-server-8N7U6SWsKKbyK7fs_nj4BAh1', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);

		$params = array('server_key' => 'SB-Mid-server-8N7U6SWsKKbyK7fs_nj4BAh1', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
	}


	public function index()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == '1') {


			$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='perusahaan'")->result();
			$data['mitra'] = $this->db->query("SELECT * FROM transaksi tr,
				mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
				AND tr.id_customer=cs.id_customer AND status_mitra='mitra'")->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/data_transaksi', $data);
			$this->load->view('templates_admin/footer');
		} else {

			redirect('auth', 'refresh');
		}
	}

	public function pembayaran($id)
	{
		$where = array('id_rental'	=> $id);
		$data['pembayaran'] = $this->db->query("SELECT * FROM transaksi WHERE id_rental='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/konfirmasi_pembayaran', $data);
		$this->load->view('templates_admin/footer');
	}
	public function cek_pembayaran()
	{
		$id 				= $this->input->post('id_rental');
		$status_pembayaran	= $this->input->post('status_pembayaran');

		$data = array(
			'status_pembayaran'	=> $status_pembayaran,
		);
		$where = array(
			'id_rental'	=> $id
		);
		$this->rental_model->update_data('transaksi', $data, $where);
		redirect('admin/transaksi');
	}

	public function download_pembayaran($id)
	{
		$this->load->helper('download');
		$filePembayaran = $this->rental_model->downloadPembayaran($id);
		$file = 'assets/upload/' . $filePembayaran['bukti_pembayaran'];
		force_download($file, NULL);
	}
	public function transaksi_selesai($id)
	{
		$where = array('id_rental' => $id);
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi WHERE id_rental='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/transaksi_selesai', $data);
		$this->load->view('templates_admin/footer');
	}
	public function transaksi_selesai_aksi()
	{
		$id 						= $this->input->post('id_rental');
		$tgl_pengembalian 			= $this->input->post('tgl_pengembalian');
		$status_rental				= $this->input->post('status_rental');
		$status_pengembalian		= $this->input->post('status_pengembalian');
		$tgl_kembali				= $this->input->post('tgl_kembali');
		$denda						= $this->input->post('denda');

		$x							= strtotime($tgl_pengembalian);
		$y							= strtotime($tgl_kembali);
		$selisih					= abs($x - $y) / (60 * 60 * 24);
		$total_denda				= $selisih * $denda;


		$data = array(
			'tgl_pengembalian'		=> $tgl_pengembalian,
			'status_rental'			=> $status_rental,
			'status_pengembalian'	=> $status_pengembalian,
			'total_denda'			=> $total_denda
		);
		$where = array(
			'id_rental'				=> $id
		);
		$this->rental_model->update_data('transaksi', $data, $where);

		$transaksi = $this->db->where('id_rental', $id)->get('transaksi')->row();
		$id_mobil = $transaksi->id_mobil;
		if ($status_rental == 'Selesai') {
			$this->db->where('id_mobil', $id_mobil)->update('mobil', ['status' => 'Tersedia']);
		} else {
			$this->db->where('id_mobil', $id_mobil)->update('mobil', ['status' => '0']);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Transaksi <strong>Berhasil!</strong> diUpdate !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/transaksi');
	}

	public function transaksi_batal($id)
	{
		$where = array('id_rental' => $id);
		$data  = $this->rental_model->get_where($where, 'transaksi')->row();
		$where2 = array('id_mobil' => $data->id_mobil);
		$data2 = array('status' => 'Tersedia');
		$this->rental_model->update_data('mobil', $data2, $where2);
		$this->rental_model->delete_data($where, 'transaksi');

		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Transaksi Berhasil!dibatalkan !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/transaksi');
	}
	public function tracking($id_rental = null)
	{
		$transaksi = $this->db->where('id_rental', $id_rental)->get('transaksi')->row();
		$data = [
			'transaksi' => $transaksi
		];

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/tracking', $data);
		$this->load->view('templates_admin/footer');
	}
	public function get_lokasi($id_rental = null)
	{
		$transaksi = $this->db->where('id_rental', $id_rental)->get('transaksi')->row();
		if (!$transaksi) {
			$this->output->set_status_header(400);
			echo json_encode([
				'error' => 'Data tidak ditemukan'
			]);
			die;
		}
		$this->output->set_status_header(200);
		echo json_encode([
			'message' => 'Berhasil mengubah lokasi',
			'data' => $transaksi
		]);
		die;
	}
}
