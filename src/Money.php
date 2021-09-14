<?php

declare(strict_types=1);

namespace App;

class Money
{
    private int $amount;
    private Currency $currency;

    public function __construct(int $amount, Currency $currency)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    public static function init($value, $currency)
    {
        return new Money($value, new Currency($currency));
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    private function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    private function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function checCurrency(Money $money)
    {
        return $this->currency->getIsoCode() == $money->currency->getIsoCode();
    }

    public function equals($money): bool
    {
        return $this->checCurrency($money) && $this->currency == $money->currency;
    }

    public function add(Money $money): Money
    {
        if ($this->checCurrency($money)) {
            exit('ERROR!!!');
        }
        return Money::init($this->amount + $money->amount, $this->currency->getIsoCode());
    }
}
