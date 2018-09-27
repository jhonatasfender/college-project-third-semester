import { Component } from '@angular/core';
import { NavController, Platform } from 'ionic-angular';

declare var google: any;

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-nearby',
  templateUrl: 'nearby.html'
})
export class NearbyPage {
  public map: any;

  constructor(
    public nav: NavController,
    public platform: Platform
  ) {

  }

  ngOnInit() {
    // init map
    this.initializeMap();
  }

  initializeMap() {
    var minZoomLevel = 12;
    var latlng = new google.maps.LatLng(39.305, -76.617);

    this.map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: minZoomLevel,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  }
}
