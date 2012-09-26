<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("node_model");
	}
   
	function _content($node){
		if($node){
			$data=array();
			$data["node"]=$node;
			return $this->load->view('site/themes/'.$this->config_model->current_theme.'/node-detail', $data,TRUE);
		}else{
			$this->output->set_status_header('404');
			return "404";
		}
	}
	
	function _node_id($id){
		$this->node_model->getNode($id);
		if($this->node_model->id)return $this->node_model;
		return false;
	}
	
	function _node_alias($alias){
		$this->node_model->getNodeByAlias($alias);
		if($this->node_model->id)return $this->node_model;
		return false;	
	}	
	
	public function index($type, $ind){
		$node=null;
		switch($type){
			case "id":$node=$this->_node_id($ind);break;
			case "alias":$node=$this->_node_alias($ind);break;
		}
		$data["title"]=$node->title;
		$data["content"]=$this->_content($node);
		$this->load->view('site/themes/'.$this->config_model->current_theme.'/main', $data);
	
	}
}
