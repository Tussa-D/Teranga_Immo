@extends('Admin.admin')

@section('content')
<!------main-content-start-----------> 
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                            <h2 class="ml-lg-2">Gestion des Packs</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                            <a href="#addBienModal" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter un Pack</span>
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
                            <th>ID</th>
                            <th>nom</th>
                            <th>Prix</th>
                            <th>Nombre d'annonces</th>
                            <th>description</th>
                            <th>duree</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packs as $pack)
                            <tr>
                                <td><input type="checkbox" name="bien[]" value="{{ $pack->id }}"></td>
                                <td>{{ $pack->id }}</td>
                                <td>{{ $pack->nom}}</td>
                                <td>{{ $pack->prix }}</td>
                                <td>{{ $pack->nombre_annonces }}</td>
                                <td>{{ $pack->description}}</td>
                                <td>{{ $pack->duree }} m²</td>
                                <td>
                                    <a href="#editBienModal" class="edit" data-toggle="modal" data-id="{{ $pack->id }}">
                                        <i class="material-icons" data-toggle="tooltip" colo title="Modifier">&#xE254; </i>
                                    </a>
                                    <a href="#deleteBienModal" class="delete" data-toggle="modal" data-id="{{ $pack->id }}">
                                        <i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

              
            </div>
        </div>

      @endsection