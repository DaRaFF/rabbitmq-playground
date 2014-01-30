<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$arguments = array(
    'x-dead-letter-exchange' => array ('S', 'nzz_import'),
    'x-dead-letter-routing-key' => array ('S', 'related_article'),
    'x-message-ttl' => array ('I', '5000')
);

$channel->queue_declare(
    'related_article_delay',
    false,
    true,
    false,
    false,
    false,
    $arguments
);
$channel->queue_bind('related_article_delay', 'nzz_import', 'related_article_delay');

$channel->close();
$connection->close();