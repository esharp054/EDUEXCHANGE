import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { RouterModule }   from '@angular/router';
import { HttpModule } from '@angular/http';

//Modal Stuff
// import { ModalModule } from 'angular2-modal';
// import { BootstrapModalModule } from 'angular2-modal/plugins/bootstrap';
//
// //Authentication Stuff
// import { AUTH_PROVIDERS } from 'angular2-jwt';
//import { AuthGuard } from './common/auth.guard';

import { AppComponent }   from './app.component';
import { LoginComponent }   from './login/login.component';

import { MainComponent }   from './main-page/main-page.component';
import { ListingComponent }   from './listing/listing.component';
import { UserRepository } from './api/user-repository';
import { TextbookService } from './api/textbook-service';


var routes = [
  {
    path: 'main',
    component: MainComponent
  },
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '',
    component: ListingComponent
  },
  {
    path: 'search',
    component: ListingComponent
  },
];

@NgModule({
  imports:      [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot(routes),
    HttpModule,
    // ModalModule.forRoot(),
    // BootstrapModalModule
  ],
  declarations: [
    AppComponent,
    LoginComponent,
    MainComponent,
    ListingComponent,
  ],
  providers: [ UserRepository, TextbookService ],
  bootstrap:    [ AppComponent ],
})

export class AppModule { }
