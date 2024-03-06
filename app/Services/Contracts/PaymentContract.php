<?php
namespace App\Services\Contracts;

interface PaymentContract
{
    public function creditCard(array $params): array;
    // Diğer API metotları için gerekirse ilgili fonksiyonları ekleyebilirsiniz...
} 