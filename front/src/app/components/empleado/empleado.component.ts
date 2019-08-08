import { Component, OnInit } from '@angular/core';
import { ServiceService } from 'src/app/services/service.service';
import { BaseComponent } from '../shared/base/base.component';
import { MatDialog, MatSnackBar } from '@angular/material';

@Component({
  selector: 'app-empleado',
  templateUrl: './empleado.component.html',
  styleUrls: ['./empleado.component.css']
})
export class EmpleadoComponent extends BaseComponent implements OnInit {
  constructor(
    private service: ServiceService,
    private dialogs: MatDialog,
    private snackBars: MatSnackBar
  ) {
    super(dialogs, snackBars, service);
  }

  ngOnInit() {
    // this.getAction(1);
  }
}
