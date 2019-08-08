import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EmpleadoIngresarComponent } from './empleado-ingresar.component';

describe('EmpleadoIngresarComponent', () => {
  let component: EmpleadoIngresarComponent;
  let fixture: ComponentFixture<EmpleadoIngresarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EmpleadoIngresarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EmpleadoIngresarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
