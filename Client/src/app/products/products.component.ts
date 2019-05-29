import { Component, OnInit } from '@angular/core';

import { ProductService } from 'src/app/core';
import { Product } from 'src/app/core';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  products: Product[];

  constructor(private product_service: ProductService) { }

  ngOnInit() {
    this.product_service.getProducts().subscribe (
      data => {
        this.products = data;
      }
    )
  }

}
