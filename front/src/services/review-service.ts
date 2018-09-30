import { Injectable } from "@angular/core";
import { REVIEWS } from "./mock-reviews";
import { HttpClient } from '@angular/common/http';
import { ENV } from '@app/env';

@Injectable()
export class ReviewService {
  private reviews: any;

  constructor(public http: HttpClient) {
    this.reviews = REVIEWS;
  }

  public nextResult() {
    return this.http.get(
      ENV.url + 'api/reviews', {
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Accept": "application/json",
          "Content-Type": "application/json"
        }
      }
    );
  }

  public setNetResult() {
    this.nextResult().subscribe(data => {
      for (let i = 0; i < Object.keys(data).length; i++) {
        const reviews = data[i];
        REVIEWS.push(reviews);
        this.reviews.push(reviews);
      }
    }, err => {
      console.log(err);
    });
  }

  getAll() {
    return this.reviews;
  }

  getItem(id) {
    for (var i = 0; i < this.reviews.length; i++) {
      if (this.reviews[i].id === parseInt(id)) {
        return this.reviews[i];
      }
    }
    return null;
  }

  remove(item) {
    this.reviews.splice(this.reviews.indexOf(item), 1);
  }
}