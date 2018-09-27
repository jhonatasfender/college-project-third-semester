import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { PlaceService } from '../../services/place-service';
import { MenuPage } from '../menu/menu';
import { MapPage } from '../map/map';
import { PhotosPage } from '../photos/photos';
import { ReviewsPage } from '../reviews/reviews';

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
  public place: any;

  public workingHour: any;

  constructor(public nav: NavController, public placeService: PlaceService) {
    // get first place for example
    this.place = placeService.getItem(1);

    // get working hours
    this.workingHour = this.getWorkingHours(this.place.working_hours);
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
      tmpArr.push(arr[i]);
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
