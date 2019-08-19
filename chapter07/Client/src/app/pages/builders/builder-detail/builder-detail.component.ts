import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Builder } from '../builder';
import { BuilderService } from '../_services/builder.service';

@Component({
	selector: 'app-builder-detail',
	templateUrl: './builder-detail.component.html',
	styleUrls: ['./builder-detail.component.scss']
})
export class BuilderDetailComponent implements OnInit {
	builder: Builder;
	isLoading: Boolean = false;

	constructor(private builderService: BuilderService, private route: ActivatedRoute) { }

	ngOnInit() {
		this.getBuilderDetail();
	}

	getBuilderDetail(): void {
		this.isLoading = true;
		const id = +this.route.snapshot.paramMap.get('id');
		this.builderService.getBuilderDetail(id).subscribe(
			builder => {
				this.isLoading = false;
				this.builder = builder['data'];
			}
		)
	}

}
