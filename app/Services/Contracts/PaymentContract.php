<?php
namespace App\Services\Contracts;

use App\Services\Responses\ZotloResponse;

interface PaymentContract
{
    public function creditCard(array $params): ZotloResponse;
    // Diğer API metotları için gerekirse ilgili fonksiyonları ekleyebilirsiniz...
} 