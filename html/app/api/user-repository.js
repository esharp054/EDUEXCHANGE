"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
Object.defineProperty(exports, "__esModule", { value: true });
const core_1 = require("@angular/core");
let UserRepository = class UserRepository {
    constructor() {
        this._users = [
            { id: 1, email: 'jlawrimore@smu.edu', password: 'temp' },
        ];
    }
    getIndex(id) {
        for (var i = this._users.length; i--;) {
            var user = this._users[i];
            if (user.id == id)
                return i;
        }
        return -1;
    }
    getEmail(email) {
        for (var i = this._users.length; i--;) {
            var user = this._users[i];
            if (user.email == email)
                return i;
        }
        return -1;
    }
    list() {
        return this._users;
    }
    get(id) {
        var index = this.getIndex(id);
        return this._users[index];
    }
    add(user) {
        user.id = this._users.length + 1;
        this._users.push(user);
    }
    update(user) {
        var index = this.getIndex(user.id);
        this._users[index] = user;
    }
    delete(id) {
        var index = this.getIndex(id);
        this._users.splice(index, 1);
    }
    getUser(email) {
        var index = this.getEmail(email);
        return this._users[index];
    }
};
UserRepository = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [])
], UserRepository);
exports.UserRepository = UserRepository;
//# sourceMappingURL=user-repository.js.map