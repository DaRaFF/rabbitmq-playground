<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_unbind('related_article_delay', 'nzz_import', 'related_article_delay');
$channel->queue_delete('related_article_delay');

$channel->close();
$connection->close();