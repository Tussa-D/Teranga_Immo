<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="asset/css/style.css">
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
            </div>
            
            <div class="form-group">
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <input type="submit" id="submit" value="Se connecter">
            
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</body>
</html>
