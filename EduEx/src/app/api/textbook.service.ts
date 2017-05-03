import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { Textbook } from './textbook';

@Injectable()
export class TextbookService {
  //private _apiUrl = `https://private-ea4cc-eduexchange.apiary-mock.com/textbooks`;
  private _apiUrl = `http://54.91.225.139/eduexchange/public/index.php/textbooks`;

  constructor(private http: Http) { }

  public getRecent(): Promise<Textbook[]> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/recent`;
    return this.http
      .get(url)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public getUserListings(id: number): Promise<Textbook[]> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/listings`;
    return this.http
      .get(`${url}/${id}`)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public listAll(): Promise<Textbook[]> {
    return this.http
      .get(this._apiUrl)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public search(searchTerm: string): Promise<Textbook[]> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/search`;
    // debugger;
    return this.http
      .get(`${url}/${searchTerm}`)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public openListings(id: number): Promise<Textbook[]> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/openlisting`;
    // debugger;
    return this.http
      .get(`${url}/${id}`)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public closedListings(id: number): Promise<Textbook[]> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/closelisting`;
    // debugger;
    return this.http
      .get(`${url}/${id}`)
      .toPromise()
      .then(x => x.json() as Textbook[])
      .catch(x => x.message);
  }

  public getById(id: number): Promise<Textbook> {
    return this.http
      .get(`${this._apiUrl}/${id}`)
      .toPromise()
      .then(x => x.json() as Textbook)
      .catch(x => x.message);
  }

  public addTextbook(textbook: Textbook): Promise<Textbook> {
    // debugger;
    // console.log(JSON.stringify(textbook));
    return this.http
      .post(this._apiUrl, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public addSupply(textbook: Textbook): Promise<Textbook> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/supplies`;
    return this.http
      .post(this._apiUrl, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public addNote(textbook: Textbook): Promise<Textbook> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/notes`;
    return this.http
      .post(this._apiUrl, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public updateTextbook(textbook: Textbook): Promise<Textbook> {
    console.log(textbook);
    return this.http
      .post(`${this._apiUrl}/${textbook.id}`, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public updateNotes(textbook: Textbook): Promise<Textbook> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/notes`;
    return this.http
      .post(`${url}/${textbook.id}`, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public updateSupplies(textbook: Textbook): Promise<Textbook> {
    var url = `http://54.91.225.139/eduexchange/public/index.php/supplies`;
    return this.http
      .post(`${url}/${textbook.id}`, JSON.stringify(textbook), { withCredentials: true })
      .toPromise()
      .then(x => x.json().data as Textbook)
      .catch(x => x.message);
  }

  public delete(textbook: Textbook): Promise<void> {
    return this.http
      .delete(`${this._apiUrl}/${textbook.id}`)
      .toPromise()
      .catch(x => x.message);
  }

}
