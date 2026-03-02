<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Sender;

use Generated\Shared\Transfer\MerchantRelationRequestCollectionResponseTransfer;

interface MerchantNotificationSenderInterface
{
    public function sentNotificationToMerchant(
        MerchantRelationRequestCollectionResponseTransfer $merchantRelationRequestCollectionResponseTransfer
    ): void;
}
