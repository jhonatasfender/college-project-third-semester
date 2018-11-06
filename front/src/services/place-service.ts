import { Inject, Injectable } from "@angular/core";
import { PLACES } from "./mock-places";
import { HttpClient } from '@angular/common/http';
import { ENV } from '@app/env';
import { LoadingController } from 'ionic-angular';
import { SESSION_STORAGE, StorageService } from 'angular-webstorage-service';

const STORAGE_KEY: string = "places"

@Injectable()
export class PlaceService {
  private places: any;

  constructor(
    @Inject(SESSION_STORAGE) private storage: StorageService,
    public http: HttpClient,
    public loadingCtrl: LoadingController
  ) {
    this.singleton();
  }

  private singleton() {
    this.places = this.storage.get(STORAGE_KEY) || PLACES;
    if (!this.places.length) {
      let loading = this.loadingCtrl.create({
        content: 'Carregando os produtos!'
      });
      loading.present();
      this.http.get(
          ENV.url + 'api/products', {
            headers: {
              "Access-Control-Allow-Origin": "*",
              "Accept": "application/json",
              "Content-Type": "application/json"
            }
          }
        )
        .subscribe(data => {
          console.log(data);

          for (let i = 0; i < Object.keys(data).length; i++) {
            const place = data[i];
            this.places.push(place)
          }

          this.storage.set(STORAGE_KEY, this.places);

          loading.dismiss();
        }, err => {
          console.log(err);
          loading.dismiss();
        });
    }
  }

  getAll() {
    return this.places;
  }

  public getPlacesByCollectoin(id) {
    if (id == undefined) {
      return this.getAll();
    } else {
      let categories = new Array();
      for (var i = 0; i < this.places.length; i++) {
        if (this.places[i].category.id === parseInt(id)) {
          categories.push(this.places[i]);
        }
      }
      return categories;
    }
  }

  getItem(id) {
    for (var i = 0; i < this.places.length; i++) {
      if (this.places[i].id === parseInt(id)) {
        return this.places[i];
      }
    }
    return null;
  }

  remove(item) {
    this.places.splice(this.places.indexOf(item), 1);
  }
}