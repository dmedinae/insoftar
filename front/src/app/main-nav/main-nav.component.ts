import { Component, OnInit } from '@angular/core';
import { BreakpointObserver, Breakpoints } from '@angular/cdk/layout';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { ServiceService } from '../services/service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-main-nav',
  templateUrl: './main-nav.component.html',
  styleUrls: ['./main-nav.component.css']
})
export class MainNavComponent implements OnInit {

  menu = [];

  isHandset$: Observable<boolean> = this.breakpointObserver
    .observe(Breakpoints.Handset)
    .pipe(map(result => result.matches));

  constructor(
    private router: Router,
    private breakpointObserver: BreakpointObserver,
    private service: ServiceService
  ) {}

  ngOnInit() {
    this.service.getMenu().subscribe((data: any) => {
      this.menu = data;
      console.log(data);
    });
  }

  logOut () {
    this.router.navigate([`/`]);
    sessionStorage.removeItem('arqi');
  }

  goTo(component) {
    this.router.navigate([`admin/${component}`]);
  }
}
