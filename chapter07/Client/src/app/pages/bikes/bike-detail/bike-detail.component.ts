import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Bike } from '../bike';
import { BikeService } from '../_services/bike.service';
import { AuthService } from '../../auth/_services/auth.service';
import { User } from '../../auth/user';

@Component({
	selector: 'app-bike-detail',
	templateUrl: './bike-detail.component.html',
	styleUrls: ['./bike-detail.component.scss']
})
export class BikeDetailComponent implements OnInit {
	bike: Bike;
	isLoading: Boolean = false;
	userVote: number;
	builders: Array<Object> = [
		{ id: 1, name: 'Diamond Atelier' },
		{ id: 2, name: 'Deus Ex Machina\'s' },
		{ id: 3, name: 'Rough Crafts' },
		{ id: 4, name: 'Roldand Sands' },
		{ id: 5, name: 'Chopper Dave' }
	];

	constructor(private bikeService: BikeService, private route: ActivatedRoute, private auth: AuthService) { }

	ngOnInit() {
		this.getBikeDetail();
	}

	getBikeDetail(): void {
		this.isLoading = true;
		const id = +this.route.snapshot.paramMap.get('id');
		this.bikeService.getBikeDetail(id).subscribe(
			bike => {
				this.isLoading = false;
				this.bike = bike['data'];
				this.getUserVote();
			}
		)
	}

	protected getUserVote() {
		for (let i = 0; i < this.bike.ratings.length; i++) {
			if (this.bike.ratings[i].user_id === this.auth.currentUser.id) {
				this.userVote = this.bike.ratings[i].rating;
				break;
			}
		}
	}

	onVote(rating: number, id: number): void {
		if (this.checkUserVote(this.bike.ratings)) {
			alert('You already voted on this bike.');
			return;
		}

		id = +this.route.snapshot.paramMap.get('id');
		this.bikeService.voteOnBike(rating, id).subscribe(
			response => {
				this.userVote = response.data.rating;
				this.bike['average_rating'] = response.data.average_rating;
				this.bike.ratings.push(response.data);
			}
		)
	}

	checkUserVote(ratings: any[]): boolean {
		const currentUserId = this.auth.currentUser.id;
		let ratingUserId: number;
		Object.keys(ratings).forEach(i => { ratingUserId = ratings[i].user_id });
		return currentUserId === ratingUserId;
	}

	onSubmit(bike) {
		this.isLoading = true;
		const id = +this.route.snapshot.paramMap.get('id');
		this.bikeService.updateBike(id, bike.value).subscribe(
			response => {
				this.isLoading = false;
				this.bike = response['data'];
			}
		)
	}

	checkBikeOwner(): Boolean {
		if (this.bike.user) {
			return this.auth.currentUser.id === this.bike.user.id;
		}
		return false;
	}
}
