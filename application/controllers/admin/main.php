<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if(!$this->session->userdata('admin'))header("Location:/admin/auth");
	}

	public function index(){
		$data=array();
		$data["content"]=$this->load->view('admin/index', NULL,TRUE);
		$data["menu"]=$this->load->view('admin/menu', NULL,TRUE);
		$this->load->view('admin/main', $data);	
	}

}
