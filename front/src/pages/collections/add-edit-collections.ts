import { Component, Input, Output, EventEmitter } from '@angular/core';
import { App, NavController } from 'ionic-angular';
import { CollectionService } from '../../services/collection-service';

/*
 Generated class for the LoginPage page.

 See http://ionicframework.com/docs/v2/components/#navigation for more info on
 Ionic pages and navigation.
 */
@Component({
  selector: 'page-add-edit-collections',
  templateUrl: 'add-edit-collections.html'
})
export class AddEditCollectionsPage {
  @Output() private close = new EventEmitter();
  @Input() private collection: any;

  constructor(
    public nav: NavController,
    public collectionService: CollectionService,
    public app: App
  ) {
  }

  ngOnInit() {
    console.log(this.collection);
  }

  public closeModal() {
    this.close.emit();
  }

  public submit() {
    this.collectionService.update(this.collection);
  }
}
