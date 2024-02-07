import { Component } from '@angular/core';
import { ApiService } from './services/api.service';
import { Categorie } from './models/categorie';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'front_biblio';
  categories: Categorie[] = [];
  
 
  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getCategories().subscribe((data: Categorie[]) => {
      this.categories = data;
    });
  }
}
