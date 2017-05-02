import { Component, OnInit } from '@angular/core';
import { MainService } from './main.service';
import { ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router, Params } from '@angular/router';

@Component({
  selector: 'main-page',
  templateUrl: './main-page.component.html',
  styleUrls: ['./main-page.component.css'],
  providers: [MainService],
  encapsulation: ViewEncapsulation.None
})
export class MainPageComponent{

  items: any;

  constructor(mainServce: MainService,
    private router: Router) {
    this.items = mainServce.items;
  }

  search() {
    // Add get method and send search term or send search term with navigate
    this.router.navigate(['search']);
  }

}
