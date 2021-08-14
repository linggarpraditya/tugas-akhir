<?php

class rental extends CI_Controller
{
	public function tambah_rental($id)
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == '2') {

			$data['detail'] = $this->rental_model->ambil_id_mobil($id);
			$data['sopir'] = $this->db->get('sopir')->result();
			$this->load->view('templates_customer/header');
			$this->load->view('customer/tambah_rental', $data);
			$this->load->view('templates_customer/footer');
		} else {

			redirect('auth', 'refresh');
		}
	}

	public function tambah_rental_aksi()
	{
		$id_customer			= $this->session->userdata('id_customer');

		$id_mobil 				= $this->input->post('id_mobil');
		$id_sopir 				= $this->input->post('id_sopir');
		$tgl_rental 			= $this->input->post('tgl_rental');
		$tgl_kembali 			= $this->input->post('tgl_kembali');
		$denda 					= $this->input->post('denda');
		$harga 					= $this->input->post('harga');
		$date_now = date("Y-m-d");

		$data = array(
			'id_customer'			=> $id_customer,
			'id_mobil'				=> $id_mobil,
			'tgl_rental'			=> $tgl_rental,
			'tgl_kembali'			=> $tgl_kembali,
			'denda'					=> $denda,
			'harga'					=> $harga,
			'tgl_pengembalian'		=> '-',
			'status_rental'			=> 'Belum selesai',
			'status_pengembalian'	=> 'Belum Selesai',
			'total_denda'			=> 0
		);
		if ($id_sopir) {
			$data['id_sopir'] = $id_sopir;
		}

		if ($tgl_rental >= $date_now && $tgl_kembali >= $date_now) {
			$this->rental_model->insert_data($data, 'transaksi');
			$status = array(
				'status' => 'Tersedia'
			);
			$id = array(
				'id_mobil' => $id_mobil
			);

			$this->rental_model->update_data('mobil', $status, $id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Transaksi <strong>Berhasil!</strong>, Silahkan Checkout!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Transaksi <strong>Gagal!</strong>, tanggal tidak valid!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}



		redirect('customer/data_mobil');
	}
}
