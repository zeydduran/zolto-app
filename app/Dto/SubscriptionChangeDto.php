<?php
namespace App\Dto;
class SubscriptionChangeDto
{
    public QueueDto $queue;
    public ParametersDto $parameters;

    public function __construct($data)
    {
        $this->queue = new QueueDto($data["queue"]);
        $this->parameters = new ParametersDto($data["parameters"]);
    }
}
