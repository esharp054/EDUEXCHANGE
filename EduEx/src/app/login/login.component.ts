import { Component, Input, OnInit } from '@angular/core';
import { ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router, Params } from '@angular/router';
import { Http } from '@angular/http';

import { User } from '../api/user';
import { UserRepository } from '../api/user-repository.service';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class LoginComponent {
  @Input() model: any[];

  _userEntry: any;
  user: User;

  constructor(private route: ActivatedRoute,
    private router: Router,
    private userRepository: UserRepository) {
    this._userEntry = {};
  }

  // signUp() {
  //   console.log(this._userEntry);
  //   console.log(JSON.stringify(this._userEntry));
  //   this.userRepository.signUp(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password, email: this._userEntry.email, phone: this._userEntry.phone }));
  //   //this.router.navigate(['search']);
  // }

  signIn() {
    this.userRepository.getByEmail(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password })).then(x => { 
      if(x){
        this.user = x[0]; 
        //console.log(this.user);
        //debugger;
        if (storageAvailable('localStorage')) {
          localStorage.setItem('currentUsername', this.user.username);
          localStorage.setItem('currentImagePath', this.user.imagePath);
      }
    }
    this.router.navigate(['search']);


    });
    // if (this.user) {
    //   if (this._userEntry.password != this.user.password) {
    //     this._userEntry = {};
    //     console.log("Wrong password");
    //   }
    //   else {
    //     this.router.navigate(['search']);
    //   }
    // }
    // else {
    //   console.log("Not a valid user");
    // }
  }
  // getUser(): Promise<void> {
  //   return new Promise<void>(resolve => {
  //     // Set user
  //     this.userRepository.getByEmail(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password })).then(x => { console.log(x); this.user = x; });
  //   })
  // };

}

function storageAvailable(type) {
  try {
    var storage = window[type],
      x = '__storage_test__';
    storage.setItem(x, x);
    storage.removeItem(x);
    return true;
  }
  catch (e) {
    return false;
  }
}
