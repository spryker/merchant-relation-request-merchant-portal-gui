<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Updater;

use Generated\Shared\Transfer\MerchantRelationRequestCollectionResponseTransfer;
use Generated\Shared\Transfer\MerchantRelationRequestTransfer;

interface MerchantRelationRequestUpdaterInterface
{
    public function updateMerchantRelationRequest(
        MerchantRelationRequestTransfer $merchantRelationRequestTransfer
    ): MerchantRelationRequestCollectionResponseTransfer;
}
