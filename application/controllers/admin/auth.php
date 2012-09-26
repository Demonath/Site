<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
				
	}

	function login(){
		$this->db->from("users");
		if($this->input->post("login") && $this->input->post("password")){
			$this->db->where("login", $this->input->post("login"));
			$this->db->where("password", $this->input->post("password"));
			$query=$this->db->get();
			if($query->num_rows() > 0){
				$this->session->set_userdata('admin', $query->row());	
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('success' => 'true')));
					return true;
			}
		}
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('success' => 'false')));		
		return false;		
	}
	function logout(){
		$this->session->unset_userdata('admin');
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('success' => 'true')));		
	}	
	
	public function index(){
		$data=array();
		$data["content"]=$this->load->view('admin/auth', NULL,TRUE);
		$data["menu"]=$this->load->view('admin/menu', NULL,TRUE);
		$this->load->view('admin/main', $data);	
	}
}
