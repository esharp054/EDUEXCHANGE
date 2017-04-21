import { Component, Input, OnInit } from '@angular/core';
import {ViewEncapsulation} from '@angular/core';
import { ActivatedRoute, Router, Params} from '@angular/router';
import { Http } from '@angular/http';

import { User } from '../api/user';
import { UserRepository } from '../api/user-repository';

@Component({
  selector: 'login',
  templateUrl: './app/login/login.component.html',
  styleUrls: [ './app/login/login.component.css' ],
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

  signUp(){
        this.router.navigate(['search']);
  }
  signIn(){
        this.user = this.userRepository.getUser(this._userEntry.email);
        if(this.user){
          if(this._userEntry.password != this.user.password){
            this._userEntry = {};
            console.log("Wrong password");
          }
          else {
            this.router.navigate(['search']);
          }
        }
        else{
          console.log("Not a valid user");
        }
  }
}