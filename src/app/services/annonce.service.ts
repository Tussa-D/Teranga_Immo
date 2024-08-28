import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Annonce } from '../models/annonce.model';

@Injectable({
  providedIn: 'root'
})
export class AnnonceService {
  private apiUrl = 'http://localhost:8000/api'; // Ajustez l'URL selon votre backend

  constructor(private http: HttpClient) { }

  getAnnoncesRecentes(): Observable<Annonce[]> {
    return this.http.get<Annonce[]>(`${this.apiUrl}/annonces`);
  }
}