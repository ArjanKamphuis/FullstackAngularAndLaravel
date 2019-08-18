import { HttpClient, HttpHeaders, HttpParams, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Observable, throwError } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';

import { environment } from '../../../../environments/environment';
import { User } from '../user';

const httpOptions = {
  headers: new HttpHeaders({
	'Content-Type': 'application/json'
  })
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
	public currentUser: User;
	private readonly apiUrl = environment.apiUrl;
	private registerUrl = this.apiUrl + '/register';
	private loginUrl = this.apiUrl + '/login';
	private logoutUrl = this.apiUrl + '/logout';

	constructor(private http: HttpClient, private router: Router) { }

	onRegister(user: User): Observable<User> {
		const request = JSON.stringify({ name: user.name, email: user.email, password: user.password });
		return this.http.post(this.registerUrl, request, httpOptions)
		.pipe(map((response: User) => {
			const token: string = response['access_token'];
			if (token) {
			this.setToken(token);
			this.getUser().subscribe();
			}
			return response;
		}), catchError(error => this.handleError(error)));
	}

	onLogin(user: User): Observable<User> {
		const request = JSON.stringify({ email: user.email, password: user.password });
		return this.http.post(this.loginUrl, request, httpOptions)
		.pipe(map((response: User) => {
			const token: string = response['access_token'];
			if (token) {
			this.setToken(token);
			this.getUser().subscribe();
			}
			return response;
		}), catchError(error => this.handleError(error)));
	}

	onLogout(): Observable<User> {
		return this.http.post(this.logoutUrl, httpOptions)
			.pipe(tap(() => {
				localStorage.removeItem('token');
				this.router.navigate(['/']);
			}));
	}

	setToken(token: string): void {
		localStorage.setItem('token', token);
	}

	getToken(): string {
		return localStorage.getItem('token');
	}

	getUser(): Observable<User> {
		return this.http.get(this.apiUrl + '/me').pipe(
			tap((user: User) => {
				this.currentUser = user;
			})
		);
	}

	isAuthenticated(): boolean {
		return !! this.getToken();
	}

	private handleError(error: HttpErrorResponse) {
		if (error.error instanceof ErrorEvent) {
			console.error('An error occured:', error.error.message);
		} else {
			return throwError(error);
		}
		return throwError('Oops something wrong happened here. Please try again later.');
	}
}
