import { Component, OnInit } from '@angular/core';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.sass']
})
export class LoginComponent implements OnInit {
  private _customername: string;
  counter = 0;
  clickMessage = '';
  constructor() { }
  ngOnInit() {
  }

  get customerName(): string {
    return this._customername;
  }
  set customerName(v: string) {
    this._customername = v;
    if (v === 'lucas') {
        alert('hello lucas');
    }
  }
  onClickMe(){
    return alert(this.clickMessage = 'voce clicou');
  }
  contador() {
    return this.counter++;
  }
}
