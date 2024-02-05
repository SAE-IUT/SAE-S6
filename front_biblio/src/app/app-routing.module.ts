import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { AdherentsListComponent } from './adherents-list/adherents-list.component';
import { LivresListComponent } from './livres-list/livres-list.component';
import { EmpruntsListComponent } from './emprunts-list/emprunts-list.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
import { AuteursListComponent } from './auteurs-list/auteurs-list.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'adherents',  component: AdherentsListComponent },
  { path: 'auteurs',  component: AuteursListComponent },
  { path: 'categories',  component: CategoriesListComponent },
  { path: 'emprunts',  component: EmpruntsListComponent },
  { path: 'livres',  component: LivresListComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
