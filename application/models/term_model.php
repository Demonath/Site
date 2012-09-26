<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Term_model extends CI_Model {
	var $id=NULL;
	var $type=NULL;
	var $title=NULL;
	var $description=NULL;
	var $alias=NULL;
	var $parent_id=0;
	
	public function __construct(){
		parent::__construct();
	}
	
	function getTerm($id){
		$query = $this->db->get_where('terms', array('id' => $id));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$this->id=$row->id;
			$this->parent_id=$row->parent_id;
			$this->type=$row->type;
			$this->title=$row->title;
			$this->alias=$row->alias;
			$this->description=$row->description;

			return true;
		}
		return false;
	}
	
	function getTermByAlias($alias){
		$this->db->select("id");
		$query = $this->db->get_where('terms', array('alias' => $alias));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$this->getTerm($row->id);
			return true;
		}
		return false;
	}
	
	function save(){
		$this->newAlias();
		if($this->id){
			$this->db->where('id', $this->id);
			$this->db->update('terms', $this); 
		}else{
			$this->db->insert('terms', $this); 
			$this->id=$this->db->insert_id();
		}
	}
	function newAlias(){
		$this->load->helper('text');
		$this->load->library("lib_main");
		$this->alias=$this->lib_main->getTransUrl(character_limiter($this->title,255));
		$query="SELECT alias, id FROM terms WHERE (alias='".mysql_real_escape_string($this->alias)."' OR alias REGEXP '".mysql_real_escape_string($this->alias)."\_[0-9]+$')  ORDER BY id ASC";
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
