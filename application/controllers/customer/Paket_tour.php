<?php 

class paket_tour extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Package_model','package_model');
	}



// READ
	function index(){
		$data['product'] = $this->package_model->get_products();
		$data['package'] = $this->package_model->get_packages();
		$this->load->view('templates_customer/header');
		$this->load->view('customer/paket_tour',$data);
		$this->load->view('templates_customer/footer');
		// $this->load->view('templates_admin/footer');


	}
	
	function get_product_by_package(){
		$package_id=$this->input->post('package_id');
		$data=$this->package_model->get_product_by_package($package_id)->result();
		foreach ($data as $result) {
			$value[] = (float) $result->product_id;
		}
		echo json_encode($value);
	}


	public function detail($id=0){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$data_now = $this->Package_model->get_detail($id);
			if(count($data_now) > 0){
				$this->Package_model->update($id);
				redirect('admin/package','refresh');
			}
		}
		$data_now = $this->Package_model->get_detail($id);

		$data['bawa'] = $this->Package_model->get_detail($id);

		
		// $tmp['contents'] = $this->load->view('admin/dashboard/home', null, true);
		$tmp['contents'] = $this->load->view('admin/paket_detail', $data);
		
	}

	public function tambah_paket($id)
	{
		$role_id = $this->session->userdata('role_id');
		if($role_id == '2')
		{
			$data['detail'] = $this->package_model->ambil_id_paket($id);
			$this->load->view('templates_customer/header');
			$this->load->view('customer/tambah_paket',$data);
			$this->load->view('templates_customer/footer');
		}

		else{

			redirect('auth','refresh');
		}
	}
	public function tambah_paket_aksi()
	{
		$id_customer			= $this->session->userdata('id_customer');
		$jumlah_orang			= $this->input->post('jumlah_orang');
		$package_id 			= $this->input->post('package_id');
		$tgl_rental 			= $this->input->post('tgl_rental');
		$harga_paket 			= $this->input->post('harga_paket');
		$total = $harga_paket * $jumlah_orang;
		$data = array();
		$this->db->where('package_id', $package_id);
		$Q=$this->db->get('package');
		if($Q->num_rows()>0)
		{
			$data = $Q->row_array();
		}
		$kuota = $data['kuota'];
		$total_kuota = $kuota - $jumlah_orang;
		if($total_kuota < 0){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data <strong>Gagal!</strong> ditambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('customer/paket_tour/tambah_paket/'.$package_id);
		}
		else
		{
						$data = array(
			'id_customer'			=> $id_customer,
			'package_id'			=> $package_id,
			'tgl_rental'			=> $tgl_rental,
			'total_harga'			=> $total,
			'jumlah_orang'			=> $jumlah_orang,
			'status'				=> '0',
		);
		$this->package_model->insert_data($data,'transaksi_paket');

		redirect('customer/transaksi');
		}

	}

}

?>
