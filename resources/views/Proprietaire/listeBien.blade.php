@extends('Proprietaire.proprietaire')

@section('content')
<!------main-content-start-----------> 
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Mes Biens Immobiliers</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="/biens/create" class="btn btn-success" >
                                <i class="material-icons">&#xE147;</i>
                                <span >Ajouter un Bien</span>
                            </a>
                            <a href="#deleteBienModal" class="btn btn-danger" data-toggle="modal">
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
                           
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Nombre de Pièces</th>
                            <th>Adresse</th>
                            <th>Surface</th>
                            <th>Type</th>
                            <th>Statut</th>
                            
                            <th>image</th>
            
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                     
                        @foreach($biens as $bien)
                      
                        <tr>
                                <td><input type="checkbox" name="bien[]" value="{{ $bien->id }}"></td>
                              
                                <td>{{ $bien->titre }}</td>
                                <td>{{ $bien->description }}</td>
                                <td>{{ number_format($bien->prix, 2, ',', ' ') }} €</td>
                                <td>{{ $bien->Nbpiece }}</td>
                                <td>{{ $bien->adresse }}</td>
                                <td>{{ $bien->surface }} m²</td>
                                <td>{{ $bien->type }}</td>
                                <td>{{ $bien->statut }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $bien->image) }}" alt="Image du bien" width="50" height="50">
                                </td>
                                                      <td>
                                    <a href="#editAnnonceModal{{ $bien->id }}" class="edit" data-toggle="modal" data-id="{{ $bien->id }}">
                                        <i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i>
                                    </a>                                    
                                    <a href="#deleteAnnonceModal{{ $bien->id }}" class="delete" data-toggle="modal" data-id="{{ $bien->id }}">
                                        <i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i>
                                    </a>
                                    
                                </td>
                            </tr> 

                        @endforeach
                    </tbody> --}}
                    <tbody>
                        @forelse($biens as $bien)
                            <tr>
                                <td><input type="checkbox" name="bien[]" value="{{ $bien->id }}"></td>
                                <td>{{ $bien->titre }}</td>
                                <td>{{ $bien->description }}</td>
                            
                                <td>{{ number_format($bien->prix, 2, ',', '.') }} Frcfa</td>

                                <td>{{ $bien->Nbpiece }}</td>
                                <td>{{ $bien->adresse }}</td>
                                <td>{{ $bien->surface }} m²</td>
                                <td>{{ $bien->type }}</td>
                                <td>{{ $bien->statut }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $bien->image) }}" alt="Image du bien" width="50" height="50">
                                </td>
                                <td>
                                    <a href="#editAnnonceModal{{ $bien->id }}" class="edit" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i>
                                    </a>
                                    <a href="#deleteAnnonceModal{{ $bien->id }}" class="delete" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Vous n'avez pas encore ajouté de bien immobilier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>

                <div class="clearfix">
                    <div class="hint-text">Affichage de <b>{{ $biens->count() }}</b> sur <b>{{ $biens->total() }}</b></div>
                    {{ $biens->links() }}
                </div>
            </div>
        </div>

<!-- Modale d'édition -->
@foreach($biens as $bien)
    <div class="modal fade" id="editAnnonceModal{{ $bien->id }}" tabindex="-1" role="dialog" aria-labelledby="editAnnonceModalLabel{{ $bien->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnonceModalLabel{{ $bien->id }}">Modifier l'Annonce</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('biens.update', $bien->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Formulaire de modification pour le bien -->
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control" value="{{ $bien->titre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required>{{ $bien->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="text" name="prix" class="form-control" value="{{ $bien->prix }}" required>
                        </div>
                        <div class="form-group">
                            <label for="surface">Surface</label>
                            <input type="text" name="surface" class="form-control" value="{{ $bien->surface }}" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" class="form-control" value="{{ $bien->adresse }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


<!-- Modale de suppression -->
@foreach($biens as $bien)
    <div class="modal fade" id="deleteAnnonceModal{{ $bien->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAnnonceModalLabel{{ $bien->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAnnonceModalLabel{{ $bien->id }}">Supprimer l'Annonce</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette annonce ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <form action="{{ route('biens.destroy', $bien->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



    @endsection