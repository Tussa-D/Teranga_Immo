<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
</head>
<body>
    <h1>Bonjour {{ $reservation->user->name }},</h1>

    <p>Nous vous confirmons que votre réservation a été effectuée avec succès :</p>

    <ul>
        <li><strong>Bien :</strong> {{ $reservation->bien->titre }}</li>
        <li><strong>Adresse :</strong> {{ $reservation->bien->adresse }}</li>
        <li><strong>Prix :</strong> {{ number_format($reservation->bien->prix, 2, ',', ' ') }} €/mois</li>
        <li><strong>Date de réservation :</strong> {{ $reservation->reservation_date->format('d/m/Y') }}</li>
    </ul>

    <h2>Informations du Propriétaire</h2>
    <ul>
        <li><strong>Nom :</strong> {{ $proprietaire->prenom }} {{ $proprietaire->nom }}</li>
        <li><strong>Email :</strong> {{ $proprietaire->email }}</li>
        <li><strong>Téléphone :</strong> {{ $proprietaire->telephone }}</li>
    </ul>

    <p>Vous pouvez contacter le propriétaire pour organiser une visite ou finaliser la transaction.</p>

    <p>Pour toute question, n'hésitez pas à nous contacter.</p>

    <p>Cordialement,<br>L'équipe Teranga Immo</p>
</body>
</html>
