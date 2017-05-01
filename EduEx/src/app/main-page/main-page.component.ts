import { Component, OnInit } from '@angular/core';
import { MainService } from './main.service';
import { ViewEncapsulation } from '@angular/core';

@Component({
  selector: 'main-page',
  templateUrl: './main-page.component.html',
  styleUrls: ['./main-page.component.css'],
  providers: [MainService],
  encapsulation: ViewEncapsulation.None
})
export class MainPageComponent{

  items: any;

  constructor(mainServce: MainService) {
    this.items = mainServce.items;
  }

}
