import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { BaseComponent } from '../shared/base/base.component';
import { LoadingComponent } from '../shared/loading/loading.component';
import { MatDialog, MatSnackBar } from '@angular/material';
import { ServiceService } from 'src/app/services/service.service';

@Component({
  selector: 'app-empleado-ingresar',
  templateUrl: './empleado-ingresar.component.html',
  styleUrls: ['./empleado-ingresar.component.css']
})
export class EmpleadoIngresarComponent extends BaseComponent implements OnInit {
  file;
  userForm: FormGroup;
  @Input() userUpdate;
  @Output() action = new EventEmitter();
  updateId;
  /**emailPattern -> Es el patrón para la validación de email */
  emailPattern:string = '[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}';

  constructor(
    private fb: FormBuilder,
    private service: ServiceService,
    private dialogs: MatDialog,
    private snackBars: MatSnackBar
  ) {
    super(dialogs, snackBars, service);
  }

  ngOnInit() {
    this.userForm = this.fb.group({
      nombres: ['', Validators.required],
      apellidos: ['', Validators.required],
      cedula: ['', [Validators.required, Validators.pattern('^[0-9]*$')]],
      telefono: ['', [Validators.required, Validators.pattern('^[0-9]*$')]],
      correo: ['', [Validators.required, Validators.pattern(this.emailPattern)]]
    });

    if (this.userUpdate) {
      this.updateId = this.userUpdate['id'];
      const keys = Object.keys(this.userForm.value);
      for (const key of keys) {
        this.userForm.get(key).setValue(this.userUpdate[key]);
      }
    }
  }

  createUser() {
    if (this.updateId) {
      this.openDialog(LoadingComponent, this.loadingMessage);
      this.userForm.value['id'] = this.updateId;
      console.log(this.userForm.value);
      this.service.updateUser(this.userForm.value).subscribe(
        (data: any) => {
          console.log(data);
          this.snackMessage = data;
          this.openSnackBar();
          this.closeDialog();
          this.action.emit(true);
        },
        error => {
          console.log(error);
          alert(error['error']['msg']);
          this.closeDialog();
        }
      );
    } else {
      const DATA = {};
      Object.assign(DATA, this.userForm.value);
      const keys = Object.keys(DATA);
      console.log(keys);
      const FORM = new FormData();
      FORM.append('foto', this.file);
      for (const key of keys) {
        FORM.append(key, DATA[key]);
      }
      this.openDialog(LoadingComponent, this.loadingMessage);
      console.log(FORM.getAll('nombre'));
      this.service.createUser(this.userForm.value).subscribe(
        data => {
          console.log(data);
          this.snackMessage = 'Usuario creado exitosamente';
          this.openSnackBar();
          this.closeDialog();
        },
        error => {
          console.log(error);
          alert(error['error']['msg']);
          this.closeDialog();
        }
      );
    }
  }
}
