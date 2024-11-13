
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-wrapper">
                <div class="form-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Ajouter un Bien Immobilier</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="{{ route('biens.index') }}" class="btn btn-secondary">
                                <i class="material-icons">&#xE15B;</i>
                                <span>Retour</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('biens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
                        @error('titre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="prix">Prix (€)</label>
                        <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" required>
                        @error('prix')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="Nbpiece">Nombre de Pièces</label>
                        <input type="number" name="Nbpiece" id="Nbpiece" class="form-control" value="{{ old('Nbpiece') }}" required>
                        @error('Nbpiece')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse') }}" required>
                        @error('adresse')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="surface">Surface (m²)</label>
                        <input type="number" name="surface" id="surface" class="form-control" value="{{ old('surface') }}" required>
                        @error('surface')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select name="statut" id="statut" class="form-control" required>
                            <option value="Disponible">Disponible</option>
                            <option value="Sous Offre">Sous Offre</option>
                            <option value="Vendu">Vendu</option>
                            <option value="Retiré">Retiré</option>
                        </select>
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
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
                    <br>
                    
                    <br>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="video">Vidéo</label>
                        <input type="file" name="video" id="video" class="form-control-file">
                        @error('video')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
