<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\Money\DataMapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\MoneyTransfer;
use Money\Currency;
use Money\Money;
use Spryker\Shared\Money\Mapper\MoneyToTransferMapper;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Shared
 * @group Money
 * @group DataMapper
 * @group MoneyToTransferConverterTest
 * Add your own group annotations below this line
 */
class MoneyToTransferConverterTest extends Unit
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
    public function testConvertShouldReturnTransfer(): void
    {
        $money = new Money(static::AMOUNT, new Currency(static::CURRENCY));
        $moneyToTransferConverter = new MoneyToTransferMapper();
        $moneyTransfer = $moneyToTransferConverter->convert($money);

        $this->assertInstanceOf(MoneyTransfer::class, $moneyTransfer);
        $this->assertSame((string)static::AMOUNT, $moneyTransfer->getAmount());

        $this->assertInstanceOf(CurrencyTransfer::class, $moneyTransfer->getCurrency());
        $this->assertSame(static::CURRENCY, $moneyTransfer->getCurrency()->getCode());
    }
}
