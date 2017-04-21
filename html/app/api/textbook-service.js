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
const http_1 = require("@angular/http");
require("rxjs/add/operator/toPromise");
let TextbookService = class TextbookService {
    constructor(http) {
        this.http = http;
        this._apiUrl = `https://private-ea4cc-eduexchange.apiary-mock.com/textbooks`;
    }
    listAll() {
        return this.http
            .get(this._apiUrl)
            .toPromise()
            .then(x => x.json())
            .catch(x => x.message);
    }
    getById(id) {
        return this.http
            .get(`${this._apiUrl}/${id}`)
            .toPromise()
            .then(x => x.json())
            .catch(x => x.message);
    }
    add(textbook) {
        return this.http
            .post(this._apiUrl, textbook)
            .toPromise()
            .then(x => x.json().data)
            .catch(x => x.message);
    }
    update(textbook) {
        return this.http
            .put(`${this._apiUrl}/${textbook.id}`, textbook)
            .toPromise()
            .then(() => textbook)
            .catch(x => x.message);
    }
    delete(textbook) {
        return this.http
            .delete(`${this._apiUrl}/${textbook.id}`)
            .toPromise()
            .catch(x => x.message);
    }
};
TextbookService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], TextbookService);
exports.TextbookService = TextbookService;
//# sourceMappingURL=textbook-service.js.map