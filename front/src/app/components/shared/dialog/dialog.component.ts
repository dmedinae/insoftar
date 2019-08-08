import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

@Component({
  selector: 'app-dialog',
  templateUrl: './dialog.component.html',
  styleUrls: ['./dialog.component.css']
})
export class DialogComponent implements OnInit {
  names;
  keysDatos;
  datos;
  dataReturn;

  constructor(
    private dialogRef: MatDialogRef<DialogComponent>,
    @Inject(MAT_DIALOG_DATA) data
  ) {
    console.log(data);
    this.keysDatos = Object.keys(data['keys']);
    this.names = data['keys'];
    this.datos = data['data'];
    this.dataReturn = data['dataReturn'];
  }

  ngOnInit() {}

  save() {
    this.dialogRef.close(this.dataReturn);
  }

  close() {
    this.dialogRef.close();
  }
}
