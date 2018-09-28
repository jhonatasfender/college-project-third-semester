import { Injectable } from "@angular/core";
import { PLACES } from "./mock-places";
import { HttpClient } from '@angular/common/http';
import { ENV } from '@app/env';

@Injectable()
export class PlaceService {
  private places: any;

  constructor(public http: HttpClient) {
    this.places = PLACES;
    if (!PLACES.length) {
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
        }, err => {
          console.log(err);
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