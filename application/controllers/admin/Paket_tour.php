<?php 

/**
 * 
 */
class Paket_tour extends CI_Controller
{


	
	public function __construct() {
		parent::__construct(); 

		$this->load->model('Paket_model');
		$this->load->model('Package_model');

		if (!$this->session->userdata('role_id')) {
			redirect('auth');
		}
	}

	public function index()
	{

		$role_id = $this->session->userdata('role_id');
		if($role_id == '1')
		{

			$data['paket_tour']= $this->rental_model->get_data('paket_tour')->result();
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/paket_tour',$data);
			$this->load->view('templates_admin/footer');
		}

		else{

			redirect('auth','refresh');
		}
	}

	public function tambah_paket()
	{	
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_paket');
		$this->load->view('templates_admin/footer');
	}

	public function tambah_paket_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambah_paket();
		}else{
			$nama_destinasi		= $this->input->post('nama_destinasi');
			$gambar			= $_FILES['gambar']['name'];

			if ($gambar='') {}else{
				$config ['upload_path']		='./assets/upload';
				$config ['allowed_types']	='jpg|jpeg|png|tiff';

				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('gambar')){
					echo "Gambar Gagal di Upload !";
				}else{
					$gambar=$this->upload->data('file_name');
				}
			}
			$data = array(
				'nama_destinasi'		=> $nama_destinasi,
				'gambar'			=> $gambar
			);
			$this->rental_model->insert_data($data,'paket_tour');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> ditambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/paket_tour');
		}
	}

	public function add(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$upload = $this->Paket_model->upload();
      if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
      	$this->Paket_model->add($upload);

				redirect('admin/paket_tour'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}


		}
	}

	public function update_paket($id)
	{
		$where = array('id_paket' => $id);
		$data['paket_tour'] = $this->db->query("SELECT * FROM paket_tour WHERE id_paket='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_paket',$data);
		$this->load->view('templates_admin/footer');
	}


	public function update_paket_aksi()
	{
		
			$id 		= $this->input->post('id_paket');
			$nama_destinasi	= $this->input->post('nama_destinasi');
			
			$gambar		= $_FILES['gambar']['name'];
			if ($gambar){
				$config ['upload_path']		='./assets/upload';
				$config ['allowed_types']	='jpg|jpeg|png|tiff';

				$this->load->library('upload', $config);
				if($this->upload->do_upload('gambar'))
				{
					$gambar=$this->upload->data('file_name');
					$this->db->set('gambar',$gambar);
				}else{
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nama_destinasi'		=> $nama_destinasi,
			

			);

			$where = array (
				'id_paket' => $id
			);

			$this->rental_model->update_data('paket_tour',$data,$where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data <strong>Berhasil!</strong> diupdate !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/paket_tour');
		
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_destinasi','Nama Destinasi','required');
		$this->form_validation->set_rules('gambar','Gambar','required');
	}


	
	public function delete_paket($id){
		$where = array('id_paket' => $id);
		$this->rental_model->delete_data($where,'paket_tour');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data <strong>Berhasil!</strong> diHapus!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/paket_tour');
	}
}

?>