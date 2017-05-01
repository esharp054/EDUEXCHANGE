import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
// import { NavbarComponent } from './shared/navbar/navbar.component';
import { SearchPageComponent } from './search-page/search-page.component';
import { UserRepository } from './api/user-repository.service';
import { TextbookService } from './api/textbook.service';

// Modal
import { Ng2Bs3ModalModule } from 'ng2-bs3-modal/ng2-bs3-modal';

import * as Shared from './shared/index';

var routes = [
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '',
    component: SearchPageComponent
  },
  {
    path: 'search',
    component: SearchPageComponent
  },
];

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SearchPageComponent

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
