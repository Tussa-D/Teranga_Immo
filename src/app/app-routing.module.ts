import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component'; // Import du composant Home

const routes: Routes = [
  { path: '', component: HomeComponent }, // Route vers la page d'accueil
  { path: 'home', component: HomeComponent } // Optionnel : redirige toutes les routes inconnues vers la page d'accueil
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }



