<?php
namespace App\Http\Controllers;
use App\Models\Pack;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CinetPayController extends Controller
{
    public function payForPack(Request $request)
    {
        // Trouver le pack sélectionné par son ID
        $pack = Pack::find($request->pack_id);

        // Vérifier si le pack existe
        if (!$pack) {
            return back()->with('error', 'Le pack sélectionné est introuvable.');
        }

        // Informations de paiement (statique pour simplification)
        $amount = $pack->prix;
        $transaction_id = uniqid(); // ID unique pour la transaction

        // Informations utilisateur statiques
        $user_name = 'John Doe'; // Nom fictif
        $user_email = 'proprietaire@example.com'; // Email fictif

        // Préparer les données pour CinetPay
        $paymentData = [
            'apikey' => env('CINETPAY_API_KEY'),
            'site_id' => env('CINETPAY_SITE_ID'),
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'currency' => 'CFA',
            'description' => "Achat de pack: " . $pack->nom,
            'return_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'customer_name' => $user_name,
            'customer_email' => $user_email,
        ];

        // Initialiser Guzzle Client
        $client = new Client();
        try {
            // Envoyer la requête à CinetPay pour initier le paiement
            $response = $client->post(env('CINETPAY_BASE_URL') . '/payment', [
                'form_params' => $paymentData
            ]);

            // Décoder la réponse de CinetPay
            $responseBody = json_decode($response->getBody(), true);

            if ($responseBody['code'] == '201') {
                // Rediriger l'utilisateur vers l'URL de paiement CinetPay
                return redirect($responseBody['data']['payment_url']);
            } else {
                return back()->with('error', 'Erreur lors du traitement du paiement.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur de connexion avec CinetPay : ' . $e->getMessage());
        }
    }
}

