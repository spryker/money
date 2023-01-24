<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Money\Communication\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\MoneyType as SymfonyMoneyType;

/**
 * @deprecated Use {@link \Spryker\Zed\MoneyGui\Communication\Form\Type\SimpleMoneyType} instead.
 *
 * @method \Spryker\Zed\Money\MoneyConfig getConfig()
 * @method \Spryker\Zed\Money\Communication\MoneyCommunicationFactory getFactory()
 * @method \Spryker\Zed\Money\Business\MoneyFacadeInterface getFacade()
 */
class SimpleMoneyType extends SymfonyMoneyType
{
    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return '';
    }

    /**
     * @deprecated Use {@link getBlockPrefix()} instead.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
