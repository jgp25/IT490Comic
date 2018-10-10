#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');

function storeErrors($date, $msg)
{

	file_put_contents('error.log', "[".$date."]".$msg.PHP_EOL, FILE_APPEND);		
}	        
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  storeErrors($request["date"],$request["msg"]);
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","errorServer");
echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP.EOL;
exit();
?>
