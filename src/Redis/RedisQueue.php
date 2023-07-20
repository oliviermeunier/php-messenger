<?php

namespace Pneuma\Redis;

use Pneuma\Adapter\QueueMessageSymfonySerializerAdapter;
use Pneuma\Interface\QueueInterface;
use Pneuma\Interface\QueueMessageInterface;
use Pneuma\Interface\QueueMessageSerializerInterface;
use Pneuma\Message\LogMessage;
use Redis;

class RedisQueue implements QueueInterface
{
    public function __construct(
        private Redis $redis,
        private QueueMessageSerializerInterface $serializer,
        private ?string $queueId = null
    ) {
        $this->queueId = $queueId ?? $this->generateRandomAndUniqueQueueId();
    }

    public function push(QueueMessageInterface $message): void
    {
        $serializedMessage = $this->serializer->serialize($message);
        $this->redis->lpush($this->queueId, $serializedMessage);
    }

    /**
     * @TODO how specify different message classes ? 
     */
    public function consume(callable $callback): void
    {
        echo "consume function\n";
        while (true) {
            [, $serializedMessage] = $this->redis->brpop($this->queueId, 0);
            $message = $this->serializer->deserialize($serializedMessage, LogMessage::class);

            $callback($message);
        }
    }

    private function generateRandomAndUniqueQueueId()
    {
        return sha1(uniqid(rand(), true));
    }
}
