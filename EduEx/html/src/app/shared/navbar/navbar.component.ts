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
  _user = User;
  constructor(private textbookService: TextbookService,
              private userService: UserRepository) {
    // _user
  }


  newListing() {
    this.modal.open();
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