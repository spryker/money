<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\Money\Formatter;

use Codeception\Test\Unit;
use Spryker\Shared\Money\Exception\FormatterNotFoundException;
use Spryker\Shared\Money\Formatter\MoneyFormatterCollection;
use Spryker\Shared\Money\Formatter\MoneyFormatterCollectionInterface;
use Spryker\Shared\Money\Formatter\MoneyFormatterInterface;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Shared
 * @group Money
 * @group Formatter
 * @group MoneyFormatterCollectionTest
 * Add your own group annotations below this line
 */
class MoneyFormatterCollectionTest extends Unit
{
    /**
     * @var string
     */
    public const FORMATTER = 'formatter';

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $moneyFormatterCollection = new MoneyFormatterCollection();
        $this->assertInstanceOf(MoneyFormatterCollectionInterface::class, $moneyFormatterCollection);
    }

    /**
     * @return void
     */
    public function testAddFormatterShouldReturnCollection(): void
    {
        $moneyFormatterCollection = new MoneyFormatterCollection();
        $moneyFormatterCollection = $moneyFormatterCollection->addFormatter($this->getFormatterMock(), static::FORMATTER);
        $this->assertInstanceOf(MoneyFormatterCollectionInterface::class, $moneyFormatterCollection);
    }

    /**
     * @return void
     */
    public function testGetFormatterShouldReturnAddedFormatter(): void
    {
        $moneyFormatterCollection = new MoneyFormatterCollection();
        $moneyFormatterMock = $this->getFormatterMock();
        $moneyFormatterCollection = $moneyFormatterCollection->addFormatter($moneyFormatterMock, static::FORMATTER);

        $this->assertSame($moneyFormatterMock, $moneyFormatterCollection->getFormatter(static::FORMATTER));
    }

    /**
     * @return void
     */
    public function testGetFormatterWhichIsNotAddedShouldThrowException(): void
    {
        $this->expectException(FormatterNotFoundException::class);

        $moneyFormatterCollection = new MoneyFormatterCollection();
        $moneyFormatterCollection->getFormatter(static::FORMATTER);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Money\Formatter\MoneyFormatterInterface
     */
    protected function getFormatterMock(): MoneyFormatterInterface
    {
        return $this->getMockBuilder(MoneyFormatterInterface::class)->getMock();
    }
}
