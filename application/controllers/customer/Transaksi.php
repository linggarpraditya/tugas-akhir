<?php

/**
 * 
 */
class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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
		$customer = $this->session->userdata('id_customer');
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr,
		 mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
		 AND tr.id_customer=cs.id_customer AND cs.id_customer='$customer' ORDER BY id_rental DESC")->result();

		$data['transaksi_paket'] = $this->db->query("SELECT * FROM transaksi_paket tr,
		 package mb, customer cs WHERE tr.package_id=mb.package_id 
		 AND tr.id_customer=cs.id_customer AND cs.id_customer='$customer' ORDER BY id_transaksi_paket DESC")->result();

		$this->load->view('templates_customer/header');
		$this->load->view('customer/transaksi', $data);
		$this->load->view('templates_customer/footer');
	}

	public function pembayaran($id)
	{

		$value = $this->db->where('id_rental', $id)->join('mobil', 'transaksi.id_mobil = mobil.id_mobil')
			->join('customer', 'transaksi.id_customer = customer.id_customer')->get('transaksi')->row();
		$data['transaksi'] = $value;
		$data['id'] = $id;


		$item = [];
		$total_biaya = 0;
		// foreach ($transaksi as $key => $value) {
		$x = strtotime($value->tgl_kembali);
		$y = strtotime($value->tgl_rental);
		$jmlhari = abs(($x - $y) / (60 * 60 * 24)) ?: 1;

		// echo "<pre>";
		// print_r($jmlhari ?: 1);
		// echo "</pre>";
		// die;
		$total_biaya = $value->harga * $jmlhari;
		$item[] = [
			'id' => $value->id_mobil,
			'price' => $value->harga,
			'quantity' => $jmlhari,
			'name' => $value->merk
		];


		// ------------------------------------------------------------------------

		$customer_details = array(
			'first_name'    => $value->nama,
			// 'last_name'     => "Litani",
			'email'         => $value->email,
			'phone'         => $value->no_telepon,
		);
		// }

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $total_biaya, // no decimal allowed for creditcard
		);


		// // Optional
		// $billing_address = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'address'       => "Mangga 20",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16602",
		// 	'phone'         => "081122334455",
		// 	'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		// 	'first_name'    => "Obet",
		// 	'last_name'     => "Supriadi",
		// 	'address'       => "Manggis 90",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16601",
		// 	'phone'         => "08113366345",
		// 	'country_code'  => 'IDN'
		// );

		// // Optional
		// $customer_details = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'email'         => "andri@litani.com",
		// 	'phone'         => "081122334455",
		// 	'billing_address'  => $billing_address,
		// 	'shipping_address' => $shipping_address
		// );

		// Fill transaction details
		$transaction = array(
			'transaction_details' => $transaction_details,
			'customer_details' => $customer_details,
			'item_details' => $item,
			"callbacks" => [
				"finish" => site_url('customer/transaksi/handletransaksimidtrans/' . $id),
			],
		);
		//error_log(json_encode($transaction));
		$snapToken = $this->midtrans->getSnapToken($transaction);

		$data['token'] = $snapToken;
		$this->load->view('templates_customer/header');
		$this->load->view('customer/pembayaran', $data);
		$this->load->view('templates_customer/footer');
	}

	public function handletransaksimidtrans($id)
	{
		$order_id = $this->input->get('order_id');
		$cek = $this->db->where('id_rental', $id)->update('transaksi', [
			'id_midtrans' => $order_id,
		]);

		redirect('customer/transaksi/pembayaran/' . $id);
	}
	public function transaksi_selesai($id)
	{
		$cek = $this->db->where('id_rental', $id)->update('transaksi', [
			// 'status_rental' 		=> 'Selesai',
			'status_pembayaran'		=> 1,
		]);

		$data_transaksi = $this->db->where('id_rental', $id)->get('transaksi')->row();
		$this->db->where('id_mobil', $data_transaksi->id_mobil)->update('mobil', ['status' => '0']);

		redirect('customer/transaksi/pembayaran/' . $id);
	}

	public function pembayaran_paket($id)
	{
		$data['transaksi_paket'] = $this->db->query("SELECT * FROM transaksi_paket tr,
		 package mb, customer cs WHERE tr.package_id=mb.package_id 
		 AND tr.id_customer=cs.id_customer AND tr.id_transaksi_paket='$id' ORDER BY id_transaksi_paket DESC")->result();
		$this->load->view('templates_customer/header');
		$this->load->view('customer/pembayaran_paket', $data);
		$this->load->view('templates_customer/footer');
	}

	public function pembayaran_aksi()
	{
		$id 								= $this->input->post('id_rental');
		$bukti_pembayaran					= $_FILES['bukti_pembayaran']['name'];
		if ($bukti_pembayaran) {
			$config['upload_path']		= './assets/upload';
			$config['allowed_types']	= 'pdf|jpg|jpeg|png|tiff';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('bukti_pembayaran')) {
				$bukti_pembayaran = $this->upload->data('file_name');
				$this->db->set('bukti_pembayaran', $bukti_pembayaran);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(
			'bukti_pembayaran' => $bukti_pembayaran,
		);

		$where = array(
			'id_rental'		=> $id
		);
		$this->rental_model->update_data('transaksi', $data, $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Bukti Pembayaran <strong>Berhasil!</strong> diupload !
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
		redirect('customer/transaksi');
	}

	public function pembayaran_paket_aksi()
	{
		$id 								= $this->input->post('id_transaksi_paket');
		$bukti								= $_FILES['bukti']['name'];
		if ($bukti) {
			$config['upload_path']		= './assets/upload';
			$config['allowed_types']	= 'pdf|jpg|jpeg|png|tiff';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('bukti')) {
				$bukti = $this->upload->data('file_name');
				$this->db->set('bukti', $bukti);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(
			'bukti' => $bukti,
		);

		$where = array(
			'id_transaksi_paket'		=> $id
		);

		$this->rental_model->update_data('transaksi_paket', $data, $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Bukti Pembayaran <strong>Berhasil!</strong> diupload !
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
		redirect('customer/transaksi');
	}

	public function cetak_invoice($id)
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr,
		 mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil 
		 AND tr.id_customer=cs.id_customer AND tr.id_rental='$id' ORDER BY id_rental DESC")->result();
		$this->load->view('customer/cetak_invoice', $data);
	}

	public function cetak_invoice_paket($id)
	{
		$data['transaksi_paket'] = $this->db->query("SELECT * FROM transaksi_paket tr,
		 package mb, customer cs WHERE tr.package_id=mb.package_id 
		 AND tr.id_customer=cs.id_customer AND tr.id_transaksi_paket='$id' ORDER BY id_transaksi_paket DESC")->result();
		$this->load->view('customer/cetak_invoice_paket', $data);
	}

	public function batal_transaksi($id)
	{
		// $where = array('id_rental' => $id);
		// $data = $this->rental_model->get_where($where,'transaksi')->row();

		// $where2 = array('id_mobil' => $data->id_mobil);		
		// $data2 = array('status_rental' => '1');

		// $this->rental_model->update_data('mobil',$data2,$where2);
		// $this->rental_model->delete_data($where,'transaksi');
		// $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
		// 		 Transaksi <strong>Berhasil!</strong> diBatalkan!
		// 		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		// 		    <span aria-hidden="true">&times;</span>
		// 		  </button>
		// 		</div>');
		// redirect('customer/transaksi');


		$where = array('id_rental' => $id);
		$this->rental_model->delete_data($where, 'transaksi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> diHapus!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>');
		redirect('customer/transaksi');
	}
}
