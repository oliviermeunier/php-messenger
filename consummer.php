<?php

require __DIR__ . '/vendor/autoload.php';

use Pneuma\Adapter\QueueMessageSymfonySerializerAdapter;
use Pneuma\Redis\RedisQueue;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$redis = new Redis();
$redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);

if ($redis->ping()) {
    echo "Redis connection successfull\n";
}

$serializer = new QueueMessageSymfonySerializerAdapter();

$redisQ = new RedisQueue($redis, $serializer, 'test');

try {
    $redisQ->consume(function ($message) {
        echo $message;
    });
} catch (RedisException $exception) {
    echo "Error : {$exception->getMessage()}";
}
