<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {

	var $current_theme='default';
	var $per_page=3;
	
	public function __construct(){
		parent::__construct();
	}

}
