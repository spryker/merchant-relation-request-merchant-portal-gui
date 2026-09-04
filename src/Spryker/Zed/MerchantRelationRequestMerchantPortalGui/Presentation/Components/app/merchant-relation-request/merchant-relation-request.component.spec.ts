import { Component, Input, NO_ERRORS_SCHEMA } from '@angular/core';
import { MerchantRelationRequestComponent } from './merchant-relation-request.component';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';

@Component({
    template: `
        <mp-merchant-relation-request [tableConfig]="tableConfig" [tableId]="tableId">
            <span title></span>
            <span button-action></span>
        </mp-merchant-relation-request>
    `,
    standalone: false,
})
class TestHostComponent {
    @Input() tableConfig?: unknown;
    @Input() tableId?: string;
}

describe('MerchantRelationRequestComponent', () => {
    let fixture: ComponentFixture<TestHostComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [MerchantRelationRequestComponent, TestHostComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(TestHostComponent);
    });

    it('should render <mp-merchant-relation-request-table> component', () => {
        const productListTableComponent = fixture.debugElement.query(By.css('mp-merchant-relation-request-table'));

        expect(productListTableComponent).toBeTruthy();
    });

    it('should render <spy-headline> component', () => {
        const headlineComponent = fixture.debugElement.query(By.css('spy-headline'));

        expect(headlineComponent).toBeTruthy();
    });

    it('should render `title` slot to the <spy-headline> component', () => {
        const titleSlot = fixture.debugElement.query(By.css('spy-headline [title]'));

        expect(titleSlot).toBeTruthy();
    });

    it('should render `button-action` slot to the <spy-headline> component', () => {
        const buttonActionSlot = fixture.debugElement.query(By.css('spy-headline [button-action]'));

        expect(buttonActionSlot).toBeTruthy();
    });

    it('should bound `@Input(tableConfig)` to the `config` input of <mp-merchant-relation-request-table> component', () => {
        const mockTableConfig = {
            config: 'config',
            data: 'data',
            columns: 'columns',
        };
        fixture.componentRef.setInput('tableConfig', mockTableConfig);
        fixture.detectChanges();
        const productListTableComponent = fixture.debugElement.query(By.css('mp-merchant-relation-request-table'));

        expect(productListTableComponent.properties.config).toEqual(mockTableConfig);
    });

    it('should bound `@Input(tableId)` to the `tableId` input of <mp-merchant-relation-request-table> component', () => {
        const mockTableId = 'mockTableId';
        fixture.componentRef.setInput('tableId', mockTableId);
        fixture.detectChanges();
        const productListTableComponent = fixture.debugElement.query(By.css('mp-merchant-relation-request-table'));

        expect(productListTableComponent.properties.tableId).toEqual(mockTableId);
    });
});
