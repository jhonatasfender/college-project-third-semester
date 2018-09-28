import {Component} from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {PlaceService} from '../../services/place-service';
import { ENV } from '@app/env';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-photos',
  templateUrl: 'photos.html'
})
export class PhotosPage {
  public env = ENV;
  public place: any;

  constructor(
    public nav: NavController,
    public params: NavParams,
    public placeService: PlaceService
  ) {
    if (this.params.get("id")) {
      this.place = placeService.getItem(
        this.params.get("id")
      );
    }
  }
}
