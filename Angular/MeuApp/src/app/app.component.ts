import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  title = 'MeuApp';
  count = 0;
  
  botaoclicado(){
    this.count = this.count +1;
    return this.count;
  }
}
