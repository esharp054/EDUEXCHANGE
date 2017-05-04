import { Component, ViewChild } from '@angular/core';
import { MainService } from './main.service';
import { ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router, Params } from '@angular/router';

// Listings Stuff
import { Textbook } from '../api/textbook';
import { TextbookService } from '../api/textbook.service';

//User Stuff
import { User } from '../api/user';
import { UserRepository } from '../api/user-repository.service';

// Modal
import { ModalComponent } from 'ng2-bs3-modal/ng2-bs3-modal';

@Component({
  selector: 'main-page',
  templateUrl: './main-page.component.html',
  styleUrls: ['./main-page.component.css'],
  providers: [MainService],
  encapsulation: ViewEncapsulation.None
})
export class MainPageComponent{

  items: any;
  listings: any[] = [];
  uploader: any = {};
  curListing: any = {};
  curUser: any = {};
  _searchTerm: string;

  constructor(mainServce: MainService,
    private router: Router,
    private textbookService: TextbookService,
    private userService: UserRepository) {
    this.listings = [];
    this.items = mainServce.items;
    textbookService.getRecent().then(x => this.listings = x);
  }

  search() {
    //Add search term to local storage for after navigation call
    if (storageAvailable('localStorage')) {
      localStorage.setItem('searchterm', this._searchTerm);
    }
    debugger;
    if (this._searchTerm !== undefined)
      this.router.navigate(['search', this._searchTerm]);
    else
      this.router.navigate(['search', ' ']);
    // this.router.navigate(['search', this._searchTerm]);
  }

  moreInfo(item: any) {
    this.curListing = {};
    this.curListing = item;
    this.uploader = {};
    this.userService.getById(this.curListing.uploader_id).then(x => {
      if (x) {
        this.uploader = x[0];
        this.modal.open();
      }
    });
  }

  sendEmail(item: Textbook) {
    this.userService.sendEmail(JSON.stringify({ username: this.uploader.username, email: this.uploader.email, title: item.title }));
    this.modal.dismiss();
  }

  //Modal Stuff
  @ViewChild('mainModal')
  modal: ModalComponent;
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

  close() {
    this.modal.dismiss();
  }

}
function storageAvailable(type) {
  try {
    var storage = window[type],
      x = '__storage_test__';
    storage.setItem(x, x);
    storage.removeItem(x);
    return true;
  }
  catch (e) {
    return false;
  }
}