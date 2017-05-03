import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { NavbarComponent } from './navbar/navbar.component';
import { NavbarMainComponent } from './navbar/navbar-main.component';
import { SearchComponent } from './search/search.component';
import { SortPricePipe } from './pipes/sort.pipe';
import { FilterTypePipe } from './pipes/filter-type.pipe';

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
    NavbarMainComponent,
    SortPricePipe,
    FilterTypePipe,
    SearchComponent
  ],
  exports: [
    NavbarComponent,
    NavbarMainComponent,
    SortPricePipe,
    FilterTypePipe,
    SearchComponent
  ]
})

export class SharedModule { }