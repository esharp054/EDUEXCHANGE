import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { ListingsComponent } from './listings/listings.component';
import { SearchPageComponent } from './search-page/search-page.component';
import { UserRepository } from './api/user-repository.service';
import { TextbookService } from './api/textbook.service';

// Modal
import { Ng2Bs3ModalModule } from 'ng2-bs3-modal/ng2-bs3-modal';

import * as Shared from './shared/index';
import { MainPageComponent } from './main-page/main-page.component';
// import { SearchComponent } from './search/search.component';

var routes = [
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '',
    component: MainPageComponent
  },
  {
    path: 'search',
    component: SearchPageComponent
  },
  {
    path: 'listings',
    component: ListingsComponent
  },
  {
    path: 'main/:user',
    component: SearchPageComponent
  },
];

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SearchPageComponent,
    ListingsComponent,
    MainPageComponent

  ],
  imports: [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot(routes),
    HttpModule,
    Shared.SharedModule,
    Ng2Bs3ModalModule
  ],
  providers: [UserRepository, TextbookService],
  bootstrap: [AppComponent],
})
export class AppModule { }
