<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Reader;

use Generated\Shared\Transfer\MerchantRelationRequestTransfer;

interface MerchantRelationRequestReaderInterface
{
    public function findCurrentMerchantUserMerchantRelationRequestByIdMerchantRelationRequest(
        int $idMerchantRelationRequest
    ): ?MerchantRelationRequestTransfer;

    /**
     * @return array<int, string>
     */
    public function getInCompanyIdsFilterOptions(): array;
}
