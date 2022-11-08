@extends('layouts.app')

@section('contenu')




<!-- ****************************** GESTION DES FILIERES *********************************** -->
<div class="row d-flex justify-content-center align-items-center mt-4">
    <div class="col-12 col-md-9">


<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary">Evaluation: {{$LeNiveau->LibelleNiveau}}  {{$LeNiveau->filiere->LibelleFiliere}} {{$LeTP->LibelleTp}} <b>G{{$LeGroupe->numeroG}} </b></h2>

            </div>

        </div>
    </div>
    <div class="card-body">

<?php if (!isset($_SESSION)) { session_start(); } ?>
@if(count($errors) > 0)
<div id="ul_alert_error">
    <div class="alert alert-danger d-flex align-items-center">
        <ul id="ul_alert">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          <script type="text/javascript">setTimeout(function() {
          document.getElementById('ul_alert_error').innerHTML = "";},5000);</script>
          @endforeach
      </ul>
  </div>
</div>
@endif

  @if (session('status')) 
  <div id="ul_alert_error" class=" col-12 col-md-8 d-flex justify-content-center align-items-end">
    <div class="MCenter h1_alert bg-info">
     {{session('status')}}
     <script type="text/javascript">setTimeout(function() {
     document.getElementById('ul_alert_error').innerHTML = "";},7000);</script>
    </div>
  </div>
  @endif

<form action="{{route('configEval.store')}}" method="POST">
<input type="hidden" name="idNiveau" value="{{$LeNiveau->id}}" id="">
<input type="hidden" name="idTp" value="{{$LeTP->id}}" id="">
<input type="hidden" name="idGroupe" value="{{$LeGroupe->id}}" id="">
    <div class="table-responsive">
        @csrf
        <h1 class="MCenter"></h1>
        <table class="table table-bordered table-striped" id="editable">
            <thead>
                <tr class="MCenter">
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>N° CE</th>
                    <th>Nouvelle Note</th>
                </tr>
            </thead>

            <tbody>
                <?php $i=1; if ($ListeEtuInscrit->count() > 0):  if (isset($_GET['page'])) {{ $i=$_GET['page']*5 - 4;}} ?>
                    <?php foreach ($ListeEtuInscrit as $LigneInsscrit): ?>
                <tr  class="MCenter">

                    <td><?=$i++ ?></td>
                    <td>{{$LigneInsscrit->etudiant->Nom}}</td>
                    <td>{{$LigneInsscrit->etudiant->Prenom}}  </td>
                    <td>{{$LigneInsscrit->etudiant->NCE}}</td>
                    <td class="d-flex justify-content-center">
                        <!-- <div class="row d-flex justify-content-center"> -->
                            <!-- <div class="form-group col-4 "> -->
                                <input type="number" min="0" max="20" name="Note_{{$LigneInsscrit->id}}"  class="form-control inputNote" >
                            <!-- </div> -->
                        <!-- </div> -->
                    </td>

                </tr> 
                    <?php endforeach ?> 
                <?php endif ?>
            </tbody>
            
            <tfoot  class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>N° CE</th>
                <th>Nouvelle Note</th>
            </tfoot>
        </table>
    </div>


    <div class="row d-flex justify-content-center">

        <div class=" col-6">              
          <a href="{{route('config.index')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>
        </div>

        <div class=" col-6 ">
          <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Valider</button>
        </div>

    </div>

</form>

<!--     <div class="row">
        <div class="col-9 ">
            <div class="paginate float-end">
                {x{ $ListeEtuInscrit->links() }}   
            </div>
        </div>
    </div> -->

    </div><!-- fin card shadow -->
</div><!-- fin card-body -->

    </div> <!-- fin  -->
</div> <!-- fin row -->

<div class="row">
    <div class="col-12 "></div> 
</div>


<!-- ****************************** GESTION DES FILIERES *********************************** -->






<!-- Modal Filiere-->
<div class="modal fade" id="ajoutTPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('Tps.store')}}" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajoutez un TP</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Nom du TP:</b>
            <input type="text" name="LibelleTP"  class="form-control" required id="" placeholder="Langage C">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fremer</button>
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
    </form><!-- fin form -->
    </div>
  </div>
</div>


<!-- <script type="text/javascript">
    $(document).ready(function(){
  // $('#birth-date').mask('00/00/0000');
  $('#NoteNumeric').mask('00'); //Pour ne accepter que des nombres
 })
</script> -->

@endsection   

<!-- <button type="button" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></button> -->
<!-- 
<button type="button" class="tabledit-delete-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button>
 -->