<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Money;

use Spryker\Shared\Money\Builder\MoneyBuilder;
use Spryker\Shared\Money\Converter\DecimalToIntegerConverter;
use Spryker\Shared\Money\Converter\IntegerToDecimalConverter;
use Spryker\Shared\Money\Formatter\IntlMoneyFormatter\IntlMoneyFormatterWithCurrency;
use Spryker\Shared\Money\Formatter\IntlMoneyFormatter\IntlMoneyFormatterWithoutCurrency;
use Spryker\Shared\Money\Formatter\MoneyFormatter;
use Spryker\Shared\Money\Formatter\MoneyFormatterCollection;
use Spryker\Shared\Money\Mapper\TransferToMoneyMapper;
use Spryker\Shared\Money\Parser\Parser;
use Spryker\Yves\Currency\Plugin\CurrencyPlugin;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\Money\Dependency\Client\MoneyToLocaleClientInterface;
use Spryker\Yves\Money\Mapper\MoneyToTransferMapper;

class MoneyFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Shared\Money\Builder\MoneyBuilderInterface
     */
    public function createMoneyBuilder()
    {
        return new MoneyBuilder(
            $this->createMoneyToTransferMapper(),
            $this->createDecimalToIntegerConverter(),
            $this->getCurrencyPlugin()->getCurrent()->getCode(),
        );
    }

    /**
     * @return \Spryker\Shared\Money\Formatter\MoneyFormatterWithTypeInterface
     */
    public function createMoneyFormatter()
    {
        return new MoneyFormatter(
            $this->createFormatterCollection(),
        );
    }

    /**
     * @return \Spryker\Shared\Money\Formatter\MoneyFormatterCollectionInterface
     */
    protected function createFormatterCollection()
    {
        $moneyFormatterCollection = new MoneyFormatterCollection();
        $moneyFormatterCollection->addFormatter(
            $this->createIntlFormatterCurrency(),
            MoneyFormatterCollection::FORMATTER_WITH_SYMBOL,
        );

        $moneyFormatterCollection->addFormatter(
            $this->createIntlFormatterDecimal(),
            MoneyFormatterCollection::FORMATTER_WITHOUT_SYMBOL,
        );

        return $moneyFormatterCollection;
    }

    /**
     * @return \Spryker\Shared\Money\Parser\ParserInterface
     */
    public function createMoneyParser()
    {
        return new Parser(
            $this->getMoneyParser(),
            $this->createMoneyToTransferMapper(),
        );
    }

    /**
     * @return \Spryker\Shared\Money\Dependency\Parser\MoneyToParserInterface
     */
    protected function getMoneyParser()
    {
        return $this->getProvidedDependency(MoneyDependencyProvider::MONEY_PARSER);
    }

    /**
     * @return \Spryker\Shared\Money\Mapper\MoneyToTransferMapperInterface
     */
    protected function createMoneyToTransferMapper()
    {
        return new MoneyToTransferMapper(
            $this->getCurrencyPlugin(),
        );
    }

    /**
     * @return \Spryker\Yves\Currency\Plugin\CurrencyPluginInterface
     */
    protected function getCurrencyPlugin()
    {
        return new CurrencyPlugin();
    }

    /**
     * @return \Spryker\Shared\Money\Mapper\TransferToMoneyMapperInterface
     */
    protected function createTransferToMoneyMapper()
    {
        return new TransferToMoneyMapper();
    }

    /**
     * @return \Spryker\Shared\Money\Formatter\MoneyFormatterInterface
     */
    protected function createIntlFormatterCurrency()
    {
        return new IntlMoneyFormatterWithCurrency(
            $this->createTransferToMoneyMapper(),
            $this->getLocaleClient()->getCurrentLocale(),
        );
    }

    /**
     * @return \Spryker\Shared\Money\Formatter\MoneyFormatterInterface
     */
    protected function createIntlFormatterDecimal()
    {
        return new IntlMoneyFormatterWithoutCurrency(
            $this->createTransferToMoneyMapper(),
            $this->getLocaleClient()->getCurrentLocale(),
        );
    }

    /**
     * @return \Spryker\Shared\Money\Converter\IntegerToDecimalConverterInterface
     */
    public function createIntegerToDecimalConverter()
    {
        return new IntegerToDecimalConverter();
    }

    /**
     * @return \Spryker\Shared\Money\Converter\DecimalToIntegerConverterInterface
     */
    public function createDecimalToIntegerConverter()
    {
        return new DecimalToIntegerConverter();
    }

    /**
     * @return \Spryker\Yves\Money\Dependency\Client\MoneyToLocaleClientInterface
     */
    public function getLocaleClient(): MoneyToLocaleClientInterface
    {
        return $this->getProvidedDependency(MoneyDependencyProvider::CLIENT_LOCALE);
    }
}
