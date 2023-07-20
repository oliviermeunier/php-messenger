<?php

namespace Pneuma\Adapter;

use Pneuma\Interface\QueueMessageInterface;
use Pneuma\Interface\QueueMessageSerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class QueueMessageSymfonySerializerAdapter implements QueueMessageSerializerInterface
{
    private Serializer $serializer;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function serialize(QueueMessageInterface $message): string
    {
        return $this->serializer->serialize($message, 'json');
    }

    public function deserialize(string $serializedMessage, string $messageClassName): mixed
    {
        return $this->serializer->deserialize($serializedMessage, $messageClassName, 'json');
    }
}
