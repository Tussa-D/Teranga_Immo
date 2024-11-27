@extends('Admin.admin')

@section('content')

<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Gestion des Annonces</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="#addAnnonceModal" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter une Annonce</span>
                            </a>
                            <a href="#deleteAnnonceModal" class="btn btn-danger" data-toggle="modal">
                                <i class="material-icons">&#xE15C;</i>
                                <span>Supprimer</span>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date de Publication</th>
                            <th>Image</th>
                            <th>Vidéo</th>
                            <th>Statut</th>
                            <th>Propriétaire</th>
                            <th>Bien Associé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($annonces as $annonce)
                            <tr>
                                <td><input type="checkbox" name="annonce[]" value="{{ $annonce->id }}"></td>
                                <td>{{ $annonce->id }}</td>
                                <td>{{ $annonce->titre }}</td>
                                <td>{{ $annonce->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($annonce->date_publication)->format('d/m/Y') }}</td>

                                <!-- Affichage de l'image -->
                                <td>
                                    @if($annonce->image)
                                        <img src="{{ asset($annonce->image) }}" alt="Image" width="50" height="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <!-- Affichage de la vidéo -->
                                <td>
                                    @if($annonce->video)
                                        <a href="{{ asset($annonce->video) }}" target="_blank">Voir</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <!-- Affichage du statut -->
                                <td>
                                  <select class="form-control" data-annonce-id="{{ $annonce->id }}" onchange="updateStatut(this)">
                                      <option value="En cours" {{ $annonce->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                                      <option value="Active" {{ $annonce->statut == 'Active' ? 'selected' : '' }}>Active</option>
                                      <option value="Suspended" {{ $annonce->statut == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                      <option value="Expired" {{ $annonce->statut == 'Expired' ? 'selected' : '' }}>Expired</option>
                                      <option value="Archived" {{ $annonce->statut == 'Archived' ? 'selected' : '' }}>Archived</option>
                                  </select>
                              </td> 
                                
                                <!-- Affichage du nom du propriétaire -->
                                <td>{{ $annonce->proprietaire->nom ?? 'Propriétaire inconnu' }} {{ $annonce->proprietaire->prenom ??  'Propriétaire inconnu'  }}</td>
                              
                                <!-- Affichage du titre du bien associé -->
                                <td>{{ $annonce->bien->titre ?? 'Bien non défini' }}</td>
                                
                              
                                <td>
                                  <a href="#editAnnonceModal{{ $annonce->id }}" class="edit" data-toggle="modal" data-id="{{ $annonce->id }}">
                                    <i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i>
                                </a>
                                
                                    <a href="#deleteAnnonceModal{{ $annonce->id }}" class="delete" data-toggle="modal" data-id="{{ $annonce->id }}">
                                        <i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="clearfix">
                    <div class="hint-text">Affichage de <b>{{ $annonces->count() }}</b> sur <b>{{ $annonces->total() }}</b></div>
                    {{ $annonces->links() }}
                </div>
            </div>
        </div>

       


<!-- Modal pour Ajouter une annonce -->
<div class="modal fade" id="addAnnonceModal" tabindex="-1" role="dialog" aria-labelledby="addAnnonceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addAnnonceModalLabel">Ajouter une Annonce</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('annonces.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <label for="titre">Titre</label>
                      <input type="text" class="form-control" id="titre" name="titre" required>
                  </div>
                  <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description" required></textarea>
                  </div>
                  <div class="form-group">
                      <label for="date_publication">Date de Publication</label>
                      <input type="date" class="form-control" id="date_publication" name="date_publication" required>
                  </div>
                  <div class="form-group">
                      <label for="image">Image (facultatif)</label>
                      <input type="file" class="form-control" id="image" name="image">
                  </div>
                      <label for="bien_id">Bien immobilier :</label>
                        <select name="bien_id" id="bien_id">
                            @foreach($biens as $bien)
                                <option value="{{ $bien->id }}">{{ $bien->titre }}</option>
                            @endforeach
                        </select>
                          <div class="form-group">
                      <label for="statut">Statut</label>
                      <select class="form-control" id="statut" name="statut" required>
                          <option value="En cours">En cours</option>
                          <option value="Active">Active</option>
                          <option value="Suspended">Suspended</option>
                          <option value="Expired">Expired</option>
                          <option value="Archived">Archived</option>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                <label for="proprietaire_id">Propriétaire</label>
                <select name="proprietaire_id" id="proprietaire_id" class="form-control" required>
                    @foreach($proprietaires as $proprietaire)
                        <option value="{{ $proprietaire->id }}">{{ $proprietaire->nom }} {{ $proprietaire->prenom }}</option>
                    @endforeach
                </select>
                @error('proprietaire_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-success">Ajouter</button>
              </div>
          </form>
      </div>
  </div>
</div>

<!-- Modal pour Supprimer une annonce -->
<div class="modal fade" id="deleteAnnonceModal{{ $annonce->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAnnonceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteAnnonceModalLabel">Supprimer l'Annonce</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('annonces.destroy', $annonce->id) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                  <p>Êtes-vous sûr de vouloir supprimer cette annonce ?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger">Supprimer</button>
              </div>
          </form>
      </div>
  </div>
</div>

<!-- Modal pour Modifier une annonce -->
@foreach($annonces as $annonce)
<div class="modal fade" id="editAnnonceModal{{ $annonce->id }}" tabindex="-1" role="dialog" aria-labelledby="editAnnonceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnonceModalLabel">Modifier l'Annonce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('annonces.update', $annonce->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $annonce->titre) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description', $annonce->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_publication">Date de Publication</label>
                        <input type="date" class="form-control" id="date_publication" name="date_publication" value="{{ old('date_publication', $annonce->date_publication) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image (facultatif)</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="bien_id">Bien immobilier :</label>
                        <select name="bien_id" id="bien_id" class="form-control">
                            @foreach($biens as $bien)
                                <option value="{{ $bien->id }}" {{ $annonce->bien_id == $bien->id ? 'selected' : '' }}>{{ $bien->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select class="form-control" id="statut" name="statut" required>
                            <option value="En cours" {{ $annonce->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                            <option value="Active" {{ $annonce->statut == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Suspended" {{ $annonce->statut == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="Expired" {{ $annonce->statut == 'Expired' ? 'selected' : '' }}>Expired</option>
                            <option value="Archived" {{ $annonce->statut == 'Archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proprietaire_id">Propriétaire</label>
                        <select name="proprietaire_id" id="proprietaire_id" class="form-control" required>
                            @foreach($proprietaires as $proprietaire)
                                <option value="{{ $proprietaire->id }}" {{ $annonce->proprietaire_id == $proprietaire->id ? 'selected' : '' }}>{{ $proprietaire->nom }} {{ $proprietaire->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

