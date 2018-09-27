import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { SplashScreen } from '@ionic-native/splash-screen';
import { StatusBar } from '@ionic-native/status-bar';
import { HttpClientModule } from '@angular/common/http';
import { CollectionsPage } from './collections';
import { AddEditCollectionsPage } from './add-edit-collections';


// import services
import { CollectionService } from '../../services/collection-service';
// end import services

@NgModule({
  declarations: [
    CollectionsPage,
    AddEditCollectionsPage
  ],
  imports: [
    HttpClientModule,
    BrowserModule,
    IonicModule.forRoot(CollectionsPage, {
      platforms: {
        android: {
          tabsPlacement: 'top',
          tabsLayout: 'title-hide'
        },
        windows: {
          tabsLayout: 'title-hide'
        }
      }
    })
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    CollectionsPage,
    AddEditCollectionsPage
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
  providers: [
    CollectionService,
    StatusBar,
    SplashScreen,
    { provide: ErrorHandler, useClass: IonicErrorHandler }
  ]
})
export class CollectionsModule { }
