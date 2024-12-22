<header class="header" data-header>
          <link href="{{ asset('css/styleR.css') }}" rel="stylesheet">

  <div class="overlay" data-overlay></div>

  <div class="header-top">
    <div class="container">

      <ul class="header-top-list">

        <li>
          <a href="mailto:info@TerangaImmo.com" class="header-top-link">
            <ion-icon name="mail-outline"></ion-icon>

            <span>info@TerangaImmo.com</span>
          </a>
        </li>

        <li>
          <a href="#" class="header-top-link">
            <ion-icon name="location-outline"></ion-icon>

            <address>15/A, Dakar, Senegal</address>
          </a>
        </li>

      </ul>

      <div class="wrapper">
        <ul class="header-top-social-list">

          <li>
            <a href="#" class="header-top-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="header-top-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="header-top-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="header-top-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

        </ul>

        <button class="header-top-btn" onclick="window.location.href='/login';">Devenir Proprietaire</button>

      </div>

    </div>
  </div>

  <div class="header-bottom">
    <div class="container">

      <a href="#" class="logo">
        <img  src="./asset/images/Teranga.png" style="width: 60px; height: auto;" alt="Logo Teranga" >
      </a>
      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="#" class="logo">
            <img src="./asset/images/Teranga.png" alt="Logo Teranga">
          </a>

          <button class="nav-close-btn" data-nav-close-btn aria-label="Fermer le menu">
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <div class="navbar-bottom">
          <ul class="navbar-list">

            <li>
              <a href="#home" class="navbar-link" data-nav-link>Accueil</a>
            </li>

            <li>
              <a href="/listbienHome" class="navbar-link" data-nav-link>Liste des biens</a>
            </li>

            <li>
              <a href="/vendreBien" class="navbar-link" data-nav-link>Vendre ses biens</a>
            </li>

            <li>
              <a href="#service" class="navbar-link" data-nav-link>Services</a>
            </li>
            <li>
              <a href="#about" class="navbar-link" data-nav-link>À propos</a>
            </li>

            <li>
              <a href="/register" class="navbar-link" data-nav-link>Inscription</a>
            </li>
           
          </ul>
        </div>

      </nav>

      <div class="header-bottom-actions">

        <button class="header-bottom-actions-btn" onclick="window.location.href='#recherche-avancee';" aria-label="Recherche">
          <ion-icon name="search-outline"></ion-icon>

          <span>Recherche</span>
        </button>

        <button class="header-bottom-actions-btn" onclick="window.location.href='/login';" aria-label="Profil">
          <ion-icon name="person-outline" ></ion-icon>
          <span>Profil</span>
        </button>

       

        <button class="header-bottom-actions-btn"  onclick="window.location.href='/listbienHome';" aria-label="Panier">
          <ion-icon name="cart-outline"></ion-icon>

          <span>Panier</span>
        </button>

        <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Ouvrir le menu">
          <ion-icon name="menu-outline"></ion-icon>

          <span>Menu</span>
        </button>

      </div>

    </div>
  </div>

</header>
