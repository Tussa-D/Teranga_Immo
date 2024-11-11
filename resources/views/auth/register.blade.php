<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation"><b>Confirmer le mot de passe</b></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            
            <input type="submit" id="submit" value="S'inscrire">
        </form>
    </div>
</body>
</html>
