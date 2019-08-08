import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { MainNavComponent } from './main-nav/main-nav.component';
import { EmpleadoComponent } from './components/empleado/empleado.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'admin', component: MainNavComponent, children: [
    { path: 'empleado', component: EmpleadoComponent },
  ]},
  { path: '**', pathMatch: 'full', redirectTo: 'home' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }