
@extends(' layouts.app')

@section('contenu')
	

<?php  /*dd($boleConfirm);*/ ?>
<!-- 
@ foreach ($Liste_TP as $Le_TP) 
    @ foreach ($ListeEtuInscrit as $tpDeja) 
    ---{xx{$tpDeja->Tp->id}} ==? {xx{$Le_TP->id}}<br>
        @ if ($tpDeja->Tp->id == $Le_TP->id) 
        {xx{$tpDeja->notes->count()}}<br>
            @ if ($tpDeja->notes->count() == 0) { /*Il n'a pas de note dans ce TP*/
                <option value="{xx{$Le_TP->id}}">{xx{$Le_TP->LibelleTp}}</option>
                @ break
            @ endif
        @ endif 
    @ endforeach
@ endforeach -->

<style type="text/css">
    body{
    /*background-image: url('imgBienvenue.jpg');*/
    /*background-repeat: no-repeat;*/
    background-color: #dee9ff;
}
</style>
    
<?php if (!isset($_SESSION)) { session_start(); } /*dd($_SESSION['Etudiant']);*/ ?>

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

@if(count($errors) > 0)
<div id="ul_alert_error">
    <div class="alert alert-danger d-flex align-items-center">
        <ul id="ul_alert">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          <script type="text/javascript">setTimeout(function() {
          document.getElementById('ul_alert_error').innerHTML = "";},10000);</script>
          @endforeach
      </ul>
  </div>
</div>
@endif

    <form action="{{route('update_etudiant')}}" method="POST">
        @csrf
        <input type="hidden" name="idEtu" id="" value="<?=$_SESSION['Etudiant']->id?>">
        <div class="form-group form_etu_titre1 d-flex justify-content-center">
            <b>Profil</b>
            <!-- <input class="form-control" required type="text" name="nom" autocomplete="true"> -->
        </div>

        <div class="form-group">
            <b>Nom:</b>
            <input class="form-control" required type="text" name="nom" autocomplete="true" value="<?=$_SESSION['Etudiant']->Nom?>">
        </div>

        <div class="form-group">
            <b>Prénom:</b>
            <input class="form-control" required type="text" name="prenom" autocomplete="true" value="<?=$_SESSION['Etudiant']->Prenom?>">
        </div>

        <div class="form-group">
            <b>N° CE:</b>
            <input class="form-control" required type="text" name="nce" autocomplete="true" value="<?=$_SESSION['Etudiant']->NCE?>">
        </div>

        <div class="form-group">
            <b>Date de naissance:</b>
            <input class="form-control" required type="date" name="dateNaissance" autocomplete="true" value="<?=$_SESSION['Etudiant']->DateNaissance?>">
        </div>

        <div class="form-group">
            <b>Email:</b>
            <input class="form-control" required type="text" name="email" placeholder="gnjustin.ic@gmail.com" value="<?=$_SESSION['Etudiant']->email?>">
        </div>

        <div class="form-group">
            <b>Nouveau mot de passe:</b>
            <input class="form-control" required type="password"  name="password">
        </div>

        <div class="form-group">
            <b>Comfirmer:</b>
            <input class="form-control" required type="password" name="passConfirme">
        </div>
        <!-- <input required type="hidden" value="etudiant" name="type"> -->
        <div class="row d-flex justify-content-center mb-4">
            <div class=" col-12 col-md-6">              
                <button type="submit" class="btn btn-primary btnSuivRetour">Valider mes coordonnées</button>
            </div>
        </div>


        <div class="form-group form_etu_titre2 d-flex justify-content-center">
            <b>Inscription</b>
        </div>

        <div class="form-group form_etu_titre3 MCenter"> 
            <b>NB: Si vous obtenez des notes dans un TP, vour ne pourrez plus changer !</b>
        </div>



            
            
         

        <?php $boleConfirm = false; $sonNiveauId = ""; ?>
        @foreach ($ListeEtuInscrit as $tpDeja) 
            <?php $sonNiveauId = $tpDeja->niveau->id; $sonNiveauLibelle = $tpDeja->niveau->LibelleNiveau.' '.$tpDeja->niveau->filiere->LibelleFiliere;  ?>
                @if ($tpDeja->notes->count() != 0) <!--  /*Il n'a pas de note dans un TP*/ -->
                <?php $boleConfirm = true; $_SESSION['sonNiveauIdFixe'] = $tpDeja->niveau->id;?>
                    @break
                @endif
        @endforeach <!-- Si boleConfirm = false alors il n'a pas du tout de note -->

        <!-- Activer le btn TP s'il en a au moins un qui est disponible -->
        <?php $cptNiveaDispo=0; ?>
        @foreach ($Liste_TP as $Le_TP) 
            <?php  $bole = false; ?>
            @foreach ($ListeEtuInscrit as $tpDeja) 
                @if ($tpDeja->Tp->id == $Le_TP->id) 
                <?php $bole = true; ?> 
                @break
                @endif 
            @endforeach
            <?php if ($bole == false) {$cptNiveaDispo++; } ?>                            
        @endforeach




    <div class="row d-flex justify-content-center">

        @if ($boleConfirm == false) <!-- pour seélectionner son ancient niveau -->
            <!-- S'il n'a pas de note dans un TP, on affiche touts les niveaux -->

            <div class="col-12 col-md-6">              
                <a data-bs-toggle="modal" data-bs-target="#changeNiveauModal"><button class="btn btn-primary btnSuivRetour">Changer de niveau</button></a>
            </div>

        <!-- *****************************OKOKOKOK********************************* -->
         @else

            <div class=" col-12 col-md-6">              
                <a title="Vous avez noté déjà cette année."><button  class="btn btn-primary btnSuivRetour disabled"><?=$sonNiveauLibelle?>: Confirmer</button></a>
            </div>
        <!-- *****************************OKOKOKOK********************************* -->
        @endif


        <?php if ($cptNiveaDispo == 0): ?>
            <div class=" col-12 col-md-6">              
                <a data-bs-toggle="modal" data-bs-target="" title="Désolé: Il n'y a plus TP disponibles pour vous !"><button type="button" class="btn btn-primary btnSuivRetour disabled">Il n'y a plus de TP disponibles.</button></a>
            </div>  
        <?php else: ?>
            <div class=" col-12 col-md-6">              
                <a data-bs-toggle="modal" data-bs-target="#AjoutTpModal"><button type="button" class="btn btn-primary btnSuivRetour">Ajouter TP</button></a>
            </div>
        <?php endif ?>

    </div>



<?php 
/*foreach ($ListeEtuInscrit as $value) {
    echo $value->etudiant->Nom.' '.$value->etudiant->Prenom.' '.$value->niveau->LibelleNiveau.' '.$value->niveau->filiere->LibelleFiliere.' '.$value->Tp->LibelleTp.' nbNotes='.$value->notes->count().'<br>';
}*/
 ?>






 <div class="row d-flex justify-content-center ">
    <div class="col-8">
        <div class="table-responsive mt-2  mb-0">
            <p class="MCenter"><b>Déjà inscrit en:</b></p>
            <table class="table tableProfiEtu  mb-0" id="">
                <tbody class="m-0 p-0">


                @foreach ($ListeEtuInscrit as $tpDeja) 
                    @if ($tpDeja->notes->count() == 0)  <!--  /*Il n'a pas de note dans ce TP*/  -->
                      <tr  class="MCenter m-0 p-0">
                          <td class="m-0 p-0"><?=$tpDeja->Tp->LibelleTp ?></td>
                          <td class="m-0 p-0"><a href="{{route('sortiTP',$tpDeja->Tp->id)}}"  class="btn"><span class="fas fa-trash-alt btnSupTable"></span></a></td>
                      </tr>
                      @else
                        <tr  class="MCenter m-0 p-0">
                          <td class="m-0 p-0"><?=$tpDeja->Tp->LibelleTp ?></td>
                          <td class="m-0 p-0"><a type="btn" class="btn disabled" title="Vous avez été noté déjà dans ce TP !"><span class="fas fa-trash-alt btnSupTable"></span></a></td>
                        </tr>
                    @endif
                @endforeach


              </tbody>

          </table>
      </div>
  </div>
</div>




            <div class="row d-flex justify-content-center">

                <div class=" col-10">              
                    <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>
              </div>

              <!-- <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Modiffier</button>
              </div> -->
            </div>
        </form>
            
        </form>


    </div><!-- fin card shadow -->
   </div><!-- fin card-body  -->
 </div>
</div>











<!-- Modal Changer de niveau-->
<div class="modal fade" id="changeNiveauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('update_InsNiv')}}" method="POST">
            @csrf
      <input type="hidden" name="idEtu" value="<?=$_SESSION['Etudiant']->id?>" id="">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Changer le niveau</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        


    <!-- S'il n'a pas de note dans un TP, on affiche touts les niveaux -->
    <div class="form-group">
        <b>Niveau:</b>
        <select class="form-control" required name="niveauId">
            <option value="" ></option>
            @foreach ($Liste_nivaux as $niveau)
                @if ($sonNiveauId == $niveau->id) <!--  J'ai trouvé son niveau -->
                  <option value="{{$niveau->id}}" selected>{{$niveau->LibelleNiveau}} {{$niveau->filiere->LibelleFiliere}}</option>
                @else
                <option value="{{$niveau->id}}">{{$niveau->LibelleNiveau}} {{$niveau->filiere->LibelleFiliere}}</option>
                @endif
            @endforeach
        </select>
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












<!-- Modal Ajouter TP-->
<div class="modal fade" id="AjoutTpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('update_InsTP')}}" method="POST">
            @csrf
      <input type="hidden" name="idEtu" value="<?=$_SESSION['Etudiant']->id?>" id="">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajoutez un TP</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Ajoutez un TP (Traveaux Pratiques):</b>
            <select class="form-control"  name="tpID">
                <option value=""  ></option>
                <?php $cpt=0; ?>
                @foreach ($Liste_TP as $Le_TP) 
                    <?php  $bole = false; ?>
                    @foreach ($ListeEtuInscrit as $tpDeja) 
                        @if ($tpDeja->Tp->id == $Le_TP->id) 
                        <?php $bole = true; ?> 
                        @break
                        @endif 
                    @endforeach
                    <?php if ($bole == false): $cpt++; ?>
                        <option value="{{$Le_TP->id}}">{{$Le_TP->LibelleTp}}</option>
                    <?php endif ?>
                @endforeach



                <?php 
                   /* if ($cpt == 0) {
                        $_SESSION['ListeTp'] = 0; //il ne peut plus prendre de TP
                    }*/
                 ?>
            </select>
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








@endsection

<!-- </body>
</html> -->


