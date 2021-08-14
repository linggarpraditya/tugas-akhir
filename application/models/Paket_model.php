<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Paket_model extends CI_Model {

   public $table = 'paket_tour';
    public $id = 'id_paket';
  

  public function __construct() {
    parent::__construct(); 

      $this->load->helper('text');
  }


  


// Fungsi untuk melakukan proses upload file
  public function upload(){
    $config['upload_path'] = './assets/upload/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '2048';
    $config['remove_space'] = TRUE;
  
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  




 function add($upload)
    {
      
        $data = array();
      
            $data = [
             
                'nama_destinasi' => $this->input->post('nama_destinasi'),
                 'gambar' => $upload['file']['file_name']

            ];
            $aksi = $this->db->insert('paket_tour', $data);
            return $aksi;
        
    }






}