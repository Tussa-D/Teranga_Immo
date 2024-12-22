<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
   
    <div id="container">
     
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="logo-container">
                <img src="{{ asset('asset/images/Teranga.png') }}" alt="Logo">
            </div>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="email" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" id="password" name="password" class="form-control" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <input type="submit" id="submit" value="Se connecter">
            
            <a href="/register" class="btn btn-secondary mt-3 d-flex align-items-center justify-content-center" style="gap: 8px; transition: all 0.3s;">
                <i class="fas fa-user-plus" style="font-size: 16px;"></i> 
                <span>Inscription</span>
            </a>
            <style>
                .btn-secondary:hover {
                    background-color: #0b87f4; /* Couleur plus foncée */
                    color: #fff;
                    transform: scale(1.05); /* Agrandissement léger */
                }
            </style>
            <br>
             <a href="/" class="btn btn-secondary mt-3">Retour</a> 
            <br/>
          
        </form>
   
</body>
</html>
