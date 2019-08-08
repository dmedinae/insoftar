import { Component, OnInit } from "@angular/core";
import { MatDialog, MatSnackBar } from "@angular/material";
import { ServiceService } from "src/app/services/service.service";
import { BaseComponent } from "../shared/base/base.component";
import { LoadingComponent } from "../shared/loading/loading.component";

@Component({
  selector: "app-empleado-actualizar",
  templateUrl: "./empleado-actualizar.component.html",
  styleUrls: ["./empleado-actualizar.component.css"]
})
export class EmpleadoActualizarComponent extends BaseComponent
  implements OnInit {
  showTable = false;
  showForm = false;
  names = {
    nombres: "Nombres",
    apellidos: "Apellidos",
    cedula: "Cédula",
    telefono: "telefono",
    correo: "correo",
    edit: "Editar"
  };
  users;
  user;

  constructor(
    private service: ServiceService,
    private dialogs: MatDialog,
    private snackBars: MatSnackBar
  ) {
    super(dialogs, snackBars, service);
  }

  ngOnInit() {
    setTimeout(() => {
      this.getUsers();
    }, 0);
  }

  action(event) {
    this.showForm = true;
    this.user = event["element"];
    console.log(event);
  }

  getUsers() {
    this.openDialog(LoadingComponent, this.loadingMessage);
    this.service.getUsers().subscribe(data => {
      this.showTable = true;
      this.users = data;
      console.log(data);
      this.closeDialog();
    });
  }

  back() {
    this.showForm = false;
  }

  refresh() {
    this.showForm = false;
    this.getUsers();
  }
}
