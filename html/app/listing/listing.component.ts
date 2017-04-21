import { Component } from '@angular/core';
// import { ActivatedRoute, Router, Params } from '@angular/router';
import { ViewEncapsulation } from '@angular/core';

import { Textbook } from '../api/textbook';
import { TextbookService } from '../api/textbook-service';

@Component({
  selector: 'listing',
  templateUrl: './app/listing/listing.component.html',
  styleUrls: ['./app/listing/listing.component.css'],
  encapsulation: ViewEncapsulation.None
})

export class ListingComponent {
  textbooks: any[];
  singleTextbook: any;

  constructor(private textbookService: TextbookService) {
    //this.textbookService.getById(1).then(x => this.textbook = x);
    this.textbookService.listAll().then(x => this.textbooks = x);
  }
}