<?php
/*
Zaap remote
v1.2
by @aaviator42

2021-10-10


*/

namespace Zaap\Remote;
use Exception;

const CURL_PEM_FILE = NULL; //path to certificate file for SSL requests


function send($method = NULL, $URI = NULL, $params = NULL, $payload = NULL){
	
	if(empty($method) || empty($URI)){
		throw new Exception("Zaap Remote: Method or URI not specified");
	}
	
	if(!empty($params)){
		rtrim($params, '?');
		$URI .= "?";
		foreach($params as $key => $value){
			$URI = $URI . $key . "=" . $value . "&";
		}
	}
	
	$ch = curl_init();
	$options = array(
		CURLOPT_CUSTOMREQUEST => $method,
		CURLOPT_URL => $URI,
		CURLOPT_USERAGENT => "Zaap Remote v1.0",
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

