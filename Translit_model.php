<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Transliterates given string between Serbian cyrillic and latin scripts. This is written as Codeigniter model, but the code is easily adaptable.
*
*	Author: Milos Milutinovic
*			milos.milutinovic@live.com
*
*	Requires: Codeigniter 3
*
*	Note to language purists: Yes, I know that this is not the correct order of Serbian azbuka (alphabet), I took the code from Russian version and modified it. It works properly and I don't care about anything else.
*/

class Translit_model extends CI_Model{

	/**
	*	Transliterates given string with optional strtolower conversion
	*
	*	@param string $string Input string
	*	@param string $direction Direction of converstion: lat2cyr | cyr2lat
	*	@param string $transform Transforms case, valid options: null, lower, upper.
	*	@return string Transliterated string
	*/
	public function transliterate($string, $direction, $transform = null){

        $cyr = array('а','б','в','г','д','ђ','e','ж','з','и','ј','к','л','љ' ,'м','н','њ' ,'о','п','р','с','т','у','ф','х','ц','ч','џ' ,'ш','ћ',  'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','Љ' ,'М','Н','Њ' ,'О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Џ' ,'Ш','Ћ',  '1','2','3','4','5','6','7','8','9','0');
    	$lat = array('a','b','v','g','d','đ','e','ž','z','i','j','k','l','lj','m','n','nj','o','p','r','s','t','u','f','h','c','č','dž','š','ć',  'A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','Lj','M','N','Nj','O','P','R','S','T','U','F','H','C','Č','Dž','Š','Ć',  '1','2','3','4','5','6','7','8','9','0');

        //select direction of transliteration
        if($direction == 'cyr2lat'){
        	$from = $cyr;
        	$to = $lat;
        }
        elseif($direction == 'lat2cyr'){
        	$from = $lat;
        	$to = $cyr;
        }
        else{
        	show_error('Invalid Transliteration direction selected, valid options are: "lat2cyr" and "cyr2lat"');
        }

        //transliterate
        $output = str_replace($from,$to, $string);	

        //optionally transform case
        if($transform == 'lower'){
        	$output = mb_strtolower($output);
        }
        elseif($transform == 'upper'){
        	$output = mb_strtoupper($output);
        }

        return $output;
	}

	/**
	*	Converts date from DD-MM-YYYY to YYYY-MM-DD
	*
	*	@param string $date Date as string in DD-MM-YYYY format
	*	@return string Date in YYYY-MM-DD format
	*/
	public function format_date($date){
		$day = substr($date, 0, 2);
		$month = substr($date, 3, 2);
		$year = substr($date, 6);

		return $year.'-'.$month.'-'.$day;
	}

}