import { Component, OnInit, AfterViewInit } from '@angular/core';
import * as anime from 'animejs';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ServiceService } from 'src/app/services/service.service';
import { BaseComponent } from '../shared/base/base.component';
import { MatDialog, MatSnackBar } from '@angular/material';
import { LoadingComponent } from '../shared/loading/loading.component';
import { isNumber } from 'util';
declare var $: any;

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent extends BaseComponent
  implements OnInit, AfterViewInit {
  loginForm: FormGroup;

  constructor(
    private router: Router,
    private fb: FormBuilder,
    private service: ServiceService,
    private dialogs: MatDialog,
    private snackBars: MatSnackBar
  ) {
    super(dialogs, snackBars);
  }

  ngAfterViewInit() {
    $('.ml11 .letters').each(function() {
      $(this).html(
        $(this)
          .text()
          .replace(/([^\x00-\x80]|\w)/g, '<span class="letter">$&</span>')
      );
    });
    $('.letter').each(function() {
      $(this).mouseover(function() {
        anime({
          targets: 'letter',
          rotateY: 360
        });
      });
    });

    // let letter = document.getElementsByClassName('letter');
    const letters = anime
      .timeline({ loop: false })
      .add({
        targets: '.ml11 .line',
        scaleY: [0, 1],
        opacity: [0.5, 1],
        easing: 'easeOutExpo',
        duration: 1000
      })
      .add({
        targets: '.ml11 .line',
        translateX: [0, $('.lol').width()],
        easing: 'easeOutExpo',
        duration: 1000,
        delay: 100
      })
      .add({
        targets: '.ml11 .letter',
        opacity: [0, 1],
        easing: 'easeOutExpo',
        duration: 900,
        offset: '-=775',
        delay: function(el, i) {
          return 34 * (i + 1);
        }
      });

    letters.finished.then(erease);

    function erease() {
      anime
        .timeline()
        .add({
          targets: '.line1',
          opacity: 0,
          duration: 300,
          easing: 'easeOutExpo'
        })
        .add({
          targets: 'h5',
          opacity: [0, 1],
          duration: 1500,
          easing: 'easeOutExpo'
        });
    }

    const card = document.querySelector('.card');
    let playing = false;

    card.addEventListener('click', function() {
      if (playing) {
        return;
      }

      playing = true;
      anime({
        targets: card,
        scale: [{ value: 1 }, { value: 1.4 }, { value: 1, delay: 250 }],
        rotateY: { value: '+=180', delay: 200 },
        easing: 'easeInOutSine',
        duration: 400,
        complete: function(anim) {
          playing = false;
        }
      });
    });
  }

  ngOnInit() {
    this.loginForm = this.fb.group({
      usuario: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  afterCloseDialog(data) {
    console.log(data);
    this.openDialog(LoadingComponent, this.loadingMessage);
    this.service.setRegistro(data).subscribe((resp: any) => {
      console.log(resp);
      this.snackMessage = resp;
      this.openSnackBar();
      this.closeDialog();
    },
    error => {
      alert(error['error']);
      this.closeDialog();
    });
  }

  userLogin() {
    this.openDialog(LoadingComponent, this.loadingMessage);
    this.service.login(this.loginForm.value).subscribe(
      data => {
        sessionStorage.setItem('arqi', data['access_token']);
        this.router.navigate(['/admin/empleado']);
        this.closeDialog();
      },
      error => {
        alert(error['error']);
        this.closeDialog();
      }
    );
  }
}
