import { Component, Input, Output, EventEmitter, ViewChild, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router, Params } from '@angular/router';

import { User } from '../../api/user';
import { UserRepository } from '../../api/user-repository.service';

import { Textbook } from '../../api/textbook';
import { TextbookService } from '../../api/textbook.service';

// Modal
import { ModalComponent } from 'ng2-bs3-modal/ng2-bs3-modal';

@Component({
  moduleId: module.id,
  selector: 'main-navbar',
  templateUrl: './navbar-main.component.html',
  styleUrls: ['./navbar.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class NavbarMainComponent {
  user: any;
  textbook: any;
  _searchTerm: string;

  constructor(private router: Router,
    private textbookService: TextbookService,
    private userService: UserRepository) {
    this.user = {};
    this.textbook = {};
    this.user.username = localStorage.getItem('currentUsername');
    this.user.id = localStorage.getItem('currentUserid');
    this.user.avatar = localStorage.getItem('currentUseravatar');
    //this.userRepository.getByEmail(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password })).then(x => { this.user = x; });
  }

  ngOnInit() {
    var onLoad = (data) => {
      this.user.username = localStorage.getItem('currentUsername');
      this.user.id = localStorage.getItem('currentUserid');
      this.user.avatar = localStorage.getItem('currentUseravatar');
      // this.user.imagePath = localStorage.getItem('currentImagePath');
    };
  }

  newListing() {
    this.modal.open();
  }

  manageListing() {
    this.router.navigate(['listings']);
  }

  submitNewTextbook() {
    // Add post method for new listing
    // debugger;
    this.textbook.uploader_id = this.user.id;
    this.textbook.stat = 1;
    this.textbookService.addTextbook(this.textbook).then(x => this.user = x);
    this.textbook = {};
    //Dismiss modal
    this.modal.dismiss();
  }

  submitNewSupply() {
    // Add post method for new listing
    // debugger;
    this.textbook.uploader_id = this.user.id;
    this.textbook.stat = 1;
    this.textbookService.addSupply(this.textbook).then(x => this.user = x);
    this.textbook = {};
    //Dismiss modal
    this.modal.dismiss();
  }

  submitNewNote() {
    // Add post method for new listing
    // debugger;
    this.textbook.uploader_id = this.user.id;
    this.textbook.stat = 1;
    this.textbookService.addNote(this.textbook).then(x => this.user = x);
    this.textbook = {};
    //Dismiss modal
    this.modal.dismiss();
  }

  logout() {
    this.userService.logout().then(x => this.user = x);
    localStorage.removeItem('currentUserid');
    localStorage.removeItem('currentUsername');
    localStorage.removeItem('currentUseravatar');
    localStorage.removeItem('currentUseremail');
    this.router.navigate(['']);
  }

  search() {
    // Add get method and send search term or send search term with navigate
    debugger;
    if(this._searchTerm !== undefined)
      this.router.navigate(['search',this._searchTerm]);
    this.router.navigate(['search', ' ']);
  }

  homePage() {
    // Return to main search page
    this.router.navigate(['main']);
  }


  //Modal Stuff
  @ViewChild('navModal')
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