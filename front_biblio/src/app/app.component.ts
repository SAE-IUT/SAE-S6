import { Component } from '@angular/core';
import { ApiService } from './services/api.service';
import { Categorie } from './models/categorie';
import { Livre } from './models/livre';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'front_biblio';
  categories: Categorie[] = [];
  livres: Livre[] = [];
  selectedLivres: string = '';
  
  constructor(private apiService: ApiService, private router: Router) {}

  ngOnInit(): void {
    this.apiService.getCategories().subscribe((data: Categorie[]) => {
      this.categories = data;
    });
    
    this.apiService.getLivres().subscribe((data: Livre[]) => {
      this.livres = data;      
    });
    
  }

  onSearch(): void {
    if (this.selectedLivres.trim() !== '') {
      this.router.navigateByUrl('/livres/' + this.selectedLivres.trim());
    }
  }
}
