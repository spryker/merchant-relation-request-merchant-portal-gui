<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationRequestMerchantPortalGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\MerchantRelationRequestTransfer;

interface MerchantRelationRequestFormDataProviderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantRelationRequestTransfer $merchantRelationRequestTransfer
     *
     * @return array<string, array<string, int>>
     */
    public function getOptions(MerchantRelationRequestTransfer $merchantRelationRequestTransfer): array;
}
