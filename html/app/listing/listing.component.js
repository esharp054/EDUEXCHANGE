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
// import { ActivatedRoute, Router, Params } from '@angular/router';
const core_2 = require("@angular/core");
const textbook_service_1 = require("../api/textbook-service");
let ListingComponent = class ListingComponent {
    constructor(textbookService) {
        this.textbookService = textbookService;
        //this.textbookService.getById(1).then(x => this.textbook = x);
        this.textbookService.listAll().then(x => this.textbooks = x);
    }
};
ListingComponent = __decorate([
    core_1.Component({
        selector: 'listing',
        templateUrl: './app/listing/listing.component.html',
        styleUrls: ['./app/listing/listing.component.css'],
        encapsulation: core_2.ViewEncapsulation.None
    }),
    __metadata("design:paramtypes", [textbook_service_1.TextbookService])
], ListingComponent);
exports.ListingComponent = ListingComponent;
//# sourceMappingURL=listing.component.js.map