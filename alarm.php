<?php

date_default_timezone_set('Europe/London');

function _log($msg) {
	$fh = fopen('log.log', 'a');
	fwrite($fh, date('Y-m-d H:i:s').": ".$msg."\n");
	fclose($fh);
}
// ini_set('display_errors', 1);
require_once 'twitteroauth/twitteroauth/twitteroauth.php';
class Alarm {
	
	function __construct() {

		$config['twitter'] = array(
			'consumer_key' => 'DXKyRGK6Tzt3EoLGLvX5KQ',
			'consumer_secret' => 'oLCqkD40IDq62T5fJUDQnfq26jhk0g12QwQTTCPbMY',
			'access_token' => '930877946-Ft7UphoXcII04TzOOTUPsfitEUWarQZ4C9kzPVvV',
			'access_secret' => 'hyTfCBErCF3FYt00DdkpDhKkHAHDjXwlgPEFcrjx6Y'
		);

		$this->twitter = new TwitterOAuth(
			$config['twitter']['consumer_key'],
			$config['twitter']['consumer_secret'],
			$config['twitter']['access_token'],
			$config['twitter']['access_secret']
		);
		
	}
	
	function current() {
		
		
		$res = $this->bbc();
		
		$score = "Obama {$res['dem']} - {$res['rep']} Romney";
		
		$last = file_get_contents('last_score.txt');
		
		if ($last !== $score) {
			_log("Check current score...SCORE HAS CHANGED!");
			file_put_contents('last_score.txt', $score);
			$message = $score." http://iainmullan.com/election-alarm/";
			$this->tweet($message);
			
			$this->checkWinner($res);
			
		} else {
			_log("Check current score...no change");
		}
		
	}
	
	function checkWinner($score) {
		
		if ($score['dem'] >= 270) {
			
		} else if ($score['rep'] >= 270) {
			
		}

	}

	function tweet($tweet) {
		$params = array('status' => $tweet);
		$resp = $this->twitter->post('statuses/update', $params);
	}
	
	function at($recipient, $message) {

		$tweet = '@'.$recipient.' '.$message;
		// echo $tweet."\n";
		$this->tweet($tweet);
		
	}
	
	// Tweet this message to all your followers
	function alarm($message) {
		
		$followers = $this->twitter->get('followers/ids');
		
		$ids = $followers->ids;
		$users = $this->twitter->get('users/lookup', array('user_id' => implode(',',$ids)));

		foreach($users as $u) {
			echo $u->screen_name."\n";
		}
		
	}
	
	function _followers() {
		
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
		return $this->$source();
	}
	
	function _request($url) {
		return file_get_contents($url);
	}

}

?>

