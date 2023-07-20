<?php

namespace Pneuma\Interface;

interface QueueMessageSerializerInterface
{
    public function serialize(QueueMessageInterface $message): string;
    public function deserialize(string $serializedMessage, string $messageClassName): mixed;
}
