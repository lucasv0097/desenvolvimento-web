import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'meu-app';
alert() {
  Swal({
    title: 'success!',
    text: 'you clicked',
    type: 'success',
    confirmButtonText: 'Cool'
  })
}
}
