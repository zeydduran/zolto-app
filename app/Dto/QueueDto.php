<?php
namespace App\Dto;

class QueueDto
{
    public string $type;
    public string $eventType;
    public string $requestID;
    public CreateDateDto|string $createDate;
    public int $appId;

    public function __construct($data)
    {
        $this->type = $data["type"];
        $this->eventType = $data["eventType"] ?? null;
        $this->requestID = $data["requestID"] ?? null;
        $this->createDate = is_array($data["createDate"])
            ? new CreateDateDto($data["createDate"])
            : $data["createDate"];
        $this->appId = $data["appId"];
    }
}
