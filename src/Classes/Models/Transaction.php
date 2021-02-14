<?php

class Transaction
{
    private $euCountries = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU',
        'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    public function isEuCurrency($currency)
    {
        return $currency === 'EUR';
    }

    public function commissionRate($countryCode)
    {
        $isEuCountry = $this->isEuCountry($countryCode);

        return $isEuCountry ? 0.01 : 0.02;
    }

    public function isEuCountry($code)
    {
        $euCountries = $this->euCountries;

        return in_array($code, $euCountries);
    }

    public function computeExchangeRate($amount, $currency)
    {
        $rate = json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'))->rates->$currency;
        if ($rate === 0) {
            return $amount;
        }

        return $amount / $rate;
    }

}