import { Injectable } from '@angular/core';
import { Http } from '@angular/http';

import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

import { Textbook } from './textbook';

@Injectable()
export class SearchService {

  constructor( private http: Http ) { }

  search(term: string): Observable<Textbook[]> {
    return this.http
      .get(`http://54.91.225.139/eduexchange/public/index.php/textbooks/?title=${term}`)
      .map(response => response.json().data as Textbook[]);
  }

}
