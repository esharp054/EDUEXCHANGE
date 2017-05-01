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
  selector: 'listingNavbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
  encapsulation: ViewEncapsulation.None
})

export class NavbarComponent {
  user: any;
  constructor(private router: Router,
              private textbookService: TextbookService,
              private userService: UserRepository) {
    this.user = {};
    this.user.username = localStorage.getItem('currentUsername');
    //this.userRepository.getByEmail(JSON.stringify({ username: this._userEntry.username, password: this._userEntry.password })).then(x => { this.user = x; });
  }

  ngOnInit() {
    var onLoad = (data) => {
      this.user.username = localStorage.getItem('currentUsername');
      // this.user.imagePath = localStorage.getItem('currentImagePath');
    };
  }

  newListing() {
    this.modal.open();
  }

  manageListing() {
    this.router.navigate(['listings']);
  }

  submitNewListing(){
    // Add post method for new listing

    //Dismiss modal
    this.modal.dismiss();
  }

  search() {
    // Add get method and send search term or send search term with navigate
    this.router.navigate(['search']);
  }

  homePage() {
    // Return to main search page
    this.router.navigate(['']);
  }


//Modal Stuff
  @ViewChild('navModal')
  modal: ModalComponent;

  close() {
    this.modal.close();
  }

  open() {
    this.modal.open();
  }

}