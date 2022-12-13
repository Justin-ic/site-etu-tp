@extends('layouts.app')

@section('contenu')

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-9 ">
<!-- ******************** CONTENU GLOGAL ****************************** -->



<!-- ****************************** GESTION DES GROUPES *********************************** -->


<div class="container-fluid TitreDetailG">
    <div class="row mt-4 d-flex justify-content-center ">
         <?php $param = $ListeEtuInscrit[0]; ?> 
    <div class=" col-4 d-flex justify-content-center">
        <h2 class="TitrePresence"><b><u>Année univ:</u></b><br>
        {{$anneActive->LibelleAnnee}}</h2>
    </div>
    <div class=" col-4 d-flex justify-content-center">
        <h2 class="TitrePresence"><b><u>Niveau:</u></b><br>
            {{$param->niveau->LibelleNiveau}} {{$param->niveau->filiere->LibelleFiliere}}
        </h2>
    </div>
    <div class=" col-4 d-flex justify-content-center">
        <h2 class="TitrePresence"><b><u>Tp:</u></b> <br>
        {{$param->Tp->LibelleTp}} </h2>
    </div>
</div>
</div>



<div class="card shadow mb-4 TableCard">

    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary"> <b>Appel du Groupe <?php echo $param->groupe->numeroG.' de la salle '.$param->groupe->salle->LibelleSalle ?></b></h2>
            </div>
        </div>
    </div>
    <div class="card-body">



        <div class="table-responsive">
            <h1 class="MCenter"></h1>
        <form action="{{route('savePresence')}}" method="POST">
            @csrf
            <input type="hidden" name="idNiveau" value="<?=$param->niveau->id?>">
            <input type="hidden" name="tpId" value="<?=$param->Tp->id ?>">
            <input type="hidden" name="G_id" value="<?=$param->groupe->id ?>">
            
            <table class="table table-bordered table-striped tableGroupe" id="editable">
                <thead id="AjoutTitre">
                    <tr class="MCenter">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenon</th>
                        <th>N° Carte Etudiante</th>
                        <!-- <th>Date de Naissance</th> -->
                        <!-- <th>Email</th> -->
                        <th>Présence</th>
                        <!-- <th colspan="2">Action</th> -->
                    </tr>
                </thead>
<!-- < ?php dd() ?>  -->
                <tbody>
                    <?php $i=1;foreach ($ListeEtuInscrit as  $inscrit):  ?>

                    <tr  class="MCenter">
                        <td><?=$i++ ?></td>
                        <td><?=$inscrit->etudiant->Nom ?></td>
                        <td><?=$inscrit->etudiant->Prenom ?></td>
                        <td><?=$inscrit->etudiant->NCE ?></td>
                        <!-- <td>< ?=$inscrit->etudiant->DateNaissance ?></td> -->
                        <!-- <td>< ?=$inscrit->etudiant->email ?></td> -->
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <input type="checkbox" name="etat[]" value="<?=$inscrit->id ?>" class="form-check-input check_input">
                            </div>
                        </td>
                    </tr> 
                   
                <?php endforeach ?>

            </tbody>

    </table>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary ">
            Valider
        </button>
    </div>
  </form>
</div>



    </div><!-- fin card-body -->
 </div><!-- fin card shadow -->



<!-- ******************** CONTENU GLOGAL ****************************** -->
    </div> <!-- fin col-12 col-md-9 -->
</div> <!-- fin row -->

@endsection