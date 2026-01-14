import { ChangeDetectionStrategy, Component, Input, ViewEncapsulation } from '@angular/core';
import { jsonAttribute } from '@spryker/utils';

interface businessUnit {
    businessUnitName: string;
    addresses: string[];
    checkboxName: string;
    id: string;
    checkboxHidden: boolean;
}

@Component({
    standalone: false,
    selector: 'mp-merchant-address-list',
    templateUrl: './merchant-address-list.component.html',
    styleUrls: ['./merchant-address-list.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
    host: {
        class: 'mp-merchant-address-list',
    },
})
export class MerchantAddressListComponent {
    @Input({ transform: jsonAttribute }) businessUnitList: businessUnit[];
}
