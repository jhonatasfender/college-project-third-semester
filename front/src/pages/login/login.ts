import {Component} from '@angular/core';
import {NavController} from 'ionic-angular';
import {ForgotPasswordPage} from '../forgot-password/forgot-password';
import {SignUpPage} from '../sign-up/sign-up';
import {MainTabsPage} from '../main-tabs/main-tabs';
/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-login',
  templateUrl: 'login.html'
})
export class LoginPage {
  constructor(public nav: NavController) {}

  // go to forgot password page
  forgotPwd() {
    this.nav.push(ForgotPasswordPage);
  }

  public loginFacebook() {
    localStorage.setItem("logged", "logged");
  }

  public loginGoogle() {
    localStorage.setItem("logged", "logged");
  }

  // process login
  login() {
    // add your login code here
    this.nav.push(MainTabsPage);
    localStorage.setItem("logged", "logged");
  }

  // go to sign up page

  /*
    C:\Users\hoangduc\.android\

    keytool -exportcert -alias ebcbc059d5b3420cf3821c7c12a91f6f -keystore c:\www\app_pet_store\my-key.keystore | C:\OpenSSL\bin\openssl  sha1 -binary | C:\OpenSSL\bin\openssl  base64
    keytool -genkey -v -keystore my-key.keystore -alias ebcbc059d5b3420cf3821c7c12a91f6f -keyalg RSA -keysize 2048 -validity 10000
  */
  signUp() {
    // add our sign up code here
    this.nav.push(SignUpPage);
  }
}
