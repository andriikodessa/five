<?php

declare(strict_types=1);

namespace App;

class Currency
{
    private  string $isoCode;

    public function __construct(string $isoCode)
    {
        $this->setisoCode($isoCode);
    }

    private function setisoCode(string $isoCode)
    {
        $currencies = array(
            'USD' => 'USD',
            'UAH' => 'UAH',
            'RUR' => 'RUR',
            'EUR' => 'EUR',
        );

        $key = array_search($isoCode, $currencies);

        if(!$key) {
            exit('ERROR: Нет такой валюты');
        }
        $this->isoCode = $isoCode;
    }

    public function getisoCode(): string
    {
        return $this->isoCode;
    }

    public function equals($isoCode):bool
    {
        return $this->getisoCode () == $isoCode->getisoCode ();
    }
}