<?php 

/**
 * 
 */
class Transaksi_paket extends CI_controller
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

			
			$data['transaksi'] = $this->db->query("SELECT * FROM transaksi_paket tr,
				package mb, customer cs WHERE tr.package_id=mb.package_id 
				AND tr.id_customer=cs.id_customer")->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/transaksi_paket',$data);
			$this->load->view('templates_admin/footer');
		}else

		{

			redirect('auth','refresh');
		}
	}

	public function pembayaran($id)
	{
		$where = array('id_transaksi_paket'	=>$id);
		$data['pembayaran'] = $this->db->query("SELECT * FROM transaksi_paket WHERE id_transaksi_paket='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/konfirmasi_pembayaran_paket',$data);
		$this->load->view('templates_admin/footer');
	}



	public function cek_pembayaran()
	{

		$status_pembayaran=='0';
		$id 				= $this->input->post('id_transaksi_paket');
		$status_pembayaran	= $this->input->post('status_pembayaran');



		$data= array(
			'status'	=> $status_pembayaran,
		);
		$where = array(
			'id_transaksi_paket'	=> $id
		);
		$this->rental_model->update_data('transaksi_paket',$data,$where);
		redirect('admin/transaksi_paket');
	}

	public function download_pembayaran($id)
	{
		$this->load->helper('download');
		$filePembayaran = $this->rental_model->downloadPembayaranpaket($id);
		$file = 'assets/upload/'.$filePembayaran['bukti'];
		force_download($file, NULL);
	}
	public function transaksi_selesai($id)
	{
		$where = array('id_transaksi_paket' => $id);
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi_paket WHERE id_transaksi_paket='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/transaksi_selesai',$data);
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
		$selisih					= abs($x - $y)/(60*60*24);
		$total_denda				= $selisih * $denda;


		$data = array(
			'tgl_pengembalian'		=> $tgl_pengembalian,
			'status_rental'			=> $status_rental,
			'status_pengembalian'	=> $status_pengembalian,
			'total_denda'			=> $total_denda
		);
		$where = array(
			'id_rental'				=>$id
		); 
		$this->rental_model->update_data('transaksi',$data, $where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			Transaksi <strong>Berhasil!</strong> diUpdate !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/transaksi');
	}

	public function batal_transaksi($id)
	{
		$where = array('package_id' =>$id);
		$this->rental_model->delete_data($where,'transaksi');

		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			Transaksi Berhasil!dibatalkan !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/transaksi_paket');
	}

}

?>