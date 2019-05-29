import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { ApiService } from './api.service';
import { Product } from '../models';

@Injectable()
export class ProductService {

    constructor (private api_service: ApiService) { }

    getProducts(): Observable<Product[]> {
        return this.api_service.get('/products').pipe (
            map(response => {
                return response.data.map(p => Product.fromJson(p));
            })
        );
    }

    getProduct(id: number): Observable<Product> {
        return this.api_service.get(`/products/${id}`).pipe (
            map(response => {
                return Product.fromJson(response.data);
            })
        );
    }
}