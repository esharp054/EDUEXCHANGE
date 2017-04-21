import { Injectable } from '@angular/core';

import { User } from './user';

@Injectable()
export class UserRepository {
    private _users: User[];

	private getIndex(id : number){
		for (var i = this._users.length; i--;) {
			var user = this._users[i];
			if(user.id == id) return i;
		}
		return -1;
	}
    private getEmail(email : string){
		for (var i = this._users.length; i--;) {
			var user = this._users[i];
			if(user.email == email) return i;
		}
		return -1;
	}

	constructor(){
		this._users = [
			{id: 1, email: 'jlawrimore@smu.edu', password : 'temp'},
		];
	}

	public list() : User[] {
		return this._users;
	}

	public get(id : number) : User {
		var index = this.getIndex(id);
		return this._users[index];
	}

	public add(user: User) {
		user.id = this._users.length + 1;
		this._users.push(user);
	}

	public update(user: User) {
		var index = this.getIndex(user.id);
		this._users[index] = user;
	}

	public delete(id : number) {
		var index = this.getIndex(id);
		this._users.splice(index, 1);
	}

    public getUser(email : string){
        var index = this.getEmail(email);
		return this._users[index];
    }
}
