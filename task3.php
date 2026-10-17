<?php

enum Currency: string
{
    case RUB = "RUB";
}

readonly class Money
{
    public function __construct(
        public int $amount, // В копейках
        public Currency $currency = Currency::RUB,
    )
    {
        if ($amount < 0) {
            throw new InvalidArgumentException("Amount must be a positive number or zero");
        }
    }

    public static function fromStandardFormat(float $amount, Currency $currency = Currency::RUB): Money
    {
        return match($currency) {
            Currency::RUB => new static((int) round($amount * 100)),
        };
    }

    public function toStandardFormat(): float
    {
        return match($this->currency) {
            Currency::RUB => $this->amount / 100,
        };
    }
}

readonly class Weight
{
    public function __construct(public float $weight)
    {
        if ($weight <= 0) {
            throw new InvalidArgumentException("Weight must be a positive number");
        }
    }
}

interface DeliveryProvider
{
    public function calculateDeliveryPrice(Weight $weight): Money;
}

class RussianPost implements DeliveryProvider
{
    public function calculateDeliveryPrice(Weight $weight): Money
    {
        return $weight->weight <= 10
            ? Money::fromStandardFormat(100)
            : Money::fromStandardFormat(1000);
    }
}

class DHL implements DeliveryProvider
{
    public function calculateDeliveryPrice(Weight $weight): Money
    {
        return Money::fromStandardFormat(ceil($weight->weight) * 100);
    }
}

$russianPost = new RussianPost();
$dhl = new DHL();

$weightsRus = [1, 5, 9, 10, 10.1, 15, 30];
foreach ($weightsRus as $weight) {
    echo "Почта России, вес $weight кг: "
        . $russianPost->calculateDeliveryPrice(new Weight($weight))->toStandardFormat()
        . " руб.\n";
}

$weightsDHL = [1, 1.1, 2, 5, 9.5, 10, 20, 20.5];

foreach ($weightsDHL as $weight) {
    echo "DHL, вес $weight кг: "
        . $dhl->calculateDeliveryPrice(new Weight($weight))->toStandardFormat()
        . " руб.\n";
}