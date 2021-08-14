<?php 

/**
 * 
 */
class Mitra extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}
	}
	
	function index()
	{
		$role_id = $this->session->userdata('role_id');
		if($role_id == '1')
		{

			$data['mitra']= $this->rental_model->get_data('mitra')->result();
			$data['type']= $this->rental_model->get_data('type')->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/mitra',$data);
			$this->load->view('templates_admin/footer');
		}

		else{

			redirect('auth','refresh');
		}
	}

	public function tambah_mitra()
	{
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_mitra');
		$this->load->view('templates_admin/footer');
	}

	public function tambah_mitra_aksi()
	{
		$this->_rules();
		if($this->form_validation->run() == FALSE)
		{
			$this->tambah_mitra();
		}else{
			$nama_mitra	= $this->input->post('nama_mitra');
			$alamat	= $this->input->post('alamat');

			$data = array (
				'nama_mitra'	=> $nama_mitra,
				'alamat'	=> $alamat
			);

			$this->rental_model->insert_data($data,'mitra');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> ditambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/mitra');
		}

	}

	public function update_mitra($id)
	{
		$where = array('id_mitra' => $id);
		$data['mitra'] = $this->db->query("SELECT * FROM mitra WHERE id_mitra='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_mitra',$data);
		$this->load->view('templates_admin/footer');
}
public function update_mitra_aksi()
	{
		$this->_rules();
		if($this->form_validation->run() == FALSE)
		{
			$this->update_mitra();
		}else{
			$id 		= $this->input->post('id_mitra');
			$nama_mitra	= $this->input->post('nama_mitra');
			$alamat		= $this->input->post('alamat');

			$data = array (
				'nama_mitra'	=> $nama_mitra,
				'alamat'	=> $alamat
			);
			$where = array(
				'id_mitra' => $id
			);
			$this->rental_model->update_data('mitra', $data, $where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data mitra <strong>Berhasil!</strong> diUpdate !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/mitra');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_mitra','Nama Mitra','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
	}


	public function delete_mitra($id)
	{
		$where = array('id_type' => $id);
		$this->rental_model->delete_data($where,'mitra');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data Type <strong>Berhasil!</strong> diHapus !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/mitra');
	}	

}

 ?>