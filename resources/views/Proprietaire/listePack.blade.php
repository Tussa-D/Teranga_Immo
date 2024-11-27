
@extends('Proprietaire.proprietaire')

@section('content')

  <!-- Contenu principal -->
  <div class="container">
    <div class="col-md-12">
        <div class="table-wrapper">
            <section class="packs" id="packs">
                <div class="container">
                    <p class="section-subtitle">Nos Packs</p>
                    <h2 class="h2 section-title">Les Packs Disponibles</h2>
            
                    <ul class="packs-list has-scrollbar">
                        @foreach($packs as $pack)
                            <li>
                                <div class="pack-card">
                                    <figure class="card-banner">
                                        <img src="{{ asset('storage/' . $pack->image) }}" alt="{{ $pack->nom }}" class="w-100">
                                    </figure>
            
                                    <div class="pack-content">
                                        <h3 class="h3 pack-title">
                                            <a href="#">{{ $pack->nom }}</a>
                                        </h3>
            
                                        <p class="card-text">
                                            {{ $pack->description }}
                                        </p>
            
                                        <div class="card-price">
                                            <strong>{{ number_format($pack->prix, 0, ',', ' ') }} CFA / Abonnement</strong>

                                        </div>
            
                                        <div class="pack-details">
                                            <span><strong>{{ $pack->nombre_annonces }}</strong> Annonces</span>
                                            <span><strong>{{ $pack->duree }}</strong> mois</span>
                                        </div>
            
                                        <form action="{{ route('payer.pack') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="pack_id" value="{{ $pack->id }}">
                                            <button type="submit">Acheter ce Pack</button>
                                        </form>
                                        @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

                                      
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            
          
        </div>
    </div>

  

  </div>
  @endsection