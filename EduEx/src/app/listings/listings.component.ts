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
export class ListingsComponent {
  openListings: any[] = [];
  closedListings: any[] = [];
  curListing: any = {};
  singleTextbook: any;
  orderInput: string;
  uploader: any;
  userId: any;

  constructor(private textbookService: TextbookService) {
    this.userId = localStorage.getItem('currentUserid');
    this.textbookService.openListings(this.userId).then(x => this.openListings = x);
    this.textbookService.closedListings(this.userId).then(x => this.closedListings = x);
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

  editListing(item: any) {
    this.curListing = {};
    this.curListing = item;
    this.modal.open();
  }

  saveListing(item: any) {
    if (item.type === 'textbook') {
      this.textbookService.updateTextbook(item).then(x => this.singleTextbook = x);
    }
    else if (item.type === 'notes') {
      this.textbookService.updateNotes(item).then(x => this.singleTextbook = x);
    }
    else if (item.type === 'supplies') {
      this.textbookService.updateSupplies(item).then(x => this.singleTextbook = x);
    }
    this.textbookService.openListings(this.userId).then(x => this.openListings = x);
  }

  closeListing(item: any) {
    item.stat = 0;
    this.curListing = {};
    this.curListing = item;
    if (item.type === 'textbook') {
      this.textbookService.updateTextbook(item).then(x => this.singleTextbook = x);
    }
    else if (item.type === 'notes') {
      this.textbookService.updateNotes(item).then(x => this.singleTextbook = x);
    }
    else if (item.type === 'supplies') {
      this.textbookService.updateSupplies(item).then(x => this.singleTextbook = x);
    }
    this.textbookService.openListings(this.userId).then(x => this.openListings = x);
    this.textbookService.closedListings(this.userId).then(x => this.closedListings = x);
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
