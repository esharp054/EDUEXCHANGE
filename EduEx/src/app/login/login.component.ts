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

  signUp() {
    this.userRepository.signUp(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password, email: this._userEntry.email, phone: this._userEntry.phone }));

    this.router.navigate(['login']);
  }

  signIn() {
    this.userRepository.login(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password })).then(x => {
      if (x) {
        this.user = x[0];
        //debugger;
        if (storageAvailable('localStorage')) {
          localStorage.setItem('currentUserid', x[0].userID);
          localStorage.setItem('currentUsername', this.user.username);
          localStorage.setItem('currentImagePath', x[0].avatar);
        }
      }
      if (this.user) {
        this.router.navigate(['main']);
      }
    });
  }
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
