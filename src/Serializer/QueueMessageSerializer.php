<?php

namespace Pneuma\Serializer;

use Pneuma\Interface\QueueMessageInterface;
use Pneuma\Interface\QueueMessageSerializerInterface;

class QueueMessageSerializer implements QueueMessageSerializerInterface
{
    public function serialize(QueueMessageInterface $message): string
    {
        $messageData = [
            'classname' => get_class($message)
        ];

        $messageData = [...$messageData, ...$message->getDataToSerialize()];
        return json_encode($messageData);
    }

    public function deserialize(string $serializedMessage): QueueMessageInterface
    {
        $messageData = json_decode($serializedMessage, true);
        $message = new $messageData['classname']();
        $message->hydrate($messageData);
        return $message;
    }
}
