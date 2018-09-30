import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ReviewService } from '../../services/review-service';
import { PlaceDetailPage } from '../place-detail/place-detail';
import { ENV } from '@app/env';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-feed',
  templateUrl: 'feed.html'
})
export class FeedPage {
  public env = ENV;
  public reviews: any;

  constructor(
    public nav: NavController,
    public reviewService: ReviewService
  ) {
    // feed
    this.reviews = this.reviewService.getAll();
    this.loadResult();
  }

  public loadResult(resolve?) {
    this.reviewService.nextResult().subscribe(data => {
      console.log(data);
      for (let i = 0; i < Object.keys(data).length; i++) {
        const reviews = data[i];
        this.reviews.push(reviews)
      }
      if(resolve) {
        resolve();
      }
    }, err => {
      console.log(err);
    });
  }

  doInfinite(): Promise<any> {
    return new Promise((resolve) => {
      this.loadResult(resolve);
    })
  }

  // view a place
  viewPlace(id) {
    this.nav.push(PlaceDetailPage, { id: id });
  }
}
