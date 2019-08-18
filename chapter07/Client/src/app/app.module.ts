import { BrowserModule, Title } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { ServiceWorkerModule } from '@angular/service-worker';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { environment } from '../environments/environment';

import { AuthModule } from './pages/auth/auth.module';
import { BikesModule } from './pages/bikes/bikes.module';
import { BuildersModule } from './pages/builders/builders.module';
import { HomeModule } from './pages/home/home.module';
import { NavComponent } from './layout/nav/nav.component';

import { HttpErrorHandler } from './shared/_services/http-handle-error.service';
import { AppHttpInterceptorService } from './shared/_services/http-interceptor.service';

@NgModule({
  declarations: [
	AppComponent,
	NavComponent
  ],
  imports: [
	BrowserModule,
	AppRoutingModule,
	AuthModule,
	BikesModule,
	BuildersModule,
	HomeModule,
	ServiceWorkerModule.register('ngsw-worker.js', { enabled: environment.production })
  ],
  providers: [Title, HttpErrorHandler, {
	provide: HTTP_INTERCEPTORS,
	useClass: AppHttpInterceptorService,
	multi: true
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }
