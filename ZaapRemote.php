<?php
/*
Zaap remote
v1.1
by @aaviator42

2021-09-13


*/

namespace Zaap\Remote;


function send($method = NULL, $URI = NULL, $params = NULL, $payload = NULL){
	
	if(!empty($params)){
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
	
	curl_setopt_array($ch, $options);
	$content = curl_exec($ch);		
	return $content;
}







