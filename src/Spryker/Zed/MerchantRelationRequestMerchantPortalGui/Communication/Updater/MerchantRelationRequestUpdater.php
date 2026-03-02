<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Updater;

use Generated\Shared\Transfer\MerchantRelationRequestCollectionRequestTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestCollectionResponseTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestTransfer;
use Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface;

class MerchantRelationRequestUpdater implements MerchantRelationRequestUpdaterInterface
{
    /**
     * @var \Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade\MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface
     */
    protected MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface $merchantRelationRequestFacade;

    public function __construct(
        MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface $merchantRelationRequestFacade
    ) {
        $this->merchantRelationRequestFacade = $merchantRelationRequestFacade;
    }

    public function updateMerchantRelationRequest(
        MerchantRelationRequestTransfer $merchantRelationRequestTransfer
    ): MerchantRelationRequestCollectionResponseTransfer {
        $merchantRelationRequestCollectionRequestTransfer = (new MerchantRelationRequestCollectionRequestTransfer())
            ->addMerchantRelationRequest($merchantRelationRequestTransfer)
            ->setIsTransactional(true);

        return $this->merchantRelationRequestFacade
            ->updateMerchantRelationRequestCollection($merchantRelationRequestCollectionRequestTransfer);
    }
}
