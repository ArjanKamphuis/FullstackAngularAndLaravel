import { NgModule } from '@angular/core';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';


import { BikesRoutingModule } from './bikes-routing.module';
import { BikesComponent } from './bikes.component';
import { BikeDetailComponent } from './bike-detail/bike-detail.component';
import { BikeListComponent } from './bike-list/bike-list.component';
import { BikeSearchPipe } from './_pipes/bike-search.pipe';


@NgModule({
  declarations: [BikesComponent, BikeDetailComponent, BikeListComponent, BikeSearchPipe],
  imports: [
    CommonModule,
    NgbModule,
    FormsModule,
    BikesRoutingModule
  ]
})
export class BikesModule { }
