<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Lib_Main {
	public function __construct(){
		
	}
	function getTransUrl($title){
		// ������� �������� ��������:
		$trans_table_ru = array(
			'�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 
			'�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 
			'�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 
			'�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 
			'�', '�', '�', '�', '�', '�', '�', '�', '�', '�','�','�',
			'.', ',', ' ', '-',  '/', chr(92),
			"'", '"','+','$','%','*','^','&','(',')','=',':',';','~','`','!','?','@','#', '�', '�','�'
		);
		
		// ������� ���������� �������� ��� ���������� ������ ���� (��������):
		$trans_table_lat = array(
			'A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e', 
			'J', 'j', 'Z', 'z', 'I', 'i', 'Y', 'y', 'K', 'k', 'L', 'l', 'M', 'm', 
			'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 
			'F', 'f', 'H', 'h', 'C', 'c', 'I', 'i', 'E', 'e',
			'Ch', 'ch', 'Sh', 'sh', 'Sh', 'sh', 'Yu', 'yu', 'Ya', 'ya','E','e','I','i','I','i',
			'_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_'
	   );
		// ��������� ������� ������� � ����������� ��������� �� ����������� ����
		// ��������:
		$title = str_replace($trans_table_ru, $trans_table_lat, $title);
		// ������� ��� �� ���������� �������, � ����� ��������� ��������������:
		$title = preg_replace('/�|�|�|�|!|/i', '', $title);
		// ������� ��� ������������� �������� (��� ��� �� �����):
		$title = preg_replace('/_+/', '_', $title);
		// �������� ������:
		$title = trim($title, "_");
		// ��������� � ������ �������:
		$title= strtolower($title);
		$title=preg_replace('|[^a-zA-Z0-9_]|','',$title);
		$title=trim($title, "_");		
		return $title;
	}
	
	function pager($config){
		$pages=floor($config["totalRows"]/$config["per_page"]);
		$pageStart=$config["current_page"]-3;
		if($pageStart<=0)$pageStart=1;
		$pageEnd=$pageStart+6;
		if($pageEnd>=$pages)$pageEnd=$pages;
		$config["prev_page"]=$config["current_page"]-1;
		$config["next_page"]=$config["current_page"]+1;
		if($config["prev_page"]<1)$config["prev_page"]=1;
		if($config["next_page"]>$pages)$config["next_page"]=$pages;
		for($i=$pageStart; $i<=$pageEnd; $i++){
			$config["pages"][]=$i;
		}
		//if($pages>1)return $this->load->view('site/themes/'.$this->config_model->current_theme.'/pager', $config, TRUE);
		return $config;
	}	
}

/* End of file Someclass.php */