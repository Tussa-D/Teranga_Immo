<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <div id="container">
        <!-- Formulaire d'inscription -->
        <form method="POST" action="{{ route('register.post') }}">
             <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('asset/images/Teranga.png') }}" alt="Logo">
        </div>
            @csrf

            <div class="form-group">
                <label for="prenom"><b>Prénom</b></label>
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom..." required>
            </div>

            <div class="form-group">
                <label for="nom"><b>Nom</b></label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom..." required>
            </div>

            <div class="form-group">
                <label for="tel"><b>Téléphone</b></label>
                <input type="tel" id="tel" name="tel" class="form-control" placeholder="Téléphone..." required>
            </div>

            <div class="form-group">
                <label for="ville"><b>Ville</b></label>
                <input type="text" id="ville" name="ville" class="form-control" placeholder="Ville..." required>
            </div>

            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email..." required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password"><b>Mot de Passe</b></label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mot de Passe..." required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation"><b>Confirmez le Mot de Passe</b></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmez le Mot de Passe..." required>
            </div>

            <input type="submit" id="submit" value="Valider">
        </form>
    </div>
</body>
</html>
