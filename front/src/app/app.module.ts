import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { LayoutModule } from '@angular/cdk/layout';
import { MaterialModule } from './shared/material.module';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { MainNavComponent } from './main-nav/main-nav.component';
import { LoadingComponent } from './components/shared/loading/loading.component';
import { EmpleadoComponent } from './components/empleado/empleado.component';
import { EmpleadoIngresarComponent } from './components/empleado-ingresar/empleado-ingresar.component';
import { EmpleadoActualizarComponent } from './components/empleado-actualizar/empleado-actualizar.component';
import { HtmlSanitizerPipe } from './pipes/html-sanitizer.pipe';
import { DataTableComponent } from './components/shared/data-table/data-table.component';
import { KeysPipe } from './pipes/keys.pipe';
import { DialogComponent } from './components/shared/dialog/dialog.component';

import { MAT_DATE_LOCALE } from '@angular/material';

// import { MatToolbarModule, MatButtonModule, MatSidenavModule, MatIconModule, MatListModule } from '@angular/material';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    MainNavComponent,
    LoadingComponent,
    EmpleadoComponent,
    EmpleadoIngresarComponent,
    EmpleadoActualizarComponent,
    HtmlSanitizerPipe,
    DataTableComponent,
    KeysPipe,
    DialogComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
    LayoutModule,
    /*
    MatToolbarModule,
    MatButtonModule,
    MatSidenavModule,
    MatIconModule,
    MatListModule
    */
  ],
  providers: [{ provide: MAT_DATE_LOCALE, useValue: 'es-ES' }],
  bootstrap: [AppComponent],
  entryComponents: [LoadingComponent]
})
export class AppModule { }
