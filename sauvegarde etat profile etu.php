
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
          document.getElementById('ul_alert_error').innerHTML = "";},7000);</script>
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
                    <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Valider mes coordonnées</button></a>
                </div>
            </div>


            <div class="form-group form_etu_titre2 d-flex justify-content-center">
                <b>Inscription</b>
            </div>

            <div class="form-group form_etu_titre3 MCenter"> 
                <b>NB: Si vous obtenez des notes dans un TP, vour pourrez plus changer !</b>
            </div>
            <div class="row d-flex justify-content-center">
                <div class=" col-12 col-md-6">              
                    <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Changer de niveau</button></a>
                </div>
                <div class=" col-12 col-md-6">              
                    <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Ajouter TP</button></a>
                </div>
            </div>

        <?php $boleConfirm = false; $sonNiveauId = ""; ?>
        @foreach ($ListeEtuInscrit as $tpDeja) 
            <?php $sonNiveauId = $tpDeja->niveau->id; $sonNiveauLibelle = $tpDeja->niveau->LibelleNiveau.' '.$tpDeja->niveau->filiere->LibelleFiliere;  ?>
                @if ($tpDeja->notes->count() != 0) <!--  /*Il n'a pas de note dans un TP*/ -->
                <?php $boleConfirm = true; $_SESSION['sonNiveauIdFixe'] = $tpDeja->niveau->id;?>
                    @break
                @endif
        @endforeach <!-- Si boleConfirm = false alors il n'a pas du tout de note -->







@if ($boleConfirm == false) <!-- pour seélectionner son ancient niveau -->
    <!-- S'il n'a pas de note dans un TP, on affiche touts les niveaux -->
<!--     <div class="form-group">
        <b>Niveau:</b>
        <select class="form-control" required name="niveauId">
            <option value="" ></option>
            @ foreach ($Liste_nivaux as $niveau)
                @ if ($sonNiveauId == $niveau->id) <!- J'ai trouvé son niveau
                  <option value="{x{$niveau->id}}" selected>{x{$niveau->LibelleNiveau}} {x{$niveau->filiere->LibelleFiliere}}</option>
                @ else
                <option value="{x{$niveau->id}}">{x{$niveau->LibelleNiveau}} {x{$niveau->filiere->LibelleFiliere}}</option>
                @ endif
            @ endforeach
        </select>
    </div> -->

<!-- *****************************OKOKOKOK********************************* -->
    <div class=" col-12 col-md-6">              
        <a href="{{route('accueil')}}" class="btn  btnNotDisabled"><button type="button" class="btn btn-primary  ">Changer de niveau</button></a>
    </div>
<!-- *****************************OKOKOKOK********************************* -->
    @else
<!--     <div class="form-group">
        <b>Niveau:</b>
        <input class="form-control" readonly disabled placeholder="<?=$sonNiveauLibelle?>: Confirmer">
    </div> -->
<!-- *****************************OKOKOKOK********************************* -->
    <div class=" col-12 col-md-6">              
        <a href="{{route('accueil')}}" class="btn disabled btnDisabled"><button type="button" class="btn btn-primary  ">Changer de niveau</button></a>
    </div>
<!-- *****************************OKOKOKOK********************************* -->
@endif


 

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

                </select>
            </div>

                <?php 
                    if ($cpt == 0) {
                        $_SESSION['ListeTp'] = 0; /*il ne peut plus prendre de TP*/
                    }
                 ?>

<?php 
/*foreach ($ListeEtuInscrit as $value) {
    echo $value->etudiant->Nom.' '.$value->etudiant->Prenom.' '.$value->niveau->LibelleNiveau.' '.$value->niveau->filiere->LibelleFiliere.' '.$value->Tp->LibelleTp.' nbNotes='.$value->notes->count().'<br>';
}*/
 ?>






 <div class="row d-flex justify-content-center">
    <div class="col-8">
        <div class="table-responsive">
            <p class="MCenter"><b>Déjà inscrit en:</b></p>
            <table class="table tableProfiEtu" id="">
                <tbody class="m-0 p-0">


                @foreach ($ListeEtuInscrit as $tpDeja) 
                    @if ($tpDeja->notes->count() == 0)  <!--  /*Il n'a pas de note dans ce TP*/  -->
                      <tr  class="MCenter m-0 p-0">
                          <td class="m-0 p-0"><?=$tpDeja->Tp->LibelleTp ?></td>
                          <td class="m-0 p-0"><a href="{{route('sortiG',$tpDeja->Tp->id)}}" class="btn"><span class="fas fa-trash-alt btnSupTable"></span></a></td>
                      </tr>
                      @else
                        <tr  class="MCenter m-0 p-0">
                          <td class="m-0 p-0"><?=$tpDeja->Tp->LibelleTp ?></td>
                          <td class="m-0 p-0"><a type="btn" class="btn disabled"><span class="fas fa-trash-alt btnSupTable"></span></a></td>
                        </tr>
                    @endif
                @endforeach


              </tbody>

          </table>
      </div>
  </div>
</div>




            <div class="row d-flex justify-content-center">

                <div class=" col-6">              
                    <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>
              </div>

              <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Modiffier</button>
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


