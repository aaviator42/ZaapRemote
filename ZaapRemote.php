<?php
/*
Zaap remote
v1.3
by @aaviator42

2021-10-12


*/

namespace Zaap\Remote;
use Exception;

const CURL_PEM_FILE = NULL; //path to certificate file for SSL requests


function send($method = NULL, $URL = NULL, $params = NULL, $payload = NULL){
	
	if(empty($method) || empty($URL)){
		throw new Exception("Zaap Remote: Method or URL not specified");
	}
	
	if(!empty($params)){
		rtrim(URL, '?');
		$URL .= "?";
		foreach($params as $key => $value){
			$URL = $URL . $key . "=" . $value . "&";
		}
	}
	
	$ch = curl_init();
	$options = array(
		CURLOPT_CUSTOMREQUEST => $method,
		CURLOPT_URL => $URL,
		CURLOPT_USERAGENT => "Zaap Remote v1.3",
		CURLOPT_TIMEOUT => 60,
		CURLOPT_RETURNTRANSFER => true);
	
	if(!empty($payload)){
		$payload  = json_encode($payload);
		$headers = array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($payload));
		$options[CURLOPT_POSTFIELDS] = $payload;
		$options[CURLOPT_HTTPHEADER] = $headers;
	}
	
	if(!empty(CURL_PEM_FILE)){
		$options[CURLOPT_CAINFO] = CURL_PEM_FILE;
	}

	curl_setopt_array($ch, $options);
	$content = curl_exec($ch);		
	
	if(curl_errno($ch)){
		throw new Exception("ZaapRemote: cURL Error: " . curl_error($ch));
	}
	
	return $content;
}

