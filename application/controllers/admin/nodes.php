<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nodes extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data=array();
		$data["content"]=$this->load->view('admin/nodes', NULL,TRUE);
		$data["menu"]=$this->load->view('admin/menu', NULL,TRUE);
		$this->load->view('admin/main', $data);	
	
	}
}
