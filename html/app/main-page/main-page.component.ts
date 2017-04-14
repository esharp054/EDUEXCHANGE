import { Component } from '@angular/core';
import { MainService } from './main-page.service';
import { ViewEncapsulation } from '@angular/core';

@Component({
  selector: 'main-page',
  templateUrl: './app/main-page/main-page.component.html',
  styleUrls: [ './app/main-page/main-page.component.css' ],
  providers: [MainService],
  encapsulation: ViewEncapsulation.None
})

export class MainComponent {
    items: any;

    constructor(mainServce: MainService){
        this.items = mainServce.items;
    }
}
