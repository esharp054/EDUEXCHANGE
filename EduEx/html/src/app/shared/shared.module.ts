import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { NavbarComponent } from './navbar/navbar.component';
import { SortPricePipe } from './pipes/sort.pipe';

//Modal
import { Ng2Bs3ModalModule } from 'ng2-bs3-modal/ng2-bs3-modal';

@NgModule({
  imports: [
    CommonModule,
    Ng2Bs3ModalModule
  ],
  declarations: [
    NavbarComponent,
    SortPricePipe
  ],
  exports: [
    NavbarComponent,
    SortPricePipe
  ]
})

export class SharedModule { }