<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication;

use Generated\Shared\Transfer\MerchantRelationRequestTransfer;
use Spryker\Shared\GuiTable\DataProvider\GuiTableDataProviderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Shared\ZedUi\ZedUiFactoryInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\CompanyBusinessUnitAddressBuilder;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\CompanyBusinessUnitAddressBuilderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\MerchantRelationTableUrlBuilder;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\MerchantRelationTableUrlBuilderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\UpdateMerchantRelationRequestResponseBuilder;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Builder\UpdateMerchantRelationRequestResponseBuilderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Expander\MerchantRelationRequestMerchantDashboardCardExpander;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Expander\MerchantRelationRequestMerchantDashboardCardExpanderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\ConfigurationProvider\MerchantRelationRequestFormActionConfigurationProvider;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\ConfigurationProvider\MerchantRelationRequestFormActionConfigurationProviderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\DataProvider\MerchantRelationRequestFormDataProvider;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\DataProvider\MerchantRelationRequestFormDataProviderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\DataTransformer\AssigneeCompanyBusinessUnitsDataTransformer;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\IsOpenForRelationRequestFormType;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\MerchantRelationRequestForm;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantRelationRequestGuiTableConfigurationProvider;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantRelationRequestGuiTableConfigurationProviderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\GuiTable\DataProvider\MerchantRelationRequestGuiTableDataProvider;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\GuiTable\Mapper\MerchantRelationRequestGuiTableMapper;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\GuiTable\Mapper\MerchantRelationRequestGuiTableMapperInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Reader\MerchantRelationRequestReader;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Reader\MerchantRelationRequestReaderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Sender\MerchantNotificationSender;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Sender\MerchantNotificationSenderInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Updater\MerchantRelationRequestUpdater;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Updater\MerchantRelationRequestUpdaterInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToGlossaryFacadeInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToMailFacadeInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToMerchantUserFacadeInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToTranslatorFacadeInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Service\MerchantRelationRequestMerchantPortalGuiToUtilDateTimeServiceInterface;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\MerchantRelationRequestMerchantPortalGuiDependencyProvider;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Twig\Environment;

/**
 * @method \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\MerchantRelationRequestMerchantPortalGuiConfig getConfig()
 */
class MerchantRelationRequestMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createMerchantRelationRequestGuiTableConfigurationProvider(): MerchantRelationRequestGuiTableConfigurationProviderInterface
    {
        return new MerchantRelationRequestGuiTableConfigurationProvider(
            $this->getGuiTableFactory(),
            $this->createMerchantRelationRequestReader(),
            $this->getTranslatorFacade(),
            $this->getConfig(),
        );
    }

    public function createMerchantRelationRequestGuiTableDataProvider(): GuiTableDataProviderInterface
    {
        return new MerchantRelationRequestGuiTableDataProvider(
            $this->getMerchantRelationRequestFacade(),
            $this->getMerchantUserFacade(),
            $this->getTranslatorFacade(),
            $this->createMerchantRelationRequestGuiTableMapper(),
        );
    }

    public function createMerchantRelationRequestGuiTableMapper(): MerchantRelationRequestGuiTableMapperInterface
    {
        return new MerchantRelationRequestGuiTableMapper();
    }

    public function createMerchantNotificationSender(): MerchantNotificationSenderInterface
    {
        return new MerchantNotificationSender(
            $this->getConfig(),
            $this->getMailFacade(),
        );
    }

    public function createIsOpenForRelationRequestFormType(): FormTypeInterface
    {
        return new IsOpenForRelationRequestFormType();
    }

    public function createMerchantRelationRequestReader(): MerchantRelationRequestReaderInterface
    {
        return new MerchantRelationRequestReader(
            $this->getMerchantRelationRequestFacade(),
            $this->getMerchantUserFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationRequestTransfer|null $data
     * @param array<mixed> $options
     *
     * @return \Symfony\Component\Form\FormInterface<mixed>
     */
    public function createMerchantRelationRequestForm(?MerchantRelationRequestTransfer $data = null, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(MerchantRelationRequestForm::class, $data, $options);
    }

    public function createMerchantRelationRequestFormDataProvider(): MerchantRelationRequestFormDataProviderInterface
    {
        return new MerchantRelationRequestFormDataProvider();
    }

    public function createCompanyBusinessUnitAddressBuilder(): CompanyBusinessUnitAddressBuilderInterface
    {
        return new CompanyBusinessUnitAddressBuilder();
    }

    public function createMerchantRelationRequestUpdater(): MerchantRelationRequestUpdaterInterface
    {
        return new MerchantRelationRequestUpdater($this->getMerchantRelationRequestFacade());
    }

    public function getMerchantRelationRequestFacade(): MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_RELATION_REQUEST);
    }

    /**
     * @return \Symfony\Component\Form\DataTransformerInterface<\ArrayObject<int, \Generated\Shared\Transfer\CompanyBusinessUnitTransfer>|null, list<int>>
     */
    public function createAssigneeCompanyBusinessUnitsDataTransformer(): DataTransformerInterface
    {
        return new AssigneeCompanyBusinessUnitsDataTransformer();
    }

    public function createUpdateMerchantRelationRequestResponseBuilder(): UpdateMerchantRelationRequestResponseBuilderInterface
    {
        return new UpdateMerchantRelationRequestResponseBuilder(
            $this->getZedUiFactory(),
            $this->getTranslatorFacade(),
            $this->getGlossaryFacade(),
        );
    }

    public function createMerchantRelationRequestFormActionConfigurationProvider(): MerchantRelationRequestFormActionConfigurationProviderInterface
    {
        return new MerchantRelationRequestFormActionConfigurationProvider(
            $this->getTranslatorFacade(),
            $this->getConfig(),
        );
    }

    public function createMerchantRelationTableUrlBuilder(): MerchantRelationTableUrlBuilderInterface
    {
        return new MerchantRelationTableUrlBuilder($this->getConfig(), $this->getDateTimeService());
    }

    public function createMerchantRelationRequestMerchantDashboardCardExpander(): MerchantRelationRequestMerchantDashboardCardExpanderInterface
    {
        return new MerchantRelationRequestMerchantDashboardCardExpander(
            $this->getTwigEnvironment(),
            $this->getConfig(),
            $this->getMerchantRelationRequestFacade(),
            $this->getMerchantUserFacade(),
        );
    }

    public function getTranslatorFacade(): MerchantRelationRequestMerchantPortalGuiToTranslatorFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::FACADE_TRANSLATOR);
    }

    public function getMerchantUserFacade(): MerchantRelationRequestMerchantPortalGuiToMerchantUserFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_USER);
    }

    public function getMailFacade(): MerchantRelationRequestMerchantPortalGuiToMailFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::FACADE_MAIL);
    }

    public function getGlossaryFacade(): MerchantRelationRequestMerchantPortalGuiToGlossaryFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::FACADE_GLOSSARY);
    }

    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
    }

    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    public function getZedUiFactory(): ZedUiFactoryInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::SERVICE_ZED_UI_FACTORY);
    }

    public function getDateTimeService(): MerchantRelationRequestMerchantPortalGuiToUtilDateTimeServiceInterface
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::SERVICE_DATE_TIME);
    }

    protected function getTwigEnvironment(): Environment
    {
        return $this->getProvidedDependency(MerchantRelationRequestMerchantPortalGuiDependencyProvider::SERVICE_TWIG);
    }
}
