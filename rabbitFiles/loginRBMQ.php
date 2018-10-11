<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function login($username,$pass)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	#$eClient = new rabbitMQClient("testRabbitMQ.ini","errorServer");
	$request1 = array();
	$request1['type'] = "login";
        $request1['username'] = $username;
	$request1['password'] = $pass;
	$response = $client->send_request($request1);
	return $response;
}
function registration($userN,$email, $pass,$firstN,$lastN)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	#$eClient = new rabbitMQClient("testRabbitMQ.ini","errorServer");
	$request2 = array();
	$request2['type']="register";
	$request2['username'] = $username;
	$request2['email'] = $email;
	$request2['firstName'] = $firstN;
	$request2['lastName'] = $lastN;
	$response = $client->send_request($request2);
	return $response;
}
function errorThrow($msg)
{
	$eClient = new rabbitMQClient("testRabbitMQ.ini","errorServer");
	$request3= array();
	$eDate = date_create();
	$request3['date'] = $eDate;
	$request3['message'] =$msg;
	$eClient->send_request($request3);
}