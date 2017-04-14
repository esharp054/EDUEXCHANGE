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
let Item = class Item {
    constructor(itemName, className, imagePath, price, description) {
        this.itemName = itemName;
        this.className = className;
        this.imagePath = imagePath;
        this.price = price;
        this.description = description;
    }
};
Item = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [String, String, String, Number, String])
], Item);
exports.Item = Item;
class MainService {
    constructor() {
        this.items = [
            { itemName: 'Calculator', className: 'CSE3340', imagePath: 'img/calculator.png', price: 30, description: 'Almost new calculator, mild scratches on case' },
            { itemName: 'Textbook', className: 'EE3840', imagePath: 'img/textbook.jpg', price: 120, description: 'Almost new textbook, mild tears' },
            { itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front' },
            { itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front' },
            { itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front' }
        ];
    }
}
exports.MainService = MainService;
//# sourceMappingURL=main-page.service.js.map