import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BeersComponent } from './beers.component';
import { BeersService } from './beers.service';

@NgModule({
  declarations: [BeersComponent],
  imports: [
    CommonModule
  ],
  providers: [BeersService]
})
export class BeersModule { }
