import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { HomeComponent } from './home/home.component';
import { AdherentsListComponent } from './adherents-list/adherents-list.component';
import { AuteursListComponent } from './auteurs-list/auteurs-list.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
import { EmpruntsListComponent } from './emprunts-list/emprunts-list.component';
import { LivresListComponent } from './livres-list/livres-list.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    AdherentsListComponent,
    AuteursListComponent,
    CategoriesListComponent,
    EmpruntsListComponent,
    LivresListComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
