<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model{
	
	// get all product
	function get_products(){
		$query = $this->db->get('paket_tour');
		return $query;
	}

	//GET PRODUCT BY PACKAGE ID
	function get_product_by_package($package_id){
		$this->db->select('*');
		$this->db->from('paket_tour');
		$this->db->join('detail', 'detail_paket_tour_id=id_paket');
		$this->db->join('package', 'package_id=detail_package_id');
		$this->db->where('package_id',$package_id);
		$query = $this->db->get();
		return $query;
	}

	public function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function update_data($table, $data,$where)
	{
		$this->db->update($table,$data,$where);
	}

	//READ
	function get_packages(){
		$this->db->select('package.*,COUNT(id_paket) AS item_product,package_id,harga_paket,foto');
		$this->db->from('package');
		$this->db->join('detail', 'package_id=detail_package_id');
		$this->db->join('paket_tour', 'detail_paket_tour_id=id_paket');
		$this->db->group_by('package_id');
		$query = $this->db->get();
		return $query;
	}
	public function ambil_id_paket($id)
	{
		$hasil = $this->db->where('package_id', $id)->get('package');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		}else{
			return false;
		}
	}
	// CREATE
	function create_package($package,$product,$harga_paket,$foto){
		$this->db->trans_start();

		date_default_timezone_set("Asia/Jakarta");
		$data  = array(
			'package_name' => $package,
			'harga_paket' => $harga_paket,
			'package_created_at' => date('Y-m-d H:i:s'),
			'foto' => $foto
		);
		$this->db->insert('package', $data);
			//GET ID PACKAGE
		$package_id = $this->db->insert_id();
		$result = array();
		foreach($product AS $key => $val){
			$result[] = array(
				'detail_package_id'  	=> $package_id,
				'detail_paket_tour_id'  	=> $_POST['product'][$key]
			);
		}      
			//MULTIPLE INSERT TO DETAIL TABLE
		$this->db->insert_batch('detail', $result);
		$this->db->trans_complete();
	}

	
	// UPDATE
	function update_package($id,$package,$product){
		$this->db->trans_start();
			//UPDATE TO PACKAGE
		$data  = array(
			'package_name' => $package
		);
		$this->db->where('package_id',$id);
		$this->db->update('package', $data);

			//DELETE DETAIL PACKAGE
		$this->db->delete('detail', array('detail_package_id' => $id));

		$result = array();
		foreach($product AS $key => $val){
			$result[] = array(
				'detail_package_id'  	=> $id,
				'detail_paket_tour_id'  	=> $_POST['product_edit'][$key]
			);
		}      

		$this->db->insert_batch('detail', $result);
		$this->db->trans_complete();
	}

	// DELETE
	function delete_package($id){
		$this->db->trans_start();
		$this->db->delete('detail', array('detail_package_id' => $id));
		$this->db->delete('package', array('package_id' => $id));
		$this->db->trans_complete();
	}

	function select_by_id($id)
	{
		$data = array();
		$this->db->where('package.package_id', $id);
		$Q = $this->db->get('package');

		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}

		$Q->free_result();
		return $data;
	}

    	//READ
	function get_detail($id){
		$this->db->select('*');
		$this->db->from('package');
		$this->db->join('detail', 'package_id=detail_package_id');
		$this->db->join('paket_tour', 'detail_paket_tour_id=id_paket');
		$this->db->where('package_id',$id);
		$query = $this->db->get();
		return $query;
	}




	
}