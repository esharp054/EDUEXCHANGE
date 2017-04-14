import { Injectable } from '@angular/core';

@Injectable()

export class Item {
    constructor(
        public itemName: string,
        public className: string,
        public imagePath: string,
        public price: number,
        public description: string

    ){}
}

export class MainService {

    items: Item[] = [
        {itemName: 'Calculator', className: 'CSE3340', imagePath: 'img/calculator.png', price: 30, description: 'Almost new calculator, mild scratches on case'},
        {itemName: 'Textbook', className: 'EE3840', imagePath: 'img/textbook.jpg', price: 120, description: 'Almost new textbook, mild tears'},
        {itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front'},
        {itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front'},
        {itemName: 'Lab Coat', className: 'Bio1340', imagePath: 'img/labcoat.jpg', price: 70, description: 'Almost new coat, mild stains on front'}
    ]
}
