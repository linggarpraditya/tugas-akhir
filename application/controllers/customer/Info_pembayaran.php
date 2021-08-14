<?php 
/**
 * 
 */
class Info_pembayaran extends CI_controller
{
	
	public function index()
	{
		$this->load->view('templates_customer/header');
		$this->load->view('customer/Info_pembayaran');
		$this->load->view('templates_customer/footer');
	}
}
?>