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
	<h1 class="MCenter connexionTitreInitBD">ENREGISTREMENT ETUDIANT</h1>

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


        <form action="{{route('Store_etudiant')}}" method="POST">
            @csrf
            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control" required type="text" name="nom">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control" required type="text" name="prenom">
            </div>

            <div class="form-group">
                <b>N° CE:</b>
                <input class="form-control" required type="text" name="nce">
            </div>

            <div class="form-group">
                <b>Date de naissance:</b>
                <input class="form-control" required type="date" name="dateNaissance">
            </div>

            <div class="form-group">
                <b>Email:</b>
                <input class="form-control" required type="text" name="email" placeholder="gnjustin.ic@gmail.com">
            </div>

            <div class="form-group">
                <b>Choisir un mot de passe:</b>
                <input class="form-control" required type="password" value="" name="pass">
            </div>

            <div class="form-group">
                <b>Comfirmer:</b>
                <input class="form-control" required type="password" value="" name="passConfirme">
            </div>
            <input required type="hidden" value="etudiant" name="type">

            <!-- <button type="submit" class="btn btn-success">Valider</button>  -->
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn btn-success btnValide" type="button">Valider</button>
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


