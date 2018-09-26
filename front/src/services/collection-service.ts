import { Injectable } from "@angular/core";
import { COLLECTIONS } from "./mock-collections";
import { HttpClient } from '@angular/common/http';

@Injectable()
export class CollectionService {
  private collections: any;

  constructor(public http: HttpClient) {
    this.collections = COLLECTIONS;

    if (!COLLECTIONS.length) {
      this.http.get(
        'http://127.0.0.1:8000/api/categories', {
          headers: {
            "Access-Control-Allow-Origin": "*",
            "Accept": "application/json",
            "Content-Type": "application/json"
          }
        }
      )
        .subscribe(data => {
          console.log(data, Object.keys(data).length);
          for (let i = 0; i < Object.keys(data).length; i++) {
            const category = data[i];
            category.background = "http://127.0.0.1:8000/storage/app/public/image/w_328,h_166/" + category.icon_image;
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

  remove(item) {
    this.collections.splice(this.collections.indexOf(item), 1);
  }
}
