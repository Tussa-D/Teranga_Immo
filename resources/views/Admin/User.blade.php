	<!-- resources/views/home.blade.php -->
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
                           <h2 class="ml-lg-2">Gestion des  utilisateurs</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                          <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                          <i class="material-icons">&#xE147;</i>
                          <span>Ajouter un utilisateur</span>
                          </a>
                          <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                          <i class="material-icons">&#xE15C;</i>
                          <span>Delete</span>
                          </a>
                        </div>
                    </div>
                  </div>
                  
                  <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Ville</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nom }} {{ $user->prenom }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->ville }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <!-- Actions pour chaque utilisateur (voir, modifier, supprimer) -->
                                    <td>
                                      <a href="#editAnnonceModal{{ $user->id }}" class="edit" data-toggle="modal" data-id="{{ $user->id}}">
                                        <i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i>
                                    </a>
                                    
                                        <a href="#deleteAnnonceModal{{$user->id}}" class="delete" data-toggle="modal" data-id="{{$user->id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i>
                                        </a>
                                    </td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                  <div class="clearfix">
                    <div class="hint-text">showing <b>5</b> out of <b>25</b></div>
                    <ul class="pagination">
                       <li class="page-item disabled"><a href="#">Previous</a></li>
                       <li class="page-item "><a href="#"class="page-link">1</a></li>
                       <li class="page-item "><a href="#"class="page-link">2</a></li>
                       <li class="page-item active"><a href="#"class="page-link">3</a></li>
                       <li class="page-item "><a href="#"class="page-link">4</a></li>
                       <li class="page-item "><a href="#"class="page-link">5</a></li>
                       <li class="page-item "><a href="#" class="page-link">Next</a></li>
                    </ul>
                  </div>
         
                  </div>
               </div>
               
               
                                  <!----add-modal start--------->  
            </div>
         </div>
     
       <!------main-content-end-----------> 


       <!-- Modal de suppression -->
<div class="modal fade" id="deleteAnnonceModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAnnonceModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteAnnonceModalLabel{{ $user->id }}">Confirmer la suppression</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                  Êtes-vous sûr de vouloir supprimer cet utilisateur ?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger">Supprimer</button>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection