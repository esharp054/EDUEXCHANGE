import { Component, ViewChild } from '@angular/core';
// import { ActivatedRoute, Router, Params } from '@angular/router';
import { ViewEncapsulation } from '@angular/core';

import { Textbook } from '../api/textbook';
import { TextbookService } from '../api/textbook.service';

import { User } from '../api/user';
import { UserRepository } from '../api/user-repository.service';

// Modal
import { ModalComponent } from 'ng2-bs3-modal/ng2-bs3-modal';

@Component({
  selector: 'searchPage',
  templateUrl: './search-page.component.html',
  styleUrls: ['./search-page.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class SearchPageComponent {
  textbooks: any[];
  singleTextbook: any;
  orderInput: string;
  uploader: any;

  constructor(private textbookService: TextbookService,
              private userService: UserRepository ) {
    this.textbookService.listAll().then(x => this.textbooks = x);
    //overlay.defaultViewContainer = vcRef;
  }

  public setPriceFilter() {
    if (this.orderInput === 'price')
      this.orderInput = 'id';
    else
      this.orderInput = 'price';
  }
  public setDateFilter() {
    if (this.orderInput === 'upload_date')
      this.orderInput = 'id';
    else
      this.orderInput = 'upload_date';
  }

  getUploader(item: Textbook) {
    this.userService.getById(1).then(x => this.uploader = x);
    this.modal.open();
  }

  @ViewChild('modal')
  modal: ModalComponent;
  items: string[] = ['item1', 'item2', 'item3'];
  selected: string;
  output: string;

  index: number = 0;
  backdropOptions = [true, false, 'static'];
  cssClass: string = '';

  animation: boolean = true;
  keyboard: boolean = true;
  backdrop: string | boolean = true;
  css: boolean = false;

  closed() {
    this.output = '(closed) ';
  }

  dismissed() {
    this.output = '(dismissed)';
  }

  opened() {
    this.output = '(opened)';
  }

  open() {
    this.modal.open();
  }
}
