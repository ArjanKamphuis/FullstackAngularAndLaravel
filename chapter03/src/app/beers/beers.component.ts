import { Component, OnInit } from '@angular/core';
import { BeersService } from './beers.service';

@Component({
  selector: 'app-beers',
  templateUrl: './beers.component.html',
  styleUrls: ['./beers.component.css']
})
export class BeersComponent implements OnInit {
  public beersList: any[];
  public requestError: any;

  constructor(private beers: BeersService) { }

  ngOnInit() {
    this.getBeers();
  }

  public getBeers() {
    return this.beers.get(1, 20).subscribe(
      response => this.handleResponse(response),
      error => this.handleError(error)
    );
  }

  protected handleResponse(response: any) {
    this.requestError = null;
    return this.beersList = response;
  }

  protected handleError(error: any) {
    return this.requestError = error;
  }

}
