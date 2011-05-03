/*
 * Created By Alex Figueroa
 * Tests the server for GET/POST/DELETE/PUT Requests using JSON
 */

<?php

header("Content-Type: text/javascript");
$method = $_POST['method'];
$url = $_POST['URL'];
$methodRequest = $_POST['methodRequest'];
//$getRequest = $_POST['getRequest'];
//$deleteRequest = $_POST['deleteRequest'];
//$request = $_POST['request'];
//echo($method);

$ch = curl_init();

if($method == "GET") {
	
	if(strpos($methodRequest,'entity/event') !== false){
		$consumerRequest = $_POST['eventRequest'];
		if(strpos($methodRequest,'*/person') !== false){
				  $methodRequest = str_replace("*",$consumerRequest, $methodRequest);
				  $consumerRequest = "";
				  }
	}
	else if($methodRequest == "entity/person/"){
		$consumerRequest = $_POST['personRequest'];
	}
	
	else if($methodRequest == "entity/user/"){
		$consumerRequest = $_POST['userRequest'];
	}
	
	$request = $url.$methodRequest.$consumerRequest;
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($session, CURLOPT_HEADER, false);
}

else if($method == "POST") {
	$consumerRequest = $_POST['consumerPostRequest'];
	$request = $url.$methodRequest.$consumerRequest;
	$jsonRequest = $_POST['jsonRequestPost'];
	//echo "URL:".$request."           ";
	//echo "JSON:".$jsonRequest."<----JSON";
	
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-length: ".strlen($jsonRequest)));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
}

else if($method == "PUT") {
	$consumerRequest = $_POST['consumerPutRequest'];
	$request = $url.$methodRequest.$consumerRequest;
	$jsonRequest = $_POST['jsonRequestPut'];
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-length: ".strlen($jsonRequest)));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
}

else if($method == "DELETE") {
	$consumerRequest = $_POST['consumerDeleteRequest'];
	$request = $url.$methodRequest.$consumerRequest;
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
}


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
echo $server_output;

?>

