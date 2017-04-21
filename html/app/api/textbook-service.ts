import { Textbook } from './textbook';
import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class TextbookService {
	private _apiUrl = `https://private-ea4cc-eduexchange.apiary-mock.com/textbooks`;

	constructor(private http: Http) { }

	public listAll(): Promise<Textbook[]> {
		return this.http
			.get(this._apiUrl)
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

	public add(textbook: Textbook): Promise<Textbook> {
		return this.http
			.post(this._apiUrl, textbook)
			.toPromise()
			.then(x => x.json().data as Textbook)
			.catch(x => x.message);
	}

	public update(textbook: Textbook): Promise<Textbook> {
		return this.http
			.put(`${this._apiUrl}/${textbook.id}`, textbook)
			.toPromise()
			.then(() => textbook)
			.catch(x => x.message);
	}

	public delete(textbook: Textbook): Promise<void> {
		return this.http
			.delete(`${this._apiUrl}/${textbook.id}`)
			.toPromise()
			.catch(x => x.message);
	}
}