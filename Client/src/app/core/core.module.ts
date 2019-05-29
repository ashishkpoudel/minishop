import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';

import { ApiService } from './services';
import { ProductService } from './services';
import { CheckoutService } from './services';

@NgModule({
  declarations: [],
  providers: [
    ApiService,
    ProductService,
    CheckoutService
  ],
  imports: [
    CommonModule,
    HttpClientModule
  ]
})
export class CoreModule { }
