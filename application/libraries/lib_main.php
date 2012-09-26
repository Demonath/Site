<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Lib_Main {
	public function __construct(){
		
	}
	function getTransUrl($title){
		// Таблица русского алфавита:
		$trans_table_ru = array(
			'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 
			'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 
			'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 
			'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ы', 'ы', 'Э', 'э', 'Ч', 'ч', 'Ш', 'ш', 
			'Щ', 'щ', 'Ю', 'ю', 'Я', 'я', 'Є', 'є', 'Ї', 'ї','І','і',
			'.', ',', ' ', '-',  '/', chr(92),
			"'", '"','+','$','%','*','^','&','(',')','=',':',';','~','`','!','?','@','#', '№', '«','»'
		);
		
		// Таблица латинского алфавита для адекватной замены букв (транслит):
		$trans_table_lat = array(
			'A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e', 
			'J', 'j', 'Z', 'z', 'I', 'i', 'Y', 'y', 'K', 'k', 'L', 'l', 'M', 'm', 
			'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 
			'F', 'f', 'H', 'h', 'C', 'c', 'I', 'i', 'E', 'e',
			'Ch', 'ch', 'Sh', 'sh', 'Sh', 'sh', 'Yu', 'yu', 'Ya', 'ya','E','e','I','i','I','i',
			'_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_'
	   );
		// переводим русские символы в аналогичные латинские по определеным выше
		// правилам:
		$title = str_replace($trans_table_ru, $trans_table_lat, $title);
		// Убираем все не алфавитные символы, а также некоторые непроизносимые:
		$title = preg_replace('/Ь|ь|Ъ|ъ|!|/i', '', $title);
		// убираем все дублирующиеся подчерки (нам они не нужны):
		$title = preg_replace('/_+/', '_', $title);
		// обрезаем строку:
		$title = trim($title, "_");
		// переводим в нижний регистр:
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