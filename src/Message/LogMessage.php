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

    /**
     * @TODO Ignore Attribute is not working
     */

    #[Ignore]
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

    public function __toString(): string
    {
        return "{$this->log}\n";
    }
}
