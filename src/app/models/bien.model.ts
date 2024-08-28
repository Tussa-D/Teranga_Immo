export class Bien {
    id: number;
    titre: string;
    description: string;
    prix: number;
    Nbpiece: number;
    adresse: string;
    surface: number;
    type: string;
    video?: string;  
    image?: string;  
    statut: 'Disponible' | 'Sous Offre' | 'Vendu' | 'Retiré'; 
    proprietaire_id: number;
  
    constructor(
      id: number,
      titre: string,
      description: string,
      prix: number,
      Nbpiece: number,
      adresse: string,
      surface: number,
      type: string,
      statut: 'Disponible' | 'Sous Offre' | 'Vendu' | 'Retiré',
      proprietaire_id: number,
      video?: string,
      image?: string
    ) {
      this.id = id;
      this.titre = titre;
      this.description = description;
      this.prix = prix;
      this.Nbpiece = Nbpiece;
      this.adresse = adresse;
      this.surface = surface;
      this.type = type;
      this.statut = statut;
      this.proprietaire_id = proprietaire_id;
      this.video = video;
      this.image = image;
    }
  }
  