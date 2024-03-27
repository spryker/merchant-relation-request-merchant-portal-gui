<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\MerchantRelationRequestMerchantPortalGuiConfig getConfig()
 * @method \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\MerchantRelationRequestMerchantPortalGuiCommunicationFactory getFactory()
 */
class CompanyForm extends AbstractType
{
    /**
     * @var string
     */
    protected const LABEL_NAME = 'Company';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompanyTransfer::class,
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface<mixed> $builder
     * @param array<mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addNameField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface<mixed> $builder
     *
     * @return $this
     */
    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder->add(CompanyTransfer::NAME, TextType::class, [
            'label' => static::LABEL_NAME,
            'required' => false,
            'disabled' => true,
        ]);

        return $this;
    }
}
