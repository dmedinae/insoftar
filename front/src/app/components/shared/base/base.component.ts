import { isUndefined, isString } from 'util';
import { MatDialogConfig, MatDialog, MatSnackBar } from '@angular/material';
import { ServiceService } from 'src/app/services/service.service';

export abstract class BaseComponent {
  deleteMessage = 'Eliminando';
  editMessage = 'Editando';
  createMessage = 'Creando';
  loadingMessage = 'Cargando';
  loginMessage = 'Iniciando Sesión';

  snackMessage = 'Mensaje del sistema';
  snackAction = 'Action';
  snackTime = 2000;

  numbersPattern = '^[0-9]*$';
  lettersPattern = '[^A-Za-z]+';

  allowedActions = [];

  maxDate = Date();

  constructor(
    private dialog?: MatDialog,
    private snackBar?: MatSnackBar,
    private _service?: ServiceService
  ) {}

  getErrorMessage(fieldFormGroup) {
    const ERROR = fieldFormGroup.errors;
    let message = '';
    if (!isUndefined(ERROR['required'])) {
      message = 'Debe ingresar este campo';
    } else if (
      !isUndefined(ERROR['minlength']) ||
      !isUndefined(ERROR['maxlength']) ||
      !isUndefined(ERROR['pattern'])
    ) {
      message = 'Formato inválido';
    }
    return message;
  }

  afterCloseDialog(data) {}

  openDialog(component, dataDialog?) {
    const dialogConfig = new MatDialogConfig();

    dialogConfig.disableClose = true;
    dialogConfig.autoFocus = true;
    dialogConfig.data = dataDialog;
    if (isString(dataDialog)) {
      dialogConfig.panelClass = 'dialog-loading';
    }

    const dialogRef = this.dialog.open(component, dialogConfig);
    dialogRef.afterClosed().subscribe(data => {
      if (data) {
        this.afterCloseDialog(data);
      }
    });
  }

  openDialogForm(component, dataDialog?) {
    const dialogConfig = new MatDialogConfig();

    dialogConfig.autoFocus = true;
    dialogConfig.data = dataDialog;
    dialogConfig.panelClass = 'dialog-form';

    const dialogRef = this.dialog.open(component, dialogConfig);
    dialogRef.afterClosed().subscribe(data => {
      if (data) {
        this.afterCloseDialog(data);
      }
    });
  }

  closeDialog() {
    this.dialog.closeAll();
  }

  openSnackBar() {
    this.snackBar.open(this.snackMessage, this.snackAction, {
      duration: this.snackTime
    });
  }

  getAction(id) {
    this._service.getActions(id).subscribe((data: any) => {
      this.allowedActions = data;
      console.log(data);
    });
  }

  generateSelector(identifier) {
    return `<app-${identifier}></app-${identifier}>`;
  }

  getLists(lists) {
    return this._service.getLists(lists);
  }
}
