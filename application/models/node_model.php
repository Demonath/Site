<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_model extends CI_Model {
	var $id=NULL;
	var $type=NULL;
	var $title=NULL;
	var $body=NULL;
	var $add_date=NULL;
	var $update_date=NULL;
	var $alias=NULL;
	var $terms=array();
	
	public function __construct(){
		parent::__construct();
	}
	
	function getTerms(){
		$this->db->select("term_id");
		$query = $this->db->get_where('term_node', array('node_id' => $this->id));
		if($query->num_rows() > 0){
			$name="term_model";
			$i=1;
			foreach ($query->result() as $row){
				$mn=$name.$i;
				$this->load->model("term_model", $mn);
				$this->$mn->getTerm($row->term_id);
				$this->terms[$this->$mn->type][$this->$mn->id]=$this->$mn;
				$i++;
			}
		}
	}
	
	function getNode($id){
		$query = $this->db->get_where('nodes', array('id' => $id));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$this->id=$row->id;
			$this->type=$row->type;
			$this->title=$row->title;
			$this->body=$row->body;
			$this->add_date=$row->add_date;
			$this->alias=$row->alias;
			$this->update_date=$row->update_date;
			$this->getTerms();
			return true;
		}
		return false;
	}
	
	function getNodeByAlias($alias){
		$this->db->select("id");
		$query = $this->db->get_where('nodes', array('alias' => $alias));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$this->getNode($row->id);
			return true;
		}
		return false;
	}
	
	function save(){
		$this->newAlias();
		if($this->id){
			$this->update_date=date("Y-m-d H:i:s");
			$this->db->where('id', $this->id);
			$this->db->update('nodes', $this); 
		}else{
			$this->update_date=date("Y-m-d H:i:s");
			$this->add_date=date("Y-m-d H:i:s");
			$this->db->insert('nodes', $this); 
			$this->id=$this->db->insert_id();
		}
	}
	
	function newAlias(){
		$this->load->helper('text');
		$this->load->library("lib_main");
		$this->alias=$this->lib_main->getTransUrl(character_limiter($this->title,255));
		$query="SELECT alias, id FROM nodes WHERE (alias='".mysql_real_escape_string($this->alias)."' OR alias REGEXP '".mysql_real_escape_string($this->alias)."\_[0-9]+$')  ORDER BY id ASC";
		$res=$this->db->query($query);
		if ($res->num_rows() > 0){
			$alias=$res->row();
			if($alias->id==$this->id)return true;
			$alias=$alias->alias;
			if(!empty($alias)){
				$startCount=0;
				if(is_numeric($alias[strlen($alias)-1]) && $alias[strlen($alias)-2]=='_'){
					$startCount=$alias[strlen($alias)-1];
				}
				$this->alias=$this->alias.'_'.($startCount+1);
			}		
		}
	}
}
