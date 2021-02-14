<?php

require __DIR__ . '/vendor/autoload.php';

include 'src/Classes/Models/Transaction.php';
include 'src/Classes/Models/Bank.php';

foreach (explode("\n", file_get_contents($argv[1])) as $row) {

    $transact = new Transaction();
    $bank = new Bank();

    if ($row === "") {
        return;
    }

    $transaction = json_decode($row);
    list('bin' => $bin, 'amount' => $amount, 'currency' => $currency) = get_object_vars($transaction);

    $amountRate = $transact->isEuCurrency($currency)
        ? $amount
        : $transact->computeExchangeRate($amount, $currency);

    $bankId = $bank->getBankIdentification($bin);

    $countryCode = $bankId->country->alpha2;

    $comission = $amountRate * $transact->commissionRate($countryCode);

    echo ceiling($comission, 2);
    print "\n";
}


function ceiling($value, $precision = 0)
{
    return ceil($value * pow(10, $precision)) / pow(10, $precision);
}


