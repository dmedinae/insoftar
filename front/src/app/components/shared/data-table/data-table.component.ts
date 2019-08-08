import {
  Component,
  EventEmitter,
  Input,
  OnChanges,
  ViewChild,
  Output
} from '@angular/core';
import { MatTableDataSource, MatPaginator, MatSort } from '@angular/material';

@Component({
  selector: 'app-data-table',
  templateUrl: './data-table.component.html',
  styleUrls: ['./data-table.component.css']
})
export class DataTableComponent implements OnChanges {
  @Input() names;
  @Input() data;
  @Output() action = new EventEmitter();
  dataSource;
  displayedColumns;
  displayedColumnsNames;
  crudTable = true;

  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;

  constructor() {}

  applyFilter(filterValue: string) {
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  ngOnChanges() {
    this.displayedColumns = Object.keys(this.names);
    this.displayedColumnsNames = this.names;
    this.dataSource = new MatTableDataSource(this.data);
    this.tableTranslate();
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
    console.log(this.dataSource);
  }

  tableTranslate() {
    this.paginator._intl.itemsPerPageLabel = 'Elementos por página';
    this.paginator._intl.firstPageLabel = 'Primera página';
    this.paginator._intl.lastPageLabel = 'Última página';
    this.paginator._intl.previousPageLabel = 'Anterior';
    this.paginator._intl.nextPageLabel = 'Siguiente';
  }

  buttonClick(action: string, element: any) {
    this.action.emit({action, element});
  }
}
