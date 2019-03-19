import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  title = 'MeuApp';
  private countgs  = 0;

  public get value(): number {
    return this.countgs;
  }
  public set value(v: number) {
    this.countgs = v;
  }

  botaoclicado() {
    this.countgs = this.countgs + 1;
    return this.countgs;
  }
}
