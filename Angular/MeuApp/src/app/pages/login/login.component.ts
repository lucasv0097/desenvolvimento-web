import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.sass']
})
export class LoginComponent implements OnInit {

  constructor() { }
  private count = 0;
  ngOnInit() {
  }
  botaoclicado() {
    return this.count ++;
  }
}
