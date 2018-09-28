import {Component} from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {PlaceService} from '../../services/place-service';
import {MapPage} from '../map/map';
import {PhotosPage} from '../photos/photos';
import {ReviewsPage} from '../reviews/reviews';
import { ENV } from '@app/env';
import { SocialSharing } from '@ionic-native/social-sharing';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-place-detail',
  templateUrl: 'place-detail.html'
})
export class PlaceDetailPage {
  public env = ENV;
  public place:any;

  constructor(
    public nav:NavController, 
    private socialSharing: SocialSharing,
    public params: NavParams,
    public placeService:PlaceService
  ) {
    this.place = placeService.getItem(
      this.params.get("id")
    );
  }

  public share() {
    this.socialSharing.share(
      this.place.description,
      this.place.name,
      this.getImageBackground(this.place),
      ENV.url
      ).then(() => {
      console.log("deu certo");
    }).catch(() => {
      console.log("fudeu");
    });
    
  }

  public getImageBackground(place) {
    if(place != undefined && place.images.length != 0) {
      return ENV.url + 'storage/app/public/image/w_400,h_400/' + place.images[0].file;
    }
    return '';
  }

  // get limit elements for arr
  limitArray(arr, limit) {
    var tmpArr = [];

    for (var i = 0; i < limit; i++) {
      if(arr[i] != undefined) {
        tmpArr.push(arr[i]);
      }
    }

    return tmpArr;
  }

  // add bookmark
  addBookMark(place) {
    place.bookmarked = !place.bookmarked;
  }

  // go to map
  goToMap() {
    this.nav.push(MapPage);
  }

  // go to photos
  goToPhotos(id) {
    this.nav.push(PhotosPage, { id: id });
  }

  // go to reviews
  goToReviews() {
    this.nav.push(ReviewsPage);
  }
}
