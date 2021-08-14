<?php

/**
 * 
 */
class Rental_model extends CI_model
{

	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function get_data_mobil()
	{

		$this->db->select('*');
		$this->db->from('mobil');
		$this->db->join('gambar', 'gambar.id_mobil=mobil.id_mobil');


		$query = $this->db->get();

		return $query->result();
	}
	public function option_mitra()
	{
		$this->db->select('id_mitra,nama_mitra'); // Ambil Tahun dari field tgl
		$this->db->from('mitra'); // select ke tabel transaksi


		return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
	}


	function get_by_id($id)
	{
		$this->db->where('id_mobil', $id);
		$query = $this->db->get('mobil');

		return $query->result_array();
	}

	public function getsemua($id)
	{

		$this->db->select('*');
		$this->db->from('mobil');
		$this->db->join('gambar', 'gambar.id_mobil=mobil.id_mobil');



		$this->db->where('gambar.id_mobil', $id); //menampilkan hari ini
		// $this->db->where('month(tanggal_masuk)', date('m')); menampilkan bulan ini


		$query = $this->db->get();

		return $query->result_array();
	}



	function beritaGetAll()
	{
		$query = "SELECT * FROM gambar";
		return $this->db->query($query)->result_array();
	}

	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}

	public function delete_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ambil_id_mobil($id)
	{
		$hasil = $this->db->where('id_mobil', $id)->get('mobil');
		if ($hasil->num_rows() > 0) {
			return $hasil->result();
		} else {
			return false;
		}
	}

	public function ambil_id_gambar($id)
	{
		$gambar = $this->db->where('id_mobil', $id)->get('gambar');
		if ($gambar->num_rows() > 0) {
			return $gambar->result();
		} else {
			return false;
		}
	}



	public function cek_login()
	{
		$username	= set_value('username');
		$password	= set_value('password');

		$result		= $this->db
			->where('username', $username)
			->where('password', md5($password))
			->limit(1)
			->get('customer');

		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
	}
	public function update_password($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	public function downloadPembayaran($id)
	{
		$query = $this->db->get_where('transaksi', array('id_rental' => $id));
		return $query->row_array();
	}

	public function downloadPembayaranpaket($id)
	{
		$query = $this->db->get_where('transaksi_paket', array('id_transaksi_paket' => $id));
		return $query->row_array();
	}
}
