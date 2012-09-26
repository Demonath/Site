<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	function _content($nodes){
		$out='';
		$this->load->helper('text');
		foreach($nodes as $node){
			$data["node"]=$node;
			$out.=$this->load->view('site/themes/'.$this->config_model->current_theme.'/node-list', $data,TRUE);
		}
		return $out;
	}
	
	public function index($page=1){
		if(empty($page))$page=1;
		$this->load->model("config_model");
		$this->load->model("term_model");
		
            
		$data["title"]=$this->term_model->title;
		if($page>1)$data["title"]=$data["title"].' :: Страница '.$page;
		$this->db->distinct();
		$this->db->select('SQL_CALC_FOUND_ROWS term_node.node_id', FALSE);	
		$this->db->from('term_node');
		$this->db->join('nodes', 'nodes.id = term_node.node_id','inner');
		$this->db->order_by('nodes.add_date DESC');
		$this->db->limit($this->config_model->per_page, ($this->config_model->per_page*($page-1)));
		$query = $this->db->get();
		
		$this->total_records = $this->db->query('select FOUND_ROWS() as num_rows;')->first_row()->num_rows;
		$name="node_model";
		$i=1;
		foreach ($query->result() as $row){
			$mn=$name.$i;
			$this->load->model("node_model", $mn);
			$this->$mn->getNode($row->node_id);
			$nodes[]=$this->$mn;
			$i++;
		}
		if(!empty($nodes)){
			$this->load->library("lib_main");
			$config["totalRows"]=$this->total_records;
			$config["per_page"]=$this->config_model->per_page;
			$config["current_page"]=$page;
			$config["root_url"]='/page/';
			
			$out["pager"]=$this->load->view('site/themes/'.$this->config_model->current_theme.'/pager', $this->lib_main->pager($config), TRUE);
			$out["content"]=$this->_content($nodes);
			$data["content"]=$this->load->view('site/themes/'.$this->config_model->current_theme.'/term', $out,TRUE);;
		}else{
			$data["content"]='No records';
		}
		$this->load->view('site/themes/'.$this->config_model->current_theme.'/main', $data);	
	}
}
