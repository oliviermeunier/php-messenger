<?php

namespace Pneuma\Interface;

interface QueueMessageInterface
{
    /**
     * Idea : manage payload and metadata
     * 
     * public function getPayload();
     * public function setPayload($payload);
     * public function getMetadata();
     * public function setMetadata(array $metadata);
     */
    public function getPayload();
    public function __toString(): string;
}
