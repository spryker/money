<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\Money\DataMapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\MoneyTransfer;
use Money\Money;
use Spryker\Shared\Money\Mapper\TransferToMoneyMapper;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Shared
 * @group Money
 * @group DataMapper
 * @group TransferToMoneyConverterTest
 * Add your own group annotations below this line
 */
class TransferToMoneyConverterTest extends Unit
{
    /**
     * @var int
     */
    public const AMOUNT = 1000;

    /**
     * @var string
     */
    public const CURRENCY = 'EUR';

    /**
     * @return void
     */
    public function testConvertShouldReturnMoney(): void
    {
        $isoCodeTransfer = new CurrencyTransfer();
        $isoCodeTransfer->setCode(static::CURRENCY);

        $moneyTransfer = new MoneyTransfer();
        $moneyTransfer->setAmount(static::AMOUNT)
            ->setCurrency($isoCodeTransfer);

        $transferToMoneyConverter = new TransferToMoneyMapper();
        $money = $transferToMoneyConverter->convert($moneyTransfer);

        $this->assertInstanceOf(Money::class, $money);
        $this->assertSame((string)static::AMOUNT, $money->getAmount());
        $this->assertSame(static::CURRENCY, $money->getCurrency()->getCode());
    }
}
