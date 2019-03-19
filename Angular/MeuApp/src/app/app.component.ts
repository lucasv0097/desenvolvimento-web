import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {

  public get value(): number {
    return this.count;
  }
  public set value(v: number) {
    this.count = v;
  }
  title = 'MeuApp';
  private count: number;

  botaoclicado() {
    this.count = this.count + 1;
    return this.count;
  }
}
