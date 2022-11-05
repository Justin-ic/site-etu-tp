
@extends(' layouts.app')

@section('contenu')
<div class="row d-flex justify-content-center  align-items-center div_inscript">    

<div class="col-10 col-md-6">

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


 <div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary MCenter" id="info_tp">Inscription au TP</h1>
  </div>
    <div class="card-body">


        <form action="{{route('inscrits.store')}}" method="POST">
            @csrf

            <input class="" required type="hidden" name="Id_Etu" value="<?=$Etudiant->id?>">
            <input class="" required type="hidden" name="Id_Annee" value="<?=$Anne_Univ->id?>">

            <div class="form-group">
                <b>Nom et Prénom:</b>
                <input class="form-control unTest" required type="text" name="" disabled value="<?=$Etudiant->Nom?> <?=$Etudiant->Prenom?>" >
            </div>

            <div class="form-group">
                <b>Année Universitaire:</b>
                <input class="form-control" required type="text" name="" disabled value="<?=$Anne_Univ->LibelleAnnee?>" readonly>
            </div>            

            <div class="form-group">
                <b>Niveau:</b>
                <select class="form-control" required name="niveau_id">
                    <option value="" >--Choisir--</option>
                    <?php foreach ($Liste_nivaux as $niveau): ?>
                    <option value="{{$niveau->id}}">{{$niveau->LibelleNiveau}} {{$niveau->filiere->LibelleFiliere}}</option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <b>Traveaux Pratiques:</b>
                <select class="form-control" required name="tp_id">
                    <option value="" >--Choisir--</option>
                    <?php foreach ($Liste_Tp as $tp): ?>
                    <option value="{{$tp->id}}">{{$tp->LibelleTp}}</option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="row d-flex justify-content-center">


                <div class=" col-6">              
                  <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>
                </div>

                <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Valider</button>
                </div>

            </div>
      </form>


   </div><!-- fin card-body  -->
  </div><!-- fin card shadow -->
 </div>
</div>


@endsection

<!-- </body>
</html> -->




