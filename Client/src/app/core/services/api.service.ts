import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { environment } from 'src/environments/environment';

@Injectable()
export class ApiService {
    
    constructor(private http_client: HttpClient) { }

    get(path: string): Observable<any> {
        return this.http_client.get<any> (`${environment.api_url}${path}`)
            .pipe(catchError(err => this.handleError(err)));
    }

    post(path: string, data: any): Observable<any> {
        return this.http_client.post<any> (`${environment.api_url}${path}`, data, {headers: new HttpHeaders({'Accept': 'application/json'})})
            .pipe(catchError(err => this.handleError(err)));
    }

    private handleError(error: any) {
        return throwError(error);
    }
}