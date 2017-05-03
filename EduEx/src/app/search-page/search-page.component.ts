import { Component, ViewChild } from '@angular/core';
import { ActivatedRoute, Router, Params } from '@angular/router';
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
  filterInput: string = '';
  length: number;
  uploader: any;
  _searchTerm: string;

  constructor(private textbookService: TextbookService,
    private route: ActivatedRoute,
    private userService: UserRepository) {
    // this.textbooks = [];
    // this._searchTerm = localStorage.getItem('searchTerm');
    // this.textbookService.search(this._searchTerm).then(x => this.textbooks = x);
    //overlay.defaultViewContainer = vcRef;
  }
  ngOnInit() {
    var onLoad = (data) => {
      this.textbooks = data;
    };

    this.route.params.subscribe(params => {
      // debugger;
      if (params['searchTerm'] !== undefined) {
        this.textbookService.search(params['searchTerm']).then(x => this.textbooks = x);
      } else {
        this.textbooks = [];
      }
    });
  }

  public setPriceOrder() {
    this.orderInput = 'price';
  }
  public setDateOrder() {
    this.orderInput = 'upload_date';
  }

  public setNoOrder() {
    this.orderInput = 'id';
  }

  public setNoFilter() {
    this.filterInput = '';
  }

  public setTextbooksFilter() {
    this.filterInput = 'textbook';
  }

  public setNotesFilter() {
    this.filterInput = 'notes';
  }

  public setSuppliesFilter() {
    this.filterInput = 'supplies';
    debugger;
  }

  getUploader(item: Textbook) {
    this.uploader = {};
    this.userService.getById(item.uploader_id).then(x => {
      this.uploader = x[0]; 
      debugger;
    });
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
