import { Injectable } from '@angular/core';
import { BaseService } from './base.service';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ServiceService extends BaseService {
  constructor(private _http: HttpClient) {
    super(_http);
  }

  login(data) {
    return this.post('login', data);
  }

  getMenu() {
    return this.get('menu');
  }

  getLists(data) {
    return this.post('listas', data);
  }

  getActions(id) {
    return this.post('actions', JSON.parse(JSON.stringify({ id: id })));
  }

  createUser(data) {
    return this.post('empleado', data);
  }

  updateUser(data) {
    return this.post('empleado/update', data);
  }

  getUsers() {
    return this.get('empleado/search');
  }

  createProyecto(data) {
    return this.post('proyecto', data);
  }

  updateProyecto(data) {
    return this.post('proyecto/update', data);
  }

  getProyectoSub(data) {
    return this.post('proyecto/searchSubprocesos', data);
  }

  getProyecto() {
    return this.get('proyecto/search');
  }

  createRegistro(data) {
    return this.post('registro', data);
  }

  updateRegistro(data) {
    return this.post('registro/update', data);
  }

  getRegistro(data) {
    return this.post('registro/search', data);
  }

  setRegistro(data) {
    return this.post('registro/set', data);
  }

  getInform(data) {
    return this.downloadFile('informe/search', data);
  }
}
