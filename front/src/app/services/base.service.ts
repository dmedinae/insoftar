import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json'
  })
};

export class BaseService {
  HttpUrl: string = environment.httpUrl;

  constructor(private http: HttpClient) {}

  setToken() {
    if (sessionStorage.getItem('arqi')) {
      httpOptions.headers = httpOptions.headers.set(
        'Authorization',
        `Bearer ${sessionStorage.getItem('arqi')}`
      );
    }
  }

  get(url: string) {
    this.setToken();
    return this.http.get(this.HttpUrl + url, httpOptions);
  }

  post(url: string, data: JSON) {
    this.setToken();
    return this.http.post(this.HttpUrl + url, data, httpOptions);
  }

  delete(url: string, id: string) {
    this.setToken();
    return this.http.delete(this.HttpUrl + url + id, httpOptions);
  }

  downloadFile(url: string, data) {
    const options = {
      headers: new HttpHeaders({
        Authorization: `Bearer ${sessionStorage.getItem('arqi')}`
      })
    };
    options.headers.append('responseType', 'blob');
    return this.http.post(this.HttpUrl + url, data, {
      headers: options.headers,
      responseType: 'blob' as 'json'
    });
  }
}
