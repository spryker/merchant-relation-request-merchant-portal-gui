<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Plugin\Mail;

use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\MerchantRelationRequestMerchantPortalGuiConfig getConfig()
 * @method \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\MerchantRelationRequestMerchantPortalGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\MerchantRelationRequest\Business\MerchantRelationRequestFacadeInterface getFacade()
 */
class MerchantNotificationOfMerchantRelationRequestCreationMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    protected const MAIL_TYPE = 'merchant notification of merchant relation request creation';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_HTML = 'merchantRelationRequestMerchantPortalGui/mail/merchant_notification_of_merchant_relation_request_creation.html.twig';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_TEXT = 'merchantRelationRequestMerchantPortalGui/mail/merchant_notification_of_merchant_relation_request_creation.text.twig';

    /**
     * @var string
     */
    protected const GLOSSARY_KEY_MAIL_SUBJECT = 'merchant_relation_request.mail.trans.merchant_notification.subject';

    /**
     * {@inheritDoc}
     * - Returns the name of mail for merchant notification mail.
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
    }

    /**
     * {@inheritDoc}
     * - Builds the `MailTransfer` with data for merchant notification mail.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function build(MailTransfer $mailTransfer): MailTransfer
    {
        $merchantTransfer = $mailTransfer->getMerchantOrFail();

        return $mailTransfer
            ->setSubject(static::GLOSSARY_KEY_MAIL_SUBJECT)
            ->addTemplate(
                (new MailTemplateTransfer())
                    ->setName(static::MAIL_TEMPLATE_HTML)
                    ->setIsHtml(true),
            )
            ->addTemplate(
                (new MailTemplateTransfer())
                    ->setName(static::MAIL_TEMPLATE_TEXT)
                    ->setIsHtml(false),
            )
            ->addRecipient(
                (new MailRecipientTransfer())
                    ->setEmail($merchantTransfer->getEmailOrFail())
                    ->setName(sprintf('%s', $merchantTransfer->getNameOrFail())),
            );
    }
}
