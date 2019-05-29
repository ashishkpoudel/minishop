import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { ApiService } from './api.service';

@Injectable()
export class CheckoutService {

    constructor(private api_service: ApiService) { }

    create(order: Object): Observable<any> {
        return this.api_service.post('/checkout', order);
    }
}