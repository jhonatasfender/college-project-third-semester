import { Component } from '@angular/core';
import { App, NavController, ModalController, NavParams } from 'ionic-angular';
import { PlaceService } from '../../services/place-service';
import { FiltersPage } from '../filters/filters';
import { PlaceDetailPage } from '../place-detail/place-detail';
import { SearchPage } from '../search/search';
import { ENV } from '@app/env';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-places',
  templateUrl: 'places.html'
})
export class PlacesPage {
  public env = ENV;
  // list of places
  public places: any;

  constructor(
    public nav: NavController,
    public placeService: PlaceService,
    public app: App,
    public params: NavParams,
    public modalCtrl: ModalController
  ) {
    this.places = placeService.getPlacesByCollectoin(
      this.params.get("id")
    );
  }

  // get limit elements for arr
  limitArray(arr, limit) {
    var tmpArr = [];
    if (arr != undefined) {
      for (var i = 0; i < limit; i++) {
        if (arr[i]) {
          tmpArr.push(arr[i]);
        }
      }
    }

    return tmpArr;
  }

  // show filters
  showFilters() {
    let filterModal = this.modalCtrl.create(FiltersPage);
    filterModal.present();
  }

  // view a place
  viewPlace(id) {
    this.nav.push(PlaceDetailPage, { id: id });
  }

  // go to search page
  goToSearch() {
    this.app.getRootNav().push(SearchPage);
  }
}
