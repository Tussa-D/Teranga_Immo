<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./asset/assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link href="./asset/css/styleR.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>
  <body>

    <div class="container bg-light p-4 rounded shadow">
        <h1 class="text-center text-primary">{{ $property->titre }}</h1>
        <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->titre }}" 
        class="img-fluid rounded mb-3" 
        style="width: 100px; height: auto; display: block; margin: 0 auto;">
            
        <p><strong>Statut :</strong> {{ $property->statut }}</p>
        <p><strong>Adresse :</strong> {{ $property->adresse }}</p>
        <p><strong>Prix :</strong> ${{ number_format($property->prix, 0, ',', ' ') }}/Mois</p>
        <p><strong>Description :</strong> {{ $property->description }}</p>
        
        <h3 class="mt-4">Détails supplémentaires</h3>
        <ul class="list-group">
            <ul class="card-list">
                <li class="card-item">
                    <strong>{{ $property->Nbpiece }}</strong>
                    <ion-icon name="bed-outline"></ion-icon>
                    <span>Chambres</span>
                </li>

                <li class="card-item">
                    <strong>{{ $property->Nbpiece }}</strong>
                    <ion-icon name="man-outline"></ion-icon>
                    <span>Salons</span>
                </li>

                <li class="card-item">
                    <strong>{{ $property->surface }}</strong>
                    <ion-icon name="square-outline"></ion-icon>
                    <span>m²</span>
                </li>
                            <li class="list-group-item"><strong>Propriétaire :</strong> {{ $property->proprietaire->prenom }} {{ $property->proprietaire->nom }}</li>
        </ul>
      <!-- Actions après les détails -->
      <div class="actions mt-4 d-flex flex-wrap gap-3">
        <!-- Réservation -->
        <form action="{{ route('reservation', ['id' => $property->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Réserver maintenant</button>
      </form>
      
      <!-- Messages Flash -->
      @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      
      @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      
      
    <!-- Afficher les messages flash -->


    
        <!-- Contacter le propriétaire -->
        <a href="{{ route('contact.owner', ['id' => $property->id]) }}" class="btn btn-secondary">
            Contacter le propriétaire
        </a>
    </div>
    
       
        <!-- Retour à la liste -->
        <a href="/" class="btn btn-light">
            Retour aux annonces
        </a>
    
    <!-- 
  - #FOOTER
-->
<!-- 
  - custom js link
-->
<script src="./assets/js/script.js"></script>

<!-- 
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
