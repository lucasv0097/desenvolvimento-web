import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'meu-app';

  arrayNomes = [
    "Adélia Hilário",
    "António Gentil",
    "Brenda Castelo",
    "Diana Sales",
    "Flávia Ochoa"
];
}
