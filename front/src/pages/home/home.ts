import { Component } from '@angular/core';
import { App, NavController } from 'ionic-angular';
import { PlaceService } from '../../services/place-service';
import { SelectLocationPage } from '../select-location/select-location';
import { PlacesPage } from '../places/places';
import { PlaceDetailPage } from '../place-detail/place-detail';
import { SearchPage } from '../search/search';
import { BookmarksPage } from '../bookmarks/bookmarks';
import { MapPage } from '../map/map';
import { NearbyPage } from '../nearby/nearby';
import { CollectionService } from '../../services/collection-service';

import { ENV } from '@app/env';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  public env = ENV;

  // current location
  public currentLocation = 'Brasilia - UDF, DF';

  // list popular places
  public popularPlaces: any;
  public collections: any;

  constructor(
    public nav: NavController,
    public placeService: PlaceService,
    public collectionService: CollectionService,
    public app: App
  ) {
    this.popularPlaces = placeService.getAll();
    this.collections = collectionService.getAll();
  }

  public limitPlace($place) {
    if ($place != undefined) {
      return $place.slice(0, 6);
    }
    return $place;
  }

  public limitCategory(collections) {
    if (collections != undefined) {
      return collections.slice(0, 6);
    }
    return collections;
  }

  public slideImages($place) {
    var $imgs = new Array();
    $place.map(function (element) {
      element.images.map(function (img) {
        if (img.file != undefined) {
          $imgs.push(ENV.url + 'storage/app/public/image/w_400,h_400/' + img.file);
        }
      });
    });

    return $imgs.slice(0, 15);
  }

  // go to select location page
  selectLocation() {
    this.nav.push(SelectLocationPage);
  }

  // go to places
  viewPlaces(id) {
    this.app.getRootNav().push(PlacesPage, { id: id });
  }

  // view a place
  viewPlace(id) {
    this.app.getRootNav().push(PlaceDetailPage, { id: id });
  }

  // go to search page
  goToSearch() {
    this.app.getRootNav().push(SearchPage);
  }

  // go to bookmarks page
  goToBookmarks() {
    this.app.getRootNav().push(BookmarksPage);
  }

  // view map
  goToMap() {
    this.app.getRootNav().push(MapPage);
  }

  // view nearby page
  goToNearBy() {
    this.app.getRootNav().push(NearbyPage);
  }
}
