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
        </form>
        
    </div>
</body>
</html>
