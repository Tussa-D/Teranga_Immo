
<main>
    <article>

      <!-- 
        - #HERO
      -->
      <!-- resources/views/recherche_avancee.blade.php -->


<section class="hero" id="home">
  <div class="container">

    <div class="hero-content">

      <p class="hero-subtitle">
        <ion-icon name="home"></ion-icon>

        <span>Teranga Immo</span>
      </p>

      <h2 class="h1 hero-title">Trouvez la Maison de Vos Rêves avec Nous</h2>

      <p class="hero-text">
        Teranga Immo est une entreprise spécialisée dans la vente et la location de biens immobiliers.
        Notre nom, "Teranga", qui signifie "hospitalité" en wolof, reflète notre engagement à offrir un accueil chaleureux et un service exceptionnel à tous nos clients.
      </p>

      <button class="btn">Faire une Demande</button>

    </div>

    <figure class="hero-banner">
      <img src="./asset/assets/images/hero-banner.png" alt="Modèle de maison moderne" class="w-100">
    </figure>

  </div>
</section>



<section class="recherche-avancee" id="recherche-avancee">
      <div class="recherche-avancee">
        <h2 class="description">RECHERCHE AVANCÉE</h2>
      
        <form action="{{ route('bien.search') }}" method="POST">
            @csrf

            <div class="champs-recherche" style="background-image: url('asset/images/télécharger.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 10px;">                
                <div class="options">
                    <label>
                        <input type="radio" name="action" value="louer" {{ old('action') === 'louer' ? 'checked' : '' }}> Louer
                    </label>
                    <label>
                        <input type="radio" name="action" value="acheter" {{ old('action') === 'acheter' ? 'checked' : '' }}> Acheter
                    </label>
                    <label>
                        <input type="radio" name="action" value="estimer" {{ old('action') === 'estimer' ? 'checked' : '' }}> Estimer
                    </label>
                </div>
      
                <div class="champ-saisie">
                    <label for="localisation">Dans quelle ville ? Quartier ?</label>
                    <input type="text" id="localisation" name="localisation" placeholder="Ville, quartier" value="{{ old('localisation') }}">
                </div>
      
                <div class="champ-saisie">
                    <label for="prix_min">Prix Min (€)</label>
                    <input type="number" id="prix_min" name="prix_min" placeholder="€" value="{{ old('prix_min') }}">
                </div>
      
                <div class="champ-saisie">
                    <label for="prix_max">Prix Max (€)</label>
                    <input type="number" id="prix_max" name="prix_max" placeholder="€" value="{{ old('prix_max') }}">
                </div>
      
                <div class="champ-saisie">
                    <label for="Nbpiece">Nombre de pièces</label>
                    <input type="number" id="Nbpiece" name="Nbpiece" placeholder="Nombre de pièces" value="{{ old('Nbpiece') }}">
                </div>
      
                <div class="type-bien">
                    <label>Type de Bien :</label>
                    <label>
                        <input type="checkbox" name="type[]" value="maison" {{ in_array('maison', old('type', [])) ? 'checked' : '' }}> Maison
                    </label>
                    <label>
                        <input type="checkbox" name="type[]" value="appartement" {{ in_array('appartement', old('type', [])) ? 'checked' : '' }}> Appartement
                    </label>
                </div>
      
                <div class="groupe-boutons">
                    <button type="reset" class="btn-reset">RÉINITIALISER</button>
                    <button type="submit" class="btn-rechercher">RECHERCHER</button>
                    
                </div>
            </div>
           
        </form>
      
       
    </div>
    
  </section>
      <!-- 
        - #ABOUT
      -->

      <section class="about" id="about"> 
        <div class="container">
    
            <figure class="about-banner">
                <img src="./asset/assets/images/about-banner-1.png" alt="Intérieur de la maison">
                <img src="./asset/assets/images/about-banner-2.jpg" alt="Intérieur de la maison" class="abs-img">
            </figure>
    
            <div class="about-content">
    
                <p class="section-subtitle">À propos de nous</p>
    
                <h2 class="h2 section-title">le leader de l'immobilier digital</h2>
    
                <p class="about-text">
                  L'équipe de TerangaImmo repose sur des professionnels expérimentés et dynamiques,
                   passionnés par le secteur immobilier et engagés à garantir la satisfaction de notre clientèle
                
                </p>
    
                <ul class="about-list">
    
                    <li class="about-item">
                        <div class="about-item-icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </div>
    
                        <p class="about-item-text">Innovation </p>
                    </li>
    
                    <li class="about-item">
                        <div class="about-item-icon">
                            <ion-icon name="leaf-outline"></ion-icon>
                        </div>
    
                        <p class="about-item-text">Beau cadre environnant</p>
                    </li>
    
                    <li class="about-item">
                        <div class="about-item-icon">
                            <ion-icon name="wine-outline"></ion-icon>
                        </div>
    
                        <p class="about-item-text">Style de vie exceptionnel</p>
                    </li>
    
                    <li class="about-item">
                        <div class="about-item-icon">
                            <ion-icon name="shield-checkmark-outline"></ion-icon>
                        </div>
    
                        <p class="about-item-text">Sécurité et Intégrité</p>
                    </li>
    
                </ul>
    
                <p class="callout">
                  "Chez Teranga Immo, nous croyons en l'hospitalité.
                   Découvrez le Sénégal à travers des logements alliant confort, sécurité et style"
                  
                </p>
    
                <a href="#service" class="btn">Nos services</a>
    
            </div>
    
        </div>
    </section>
    



      <!-- 
        - #SERVICE
      -->
      <section class="service" id="service">
        <div class="container">
      
          <p class="section-subtitle">Nos Services</p>
      
          <h2 class="h2 section-title">Notre Principal Objectif</h2>
      
          <ul class="service-list">
      
            <li>
              <div class="service-card">
      
                <div class="card-icon">
                  <img src="./asset/assets/images/service-1.png" alt="Icône de service">
                </div>
      
                <h3 class="h3 card-title">
                  <a href="#">Acheter un bien</a>
                </h3>
      
                <p class="card-text">
                  Plusieurs  bien à vendre disponibles sur notre site, nous pouvons vous aider à trouver celle qui deviendra votre chez-vous.
                </p>
      
                <a href="/listbienHome" class="card-link">
                  <span>Trouver un  bien </span>
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </a>
      
              </div>
            </li>
      
            <li>
              <div class="service-card">
      
                <div class="card-icon">
                  <img src="./asset/assets/images/service-2.png" alt="Icône de service">
                </div>
      
                <h3 class="h3 card-title">
                  <a href="#">Louer un bien</a>
                </h3>
      
                <p class="card-text">
                  Plusieurs  maisons,appartements à louer disponibles sur notre site, nous vous aidons à trouver celle qui vous conviendra.
                </p>
      
                <a href="/listbienHome" class="card-link">
                  <span>Trouver un bien</span>
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </a>
      
              </div>
            </li>
      
            <li>
              <div class="service-card">
      
                <div class="card-icon">
                  <img src="./asset/assets/images/service-3.png" alt="Icône de service">
                </div>
      
                <h3 class="h3 card-title">
                  <a href="#">Vendre un bien</a>
                </h3>
      
                <p class="card-text">
                  "Découvrez nos packs de services dédiés à la vente de biens immobiliers !
                   choisissez le pack adapté pour maximiser votre visibilité
                </p>
      
                <a href="/vendreBien" class="card-link">
                  <span>Vendre un bien</span>
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </a>
      
              </div>
            </li>
      
          </ul>
      
        </div>
      </section>
      




      <!-- 
        - #PROPERTY
      -->
    
 




      <!-- 
        - #FEATURES
      -->
      <section class="features">
        <div class="container">
      
          <p class="section-subtitle">Nos Services</p>
      
          <h2 class="h2 section-title">Équipements du Bâtiment</h2>
      
          <ul class="features-list">
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="car-sport-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Espace de Parking</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="water-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Piscine</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="shield-checkmark-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Sécurité Privée</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="fitness-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Centre Médical</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="library-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Bibliothèque</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="bed-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Chambres</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="home-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Maisons Equipes</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
            <li>
              <a href="#" class="features-card">
      
                <div class="card-icon">
                  <ion-icon name="football-outline"></ion-icon>
                </div>
      
                <h3 class="card-title">Aire de Jeux pour Enfants</h3>
      
                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
      
              </a>
            </li>
      
          </ul>
      
        </div>
      </section>
      




      <!-- 
        - #BLOG
      -->

      <!-- 
        - #CTA
      -->

      
      

    </article>
  </main>
