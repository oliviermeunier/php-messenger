<?php

namespace Pneuma\Interface;


interface QueueInterface
{
    public function push(QueueMessageInterface $message): void;
    public function consume(callable $callback): void;
}
