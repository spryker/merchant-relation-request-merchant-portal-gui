<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Dependency\Facade;

use Generated\Shared\Transfer\MerchantRelationRequestCollectionRequestTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestCollectionResponseTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestCollectionTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestCriteriaTransfer;

class MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeBridge implements MerchantRelationRequestMerchantPortalGuiToMerchantRelationRequestFacadeInterface
{
    /**
     * @var \Spryker\Zed\MerchantRelationRequest\Business\MerchantRelationRequestFacadeInterface
     */
    protected $merchantRelationRequestFacade;

    /**
     * @param \Spryker\Zed\MerchantRelationRequest\Business\MerchantRelationRequestFacadeInterface $merchantRelationRequestFacade
     */
    public function __construct($merchantRelationRequestFacade)
    {
        $this->merchantRelationRequestFacade = $merchantRelationRequestFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationRequestCriteriaTransfer $merchantRelationRequestCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantRelationRequestCollectionTransfer
     */
    public function getMerchantRelationRequestCollection(
        MerchantRelationRequestCriteriaTransfer $merchantRelationRequestCriteriaTransfer
    ): MerchantRelationRequestCollectionTransfer {
        return $this->merchantRelationRequestFacade
            ->getMerchantRelationRequestCollection($merchantRelationRequestCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationRequestCriteriaTransfer $merchantRelationRequestCriteriaTransfer
     *
     * @return int
     */
    public function countMerchantRelationRequests(
        MerchantRelationRequestCriteriaTransfer $merchantRelationRequestCriteriaTransfer
    ): int {
        return $this->merchantRelationRequestFacade
            ->countMerchantRelationRequests($merchantRelationRequestCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationRequestCollectionRequestTransfer $merchantRelationRequestCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantRelationRequestCollectionResponseTransfer
     */
    public function updateMerchantRelationRequestCollection(
        MerchantRelationRequestCollectionRequestTransfer $merchantRelationRequestCollectionRequestTransfer
    ): MerchantRelationRequestCollectionResponseTransfer {
        return $this->merchantRelationRequestFacade
            ->updateMerchantRelationRequestCollection($merchantRelationRequestCollectionRequestTransfer);
    }
}
