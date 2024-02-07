import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { ActivatedRoute } from '@angular/router';
import { Livre } from '../models/livre';

@Component({
  selector: 'app-livre-detail',
  templateUrl: './livre-detail.component.html',
  styleUrl: './livre-detail.component.css'
})
export class LivreDetailComponent {
  loading = true;
  livres: Livre[] = [];

  constructor(private apiService: ApiService, private route: ActivatedRoute) {}

  ngOnInit(): void {
    const titre = this.route.snapshot.params['titre'];

    if (titre) {
      this.apiService.getLivreByTitre(titre).subscribe((data: Livre[]) => {
        this.livres = data;
        console.log(this.livres);
      });

      setTimeout(() => {
        this.loading = false;
  
      }, 500);
    }
  }
}
