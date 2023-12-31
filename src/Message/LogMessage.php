<?php

namespace Pneuma\Message;

use Pneuma\Interface\QueueMessageInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

class LogMessage implements QueueMessageInterface
{
    public function __construct(
        private ?string $log = null
    ) {
    }

    public function getPayload()
    {
        return $this->log;
    }

    public function getLog()
    {
        return $this->log;
    }

    public function setLog(string $log): self
    {
        $this->log = $log;
        return $this;
    }

    public function getDataToSerialize(): array
    {
        return [
            'log' => $this->log
        ];
    }

    public function hydrate(array $messageData): void
    {
        $this->log = $messageData['log'];
    }

    public function __toString(): string
    {
        return "{$this->log}\n";
    }
}
