import { HttpClient, HttpHeaders, HttpParams, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { environment } from '../../../../environments/environment';
import { Bike } from '../bike';
import { HandleError, HttpErrorHandler } from '../../../shared/_services/http-handle-error.service';

@Injectable({
	providedIn: 'root'
})
export class BikeService {
	private readonly apiUrl = environment.apiUrl;
	private bikesUrl = this.apiUrl + '/bikes';
	private handleError: HandleError;
	  
	constructor(private http: HttpClient, httpErrorHandler: HttpErrorHandler) {
		this.handleError = httpErrorHandler.createHandleError('BikesService');
	}

	getBikes(): Observable<Bike[]> {
		return this.http.get<Bike[]>(this.bikesUrl).pipe(catchError(this.handleError('getBikes')));
	}

	getBikeDetail(id: number): Observable<Bike[]> {
		return this.http.get<Bike[]>(`${this.bikesUrl}/${id}`)
			.pipe(catchError(this.handleError('getBikeDetail')));
	}

	addBike(bike: Bike): Observable<Bike> {
		return this.http.post<Bike[]>(this.bikesUrl, bike)
			.pipe(catchError(this.handleError('addBike', [])));
	}

	updateBike(bike: Bike, id: number) : Observable<Bike> {
		return this.http.put<Bike>(`${this.bikesUrl}/${id}`, bike)
			.pipe(catchError(this.handleError('updateBike', [])));
	}

	deleteBike(id: number): Observable<Bike[]> {
		return this.http.delete<Bike[]>(`${this.bikesUrl}/${id}`, bike)
			.pipe(catchError(this.handleError('deleteBike')));
	}

	voteOnBike(vote: any, bike: number): Observable<any> {
		const rating = vote;
		return this.http.post<Bike>(`${this.bikesUrl}/${bike}/ratings`, { rating })
			.pipe(catchError(this.handleError('voteOnBike')));
	}
}
