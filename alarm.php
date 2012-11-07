<?php
class Alarm {
	
	function leader() {
		
		
		
	}
	
	function tweet($message) {
		
	}
	
	function bbc() {
		$page = $this->_request("http://www.bbc.co.uk/news/world-us-canada-20009195");

		$dem = preg_match("/<span class=\"vote-count dem-colour\">([0-9]+)<\/span>/", $page, $matches);
		$dem = $matches[1];

		$rep = preg_match("/<span class=\"vote-count rep-colour\">([0-9]+)<\/span>/", $page, $matches);
		$rep = $matches[1];
		
		return array(
			'dem' => $dem,
			'rep' => $rep
		);
	}

	function get($source) {
//		$method = "_$source";
		return $this->$source();
	}
	
	function _request($url) {
		return file_get_contents($url);
	}

}

?>

