<!-- <!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">

	<title>una_sotra</title>
</head>
<body>
     -->
@extends(' layouts.app')

@section('contenu')
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<!-- <a href="route('clientBienvenue')">clientBienvenue</a>
<a href="clientAppele">clientAppele</a>
<a href="clientInfoFile">clientInfoFile</a>
<a href="interfaeGuichetPersonnel"> interfaeGuichetPersonnel</a> -->
<!-- xxxxxxxxxxxxxxxx  nav bar xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
	
<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>
    
<?php /*print_r($_SESSION) ; session_destroy();*/ ?>
	<h1 class="MCenter connexionTitreInitBD">MODIFFIER MES INFORMATIONS</h1>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
               <img src="{{ asset('images/logoUna.png') }}" title="Logo UNA" style="width: 200px;" > 
               <!-- alt si l'image ne s'affiche pas
               title si on survole l'image -->
            </div>
        </div>

<div class="row d-flex justify-content-center">    

<div class="col-10 col-md-6">

 <div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <h1 class="m-0 font-weight-bold text-primary MCenter">INFO ETUDIANT</h1>
    </div>
    <div class="card-body">


        <form action="{{route('update_etudiant',1)}}" method="POST">
            @csrf
            <div class="form-group form_etu_titre1 d-flex justify-content-center">
                <b>Profil</b>
                <!-- <input class="form-control" required type="text" name="nom" autocomplete="true"> -->
            </div>

            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom" autocomplete="true">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" name="prenom" autocomplete="true">
            </div>

            <div class="form-group">
                <b>N° CE:</b>
                <input class="form-control" required type="text" name="nce" autocomplete="true">
            </div>

            <div class="form-group">
                <b>Date de naissance:</b>
                <input class="form-control" required type="date" name="dateNaissance" autocomplete="true">
            </div>

            <div class="form-group">
                <b>Email:</b>
                <input class="form-control" required type="text" name="email" placeholder="gnjustin.ic@gmail.com">
            </div>

            <div class="form-group">
                <b>Nouveau mot de passe:</b>
                <input class="form-control" required type="password" value="" name="pass">
            </div>

            <div class="form-group">
                <b>Comfirmer:</b>
                <input class="form-control" required type="password" value="" name="passConfirme">
            </div>
            <!-- <input required type="hidden" value="etudiant" name="type"> -->


            <div class="form-group form_etu_titre2 d-flex justify-content-center">
                <b>Inscription</b>
                <!-- <input class="form-control" required type="text" name="nom" autocomplete="true"> -->
            </div>

            <div class="form-group">
                <b>Niveau:</b>
                <select class="form-control" required name="service_id">
                    <option value="" ></option>
                    < ?php foreach ($listeService as $service): ?>
                    <option value="{$service->id}">{$service->nom}}</option>
                    < ?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <b>Traveaux Pratiques:</b>
                <select class="form-control" required name="service_id">
                    <option value="" ></option>
                    < ?php foreach ($listeService as $service): ?>
                    <option value="{$service->id}">{$service->nom}}</option>
                    < ?php endforeach ?>
                </select>
            </div>



            <div class="row d-flex justify-content-center">
                <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Modiffier</button>
              </div>

              <div class=" col-6">              
                  <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>

              </div>
          </div>
        </form>
            
        </form>


    </div><!-- fin card shadow -->
   </div><!-- fin card-body  -->
 </div>
</div>



@endsection

<!-- </body>
</html> -->


