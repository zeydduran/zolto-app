<?php
namespace App\Dto;
class CreateDateDto
{
    public string $date;
    public int $timezone_type;
    public string $timezone;

    public function __construct($data)
    {
        $this->date = $data['date'];
        $this->timezone_type = $data['timezone_type'];
        $this->timezone = $data['timezone'];
    }
}