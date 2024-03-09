<?php
namespace App\Services\Responses\Subscription;

class CancellationStatus
{
    public $status;
    public $message;

     public function __construct($data)
    {
        $this->status = $data['status'];
        $this->message = $data['message'];
    }
}
