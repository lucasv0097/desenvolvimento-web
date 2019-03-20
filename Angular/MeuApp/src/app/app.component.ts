import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  title = 'MeuApp';
  private count = 0;

    botaoclicado() {
      return this.count += 1;
    }
}
