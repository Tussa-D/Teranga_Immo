import { Component, OnInit } from '@angular/core';
import { AnnonceService } from '../../services/annonce.service';
import { Annonce } from '../../models/annonce.model';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  annonces: Annonce[] = [];
  filteredAnnonces: Annonce[] = [];
  searchTerm: string = '';

  constructor(private annonceService: AnnonceService) { }

  ngOnInit(): void {
    this.loadAnnonces();
  }

  loadAnnonces(): void {
    this.annonceService.getAnnoncesRecentes().subscribe(
      (data: Annonce[]) => {
        this.annonces = data;
        this.filteredAnnonces = data;
      },
      error => {
        console.error('Erreur lors du chargement des annonces', error);
      }
    );
  }

  onSearch(): void {
    this.filteredAnnonces = this.annonces.filter(annonce =>
      annonce.titre.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
      annonce.description.toLowerCase().includes(this.searchTerm.toLowerCase())
    );
  }
}