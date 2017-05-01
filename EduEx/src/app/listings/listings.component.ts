import { Component, OnInit, ViewChild } from '@angular/core';
import { ViewEncapsulation } from '@angular/core';

import { Textbook } from '../api/textbook';
import { TextbookService } from '../api/textbook.service';

// Modal
import { ModalComponent } from 'ng2-bs3-modal/ng2-bs3-modal';

@Component({
  selector: 'app-listings',
  templateUrl: './listings.component.html',
  styleUrls: ['./listings.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ListingsComponent{
  textbooks: any[];
  singleTextbook: any;
  orderInput: string;
  uploader: any;

  constructor(private textbookService: TextbookService) {
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

  editListing() {
    this.modal.open();
  }

  //Modal Stuff
  @ViewChild('listingModal')
  modal: ModalComponent;

  close() {
    this.modal.close();
  }

  open() {
    this.modal.open();
  }

}
