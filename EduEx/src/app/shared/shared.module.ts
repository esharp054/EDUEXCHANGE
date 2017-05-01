import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { NavbarComponent } from './navbar/navbar.component';
import { SearchComponent } from './search/search.component';
import { SortPricePipe } from './pipes/sort.pipe';

//Modal
import { Ng2Bs3ModalModule } from 'ng2-bs3-modal/ng2-bs3-modal';

@NgModule({
  imports: [
    CommonModule,
    Ng2Bs3ModalModule,
    FormsModule
  ],
  declarations: [
    NavbarComponent,
    SortPricePipe,
    SearchComponent
  ],
  exports: [
    NavbarComponent,
    SortPricePipe,
    SearchComponent
  ]
})

export class SharedModule { }