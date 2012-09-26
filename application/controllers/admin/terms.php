<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	function tags(){
		$data=array();
		$data["content"]=$this->load->view('admin/terms', NULL,TRUE);
		$data["menu"]=$this->load->view('admin/menu', NULL,TRUE);
		$this->load->view('admin/main', $data);	
	}
	function catalogs(){
		$data=array();
		$data["content"]=$this->load->view('admin/terms', NULL,TRUE);
		$data["menu"]=$this->load->view('admin/menu', NULL,TRUE);
		$this->load->view('admin/main', $data);	
	
	}	
	public function index(){
	
	
	}
}
