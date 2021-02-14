<?php

include 'src/Classes/Models/Transaction.php';

class TransactionTest extends \PHPUnit\Framework\TestCase
{
    private $transaction;

    protected function setUp(): void
    {
        $this->transaction = new Transaction();
    }

    public function testCommissionRate()
    {
        $this->assertEquals(0.01, $this->transaction->commissionRate('DK'));
    }

    public function testComputeExchangeRate()
    {
        $this->assertEquals(41.295011562603, $this->transaction->computeExchangeRate(50.00,'USD'));
    }
}