

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard_model extends CI_Model {

	public function __construct() {
		parent::__construct(); 

		$this->load->helper('text');
	}



	public function hitungjumlahmobil()
	{   
		$this->db->select('*');

		$query = $this->db->get('mobil');

		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}


	public function hitungjumlahcustomer()
	{   
		$this->db->select('*');
		$this->db->where('role_id','2');

		$query = $this->db->get('customer');

		if($query->num_rows()>0)
		{
			return $query->num_rows();
		} 
		else
		{
			return 0;
		}
	}

	public function hitungjumlahadmin()
	{   
		$this->db->select('*');
		$this->db->where('role_id','1');

		$query = $this->db->get('customer');

		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}




}


