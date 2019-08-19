import { Component, OnInit } from '@angular/core';

import { Bike} from '../bike';
import { BikeService } from '../_services/bike.service';
import { AuthService } from '../../auth/_services/auth.service';

@Component({
	selector: 'app-bike-list',
	templateUrl: './bike-list.component.html',
	styleUrls: ['./bike-list.component.scss']
})
export class BikeListComponent implements OnInit {
	bikes: Bike[];
	isLoading: Boolean = false;
	public searchText: string;

	constructor(private bikeService: BikeService, public auth: AuthService) { }

	ngOnInit() {
		this.getBikes();
	}

	getBikes(): void {
		this.isLoading = true;
		this.bikeService.getBikes().subscribe(
			response => this.handleResponse(response),
			error => this.handleError(error)
		);
	}

	protected handleResponse(response: Bike[]) {
		this.isLoading = false;
		this.bikes = response;
	}

	protected handleError(error: any) {
		this.isLoading = false;
		console.error(error);
	}
}
