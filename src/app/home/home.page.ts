import { Component } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BarcodeScanner } from '@ionic-native/barcode-scanner/ngx';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  url: string = null;

  users: any = [];

  name: string;
  lastname: string;
  birthday: string;
  image: string;

  constructor(private http: HttpClient) {
    this.fetch();
  }

  // Fetch all users
  fetch() {
    // Basic HTTP Request Sample
    this.http.get('http://192.168.137.1/ionic-php/user.php', {
      observe: 'response',
    })
      .subscribe((data: any) => {
        console.log(data);
        this.users = data.users;
      });
  }

  // Create New User
  newUser() {

    // Request Payload
    const payload = {
      name: this.name,
      lastname: this.lastname,
      birthday: this.birthday,
      image: this.image,
    };

    let headers = new HttpHeaders();
    headers.append('Content-Type', 'application/json');

    this.http.post('http://192.168.137.1/ionic-php/user.php', payload, {
      headers: headers,
    }).subscribe(response => {
      alert(response);
      this.fetch();
    });

  }

  // Barcode Scanner
  async scan() {
    // try {
    //   const res = await this.barcodeScanner.scan();
    //   this.url = res.text;
    // } catch (error) {
    //   console.error(error);
    // }
  }
}
