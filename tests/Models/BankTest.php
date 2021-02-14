<?php

include 'src/Classes/Models/Bank.php';

class BankTest extends \PHPUnit\Framework\TestCase
{
    private $bank;

    protected function setUp(): void
    {
        $this->bank = new Bank();
    }

    public function testBankIdentification()
    {
        $this->assertEquals('object', gettype($this->bank->getBankIdentification(45717360)));
    }
}