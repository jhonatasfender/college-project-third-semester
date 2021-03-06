import {Component} from '@angular/core';
import {NavController} from 'ionic-angular';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-account',
  templateUrl: 'account.html'
})
export class AccountPage {
  constructor(public nav: NavController) {}

  public exit() {
    localStorage.removeItem("logged");
    window.location.reload(true);
  }
}
