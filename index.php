<?php

/**
 * @TODO créer un système de poids pour pondérer les messages ?
 */

require __DIR__ . '/vendor/autoload.php';

use Pneuma\Redis\RedisQueue;
use Pneuma\Message\LogMessage;
use Symfony\Component\Dotenv\Dotenv;
use Pneuma\Serializer\QueueMessageSerializer;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$redis = new Redis();
$redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);

if ($redis->ping()) {
    echo "Redis connection successfull";
}

$serializer = new QueueMessageSerializer();

$redisQ = new RedisQueue($redis, $serializer, 'test');
$redisQ->push(new LogMessage('toto'));
$redisQ->push(new LogMessage('titi'));
$redisQ->push(new LogMessage('tata'));




// // Enregistrement de la valeur 'Hello world' à la clé 'message'
// $redis->set('message', 'Hello world');

// // Récupération de la valeur associée à la clé 'message' dans la variable $message
// $message = $redis->get('message');

// var_dump($message);


// // $redis->rpush('fruits', 'Ananas', 'Fraise', 'Banane');
// // $redis->lpush('fruits', 'Framboise');

// var_dump($redis->llen('fruits'));

// $redis->lpop('fruits', 2);

// var_dump($redis->llen('fruits'));

// var_dump($redis->lrange('fruits', 0, 2));
