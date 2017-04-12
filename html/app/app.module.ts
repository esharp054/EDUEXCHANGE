import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { RouterModule }   from '@angular/router';

import { AppComponent }   from './app.component';
import { LoginComponent }   from './login/login.component';
import { MainComponent }   from './main-page/main-page.component';
// import { AccountListComponent }   from './account-list/account-list.component';
// import { AccountEditorComponent }   from './account-editor/account-editor.component';
// import { UserRepository } from './user-repository';


var routes = [
  {
    path: '',
    component: MainComponent
  },
  // {
  //   path: '',
  //   component: MainComponent
  // },
  // {
  //   path: 'accounts/:userId',
  //   component: AccountEditorComponent
  // },
];

@NgModule({
  imports:      [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot(routes)
  ],
  declarations: [
    AppComponent,
    LoginComponent,
    MainComponent,
    // AccountListComponent,
    // AccountEditorComponent
  ],
  bootstrap:    [ AppComponent ],
  // providers: [ UserRepository ],
})

export class AppModule { }
