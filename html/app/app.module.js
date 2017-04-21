"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
const core_1 = require("@angular/core");
const platform_browser_1 = require("@angular/platform-browser");
const forms_1 = require("@angular/forms");
const router_1 = require("@angular/router");
const http_1 = require("@angular/http");
//Modal Stuff
// import { ModalModule } from 'angular2-modal';
// import { BootstrapModalModule } from 'angular2-modal/plugins/bootstrap';
//
// //Authentication Stuff
// import { AUTH_PROVIDERS } from 'angular2-jwt';
//import { AuthGuard } from './common/auth.guard';
const app_component_1 = require("./app.component");
const login_component_1 = require("./login/login.component");
const main_page_component_1 = require("./main-page/main-page.component");
const listing_component_1 = require("./listing/listing.component");
const user_repository_1 = require("./api/user-repository");
const textbook_service_1 = require("./api/textbook-service");
var routes = [
    {
        path: 'main',
        component: main_page_component_1.MainComponent
    },
    {
        path: 'login',
        component: login_component_1.LoginComponent
    },
    {
        path: '',
        component: listing_component_1.ListingComponent
    },
    {
        path: 'search',
        component: listing_component_1.ListingComponent
    },
];
let AppModule = class AppModule {
};
AppModule = __decorate([
    core_1.NgModule({
        imports: [
            platform_browser_1.BrowserModule,
            forms_1.FormsModule,
            router_1.RouterModule.forRoot(routes),
            http_1.HttpModule,
        ],
        declarations: [
            app_component_1.AppComponent,
            login_component_1.LoginComponent,
            main_page_component_1.MainComponent,
            listing_component_1.ListingComponent,
        ],
        providers: [user_repository_1.UserRepository, textbook_service_1.TextbookService],
        bootstrap: [app_component_1.AppComponent],
    })
], AppModule);
exports.AppModule = AppModule;
//# sourceMappingURL=app.module.js.map