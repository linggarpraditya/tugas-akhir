<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Scheduler extends CI_Controller
{

	public function index()
	{
		$now = date('Y-m-d');
		$this->db->where("tgl_rental < '$now'");
		$this->db->group_start();
		$this->db->where("status_pembayaran", 0);
		$this->db->or_where("status_pembayaran is null");
		$this->db->group_end();
		$data = $this->db->get('transaksi')->result();
		echo "------------------------------------------------------------------------\n";
		echo "|                             Initial                                  |\n";
		echo "------------------------------------------------------------------------\n";
		if (count($data) == 0) {
			echo "|$now => Data kosong.....\n";
		} else {
			foreach ($data as $key => $value) {
				$this->db->where("id_rental", $value->id_rental);
				$this->db->delete("transaksi");
				echo "|$now => id $value->id_rental deleted.....\n";
			}
		}
		echo "------------------------------------------------------------------------\n";
		echo "|                              End                                     |\n";
		echo "------------------------------------------------------------------------\n";
	}
}

/* End of file Scheduler.php */
