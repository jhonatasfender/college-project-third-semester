import { Inject, Injectable } from "@angular/core";
import { COLLECTIONS } from "./mock-collections";
import { HttpClient } from '@angular/common/http';
import { ENV } from '@app/env';
import { LoadingController } from 'ionic-angular';
import { SESSION_STORAGE, StorageService } from 'angular-webstorage-service';

const STORAGE_KEY: string = "collection"

@Injectable()
export class CollectionService {
  private collections: any;

  constructor(
    @Inject(SESSION_STORAGE) private storage: StorageService,
    public http: HttpClient,
    public loadingCtrl: LoadingController
  ) {
    this.collections = this.storage.get(STORAGE_KEY) || COLLECTIONS;

    if (!this.collections.length) {
      let loading = this.loadingCtrl.create({
        content: 'Carregando as categorias!'
      });
      loading.present();
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

          this.storage.set(STORAGE_KEY, this.collections);

          loading.dismiss();
        }, err => {
          console.log(err);
          loading.dismiss();
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
    this.http.put(
      ENV.url + "api/categories/" + collection.id,
      JSON.stringify({
        "name": collection.name
      }), {
        headers: {
          "Access-Control-Allow-Methods": "*",
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
