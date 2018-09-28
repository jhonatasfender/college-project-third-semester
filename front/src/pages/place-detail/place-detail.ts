import {Component} from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {PlaceService} from '../../services/place-service';
import {MenuPage} from '../menu/menu';
import {MapPage} from '../map/map';
import {PhotosPage} from '../photos/photos';
import {ReviewsPage} from '../reviews/reviews';

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
  public place:any;

  public workingHour:any;

  constructor(
    public nav:NavController, 
    public params: NavParams,
    public placeService:PlaceService
  ) {
    console.log(this.params.get("id"));
    this.place = placeService.getItem(
      this.params.get("id")
    );

    // get working hours
    this.workingHour = this.getWorkingHours(this.place.working_hours);
  }

  public getImageBackground(place) {
    if(place != undefined && place.images.length != 0) {
      return 'http://127.0.0.1:8000/storage/app/public/image/w_400,h_400/' + place.images[0].file;
    }
    return '';
  }

  // get working hours in today
  getWorkingHours(hours) {
    var d = new Date();
    var currentDay = {
      from: null,
      to: null
    };
    var availableNow = false;

    availableNow = ((d.getHours() >= currentDay.from) && (d.getHours() <= currentDay.to));

    return {
      available: availableNow,
      from: currentDay.from,
      to: currentDay.to
    }
  }

  // get limit elements for arr
  limitArray(arr, limit) {
    var tmpArr = [];

    for (var i = 0; i < limit; i++) {
      if(arr[i] != undefined) {
        tmpArr.push(arr[i]);
      }
    }
    console.log(tmpArr);

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

  // to to menu page
  goToMenu() {
    this.nav.push(MenuPage);
  }

  // go to photos
  goToPhotos() {
    this.nav.push(PhotosPage);
  }

  // go to reviews
  goToReviews() {
    this.nav.push(ReviewsPage);
  }
}
