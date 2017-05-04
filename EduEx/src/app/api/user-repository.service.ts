import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { User } from './user';

@Injectable()
export class UserRepository {
  // private _users: User[];

  // private _apiUrl = `https://private-ea4cc-eduexchange.apiary-mock.com/users`;
  // private _apiUrl = `https://private-ea4cc-eduexchange.apiary-mock.com/users`;
  private _apiUrl = `http://54.91.225.139/eduexchange/public/index.php/user`;
  private _apiUrls = `http://54.91.225.139/eduexchange/public/index.php/signin`;

  constructor(private http: Http) { }

  private getData(response: Response) {
    let body = response.json();
    console.log('response', body);
    return body.data || body;
  }

  public listAll(): Promise<User[]> {
    return this.http
      .get(this._apiUrl)
      .toPromise()
      .then(this.getData)
      .catch(x => x.message);
  }

  public logout() {
    var url = `http://54.91.225.139/eduexchange/public/index.php/logout`;
    return this.http
      .get(url, { withCredentials: true })
      .toPromise()
      .then(this.getData)
      .catch(x => x.message);
  }

  public getById(id: number): Promise<User> {
    return this.http
      .get(`${this._apiUrl}/${id}`)
      .toPromise()
      .then(this.getData)
      .catch(x => x.message);
  }

  // public getByEmail(email: string): Promise<User> {
  //   return this.http
  //     .get(`${this._apiUrls}/${email}`)
  //     .toPromise()
  //     .then(x => x.json() as User)
  //     .catch(x => x.message);
  // }

  public login(user: any): Promise<User> {
    return this.http
      .post(this._apiUrls, user, { withCredentials: true })
      .toPromise()
      .then(this.getData)
      .catch(x => {
        alert('Username or password is incorrect.');
      });
  }

  public signUp(user: any) {
    var Urls = `http://54.91.225.139/eduexchange/public/index.php/signup`;
    return this.http
      .post(Urls, user)
      .toPromise()
      .then(this.getData)
      .catch(x => x.message);
  }

  public sendEmail(user: any) {
    var Urls = `http://54.91.225.139/eduexchange/public/index.php/sendemail`;
    alert('Email has been sent!');
    return this.http
      .post(Urls, user, { withCredentials: true })
      .toPromise()
      .then(this.getData)
      .catch(x => x.message);
  }

  public add(user: User): Promise<User> {
    return this.http
      .post(this._apiUrl, user)
      .toPromise()
      .then(x => x.json().data as User)
      .catch(x => {
        alert('Username or password is incorrect.');
      });
  }

  public update(user: User): Promise<User> {
    return this.http
      .put(`${this._apiUrl}/${user.userID}`, User)
      .toPromise()
      .then(() => User)
      .catch(x => x.message);
  }

  public delete(user: User): Promise<void> {
    return this.http
      .delete(`${this._apiUrl}/${user.userID}`)
      .toPromise()
      .catch(x => x.message);
  }

  // private getIndex(id: number) {
  //   for (var i = this._users.length; i--;) {
  //     var user = this._users[i];
  //     if (user.id == id) return i;
  //   }
  //   return -1;
  // }
  // private getEmail(email: string) {
  //   for (var i = this._users.length; i--;) {
  //     var user = this._users[i];
  //     if (user.email == email) return i;
  //   }
  //   return -1;
  // }

  // constructor() {
  //   this._users = [
  //     { id: 1, email: 'jlawrimore@smu.edu', password: 'temp' },
  //   ];
  // }

  // public list(): User[] {
  //   return this._users;
  // }

  // public get(id: number): User {
  //   var index = this.getIndex(id);
  //   return this._users[index];
  // }

  // public add(user: User) {
  //   user.id = this._users.length + 1;
  //   this._users.push(user);
  // }

  // public update(user: User) {
  //   var index = this.getIndex(user.id);
  //   this._users[index] = user;
  // }

  // public delete(id: number) {
  //   var index = this.getIndex(id);
  //   this._users.splice(index, 1);
  // }

  // public getUser(email: string) {
  //   var index = this.getEmail(email);
  //   return this._users[index];
  // }

}
