import { Injectable } from "@angular/core";
import { COLLECTIONS } from "./mock-collections";
import { HttpClient } from '@angular/common/http';
import { ENV } from '@app/env';

@Injectable()
export class CollectionService {
  private collections: any;

  constructor(public http: HttpClient) {
    this.collections = COLLECTIONS;

    if (!COLLECTIONS.length) {
      this.http.get(
        ENV.url + 'api/categories', {
          headers: {
            "Access-Control-Allow-Origin": "*",
            "Accept": "application/json",
            "Content-Type": "application/json"
          }
        }
      )
        .subscribe(data => {
          for (let i = 0; i < Object.keys(data).length; i++) {
            const category = data[i];
            category.background = ENV.url + "storage/app/public/image/w_328,h_166/" + category.icon_image;
            this.collections.push(category)
          }
        }, err => {
          console.log(err);
        });
    }
  }

  getAll() {
    return this.collections;
  }

  getItem(id) {
    for (var i = 0; i < this.collections.length; i++) {
      if (this.collections[i].id === parseInt(id)) {
        return this.collections[i];
      }
    }
    return null;
  }

  public update(collection) {
    this.http.post(
      ENV.url + "api/categories/" + collection.id,
      JSON.stringify(collection),
       {
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Accept": "application/json",
          "Content-Type": "application/json"
        }
      }
    ).subscribe(data => {
      console.log(data);
    }, err => {
      console.log(err);
    });
  }

  remove(item) {
    this.collections.splice(this.collections.indexOf(item), 1);
  }
}
