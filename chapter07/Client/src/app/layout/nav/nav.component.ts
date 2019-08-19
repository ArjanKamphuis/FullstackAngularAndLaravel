import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

import { AuthService } from '../../pages/auth/_services/auth.service';

@Component({
	selector: 'app-nav',
	templateUrl: './nav.component.html',
	styleUrls: ['./nav.component.scss']
})
export class NavComponent implements OnInit {

	constructor(private titleTagServe: Title, public auth: AuthService) { }
	
	setTitle(pageTitle: string) {
		this.titleTagServe.setTitle(pageTitle);
	}

	ngOnInit() {
		this.auth.getUser().subscribe();
	}

	onLogout() {
		this.auth.onLogout().subscribe();
	}
}
