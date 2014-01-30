<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$text = array(
    'guid' => '1.13260617',
    'bodysize' => '800'
);

$msg = new AMQPMessage(serialize($text));


$channel->basic_publish($msg, 'nzz_import', 'related_article_delay');

echo " [x] Sent 'msg'\n";

$channel->close();
$connection->close();


