export class Annonce {
    id: number;
    titre: string;
    date_publication: Date;  // Utilisation de `Date` pour représenter la date
    description: string;
    prix: number;
    image?: string;  // Le `?` indique que ce champ est optionnel
    video?: string;
    bien_id: number;
    proprietaire_id: number;
  
    constructor(
      id: number,
      titre: string,
      date_publication: Date,
      description: string,
      prix: number,
      bien_id: number,
      proprietaire_id: number,
      image?: string,
      video?: string,
    ) {
      this.id = id;
      this.titre = titre;
      this.date_publication = date_publication;
      this.description = description;
      this.prix = prix;
      this.bien_id = bien_id;
      this.proprietaire_id = proprietaire_id;
      this.image = image;
      this.video = video;
    }
  }
  