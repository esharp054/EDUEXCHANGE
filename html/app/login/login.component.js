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
const core_2 = require("@angular/core");
const router_1 = require("@angular/router");
const user_repository_1 = require("../api/user-repository");
let LoginComponent = class LoginComponent {
    constructor(route, router, userRepository) {
        this.route = route;
        this.router = router;
        this.userRepository = userRepository;
        this._userEntry = {};
    }
    signUp() {
        this.router.navigate(['search']);
    }
    signIn() {
        this.user = this.userRepository.getUser(this._userEntry.email);
        if (this.user) {
            if (this._userEntry.password != this.user.password) {
                this._userEntry = {};
                console.log("Wrong password");
            }
            else {
                this.router.navigate(['search']);
            }
        }
        else {
            console.log("Not a valid user");
        }
    }
};
__decorate([
    core_1.Input(),
    __metadata("design:type", Array)
], LoginComponent.prototype, "model", void 0);
LoginComponent = __decorate([
    core_1.Component({
        selector: 'login',
        templateUrl: './app/login/login.component.html',
        styleUrls: ['./app/login/login.component.css'],
        encapsulation: core_2.ViewEncapsulation.None
    }),
    __metadata("design:paramtypes", [router_1.ActivatedRoute,
        router_1.Router,
        user_repository_1.UserRepository])
], LoginComponent);
exports.LoginComponent = LoginComponent;
//# sourceMappingURL=login.component.js.map