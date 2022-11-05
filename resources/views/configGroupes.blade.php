@extends('layouts.app')

@section('contenu')

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-9">
<!-- ******************** CONTENU GLOGAL ****************************** -->










<!-- ****************************** Etudiants inscrits sans groupe ****************************** -->
<?php if ($Liste_InscritSansGroupe->count() > 0): ?>

<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary">Etudiants inscrits sans groupe</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
<b><u>Configuration des groupes:</u></b> Terminez l'inscription de ces étudiants en configurant leur groupe à l'étape 1.

    

<div class="table-responsive">
    <h1 class="MCenter"></h1>
    <table class="table table-bordered table-striped tableGroupe" id="editable">
        <thead id="AjoutTitre">
            <tr class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prenon</th>
                <th>N° Carte Etudiante</th>
                <th>Niveau</th>
                <th>TP</th>
                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>

        <tbody>
            <?php $i=1;foreach ($Liste_InscritSansGroupe as  $inscrit):  ?>

            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td><?=$inscrit->etudiant->Nom ?></td>
                <td><?=$inscrit->etudiant->Prenom ?></td>
                <td><?=$inscrit->etudiant->NCE ?></td>
                <td><?=$inscrit->niveau->LibelleNiveau ?> <?=$inscrit->niveau->filiere->LibelleFiliere ?></td>
                <td><?=$inscrit->Tp->LibelleTp ?></td>
            </tr> 
            <?php endforeach ?>

        </tbody>
        
<!--         <tfoot  class="MCenter">
            <th>N°</th>
            <th>Nom</th>
            <th>Prenon</th>
            <th>N° Carte Etudiante</th>
            <th>Date de Naissance</th>
            <th>Email</th>
        </tfoot> -->
    </table>
</div>



    </div><!-- fin card shadow -->
</div><!-- fin card-body -->

<?php endif ?>



<!-- ****************************** Etudiants inscrits sans groupe ****************************** -->











<!-- ****************************** REPARTITION DES GROUPES *********************************** -->
<div class="card shadow mb-4 mt-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary"><u>Etape 1:</u> Repartition des <b>Groupes</b></h2>

            </div>
            <div class="col-sm-3 d-flex justify-content-end ms-auto p-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConfigGroupeModal">
                    <i class="fas fa-plus "></i>
                    Configurer
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
Cette partie de la configuration consiste à repartir les étudiants dans les groupes. <br>
Il sufit d'indiquer le nombre d'étudiant que vous souhaitez par groupe et laissez la magie s'opérer. <span class="fas fa-grin-stars"></span>

<?php if (!isset($_SESSION)) { session_start(); }?>
<?php if (isset($_SESSION['ConfigGOK']) && $_SESSION['ConfigGOK'] != "" ): ?>
    
<div id="ul_alert_success"> 
    <div class="alert d-flex align-items-center justify-content-center alert_success">
        <?=$_SESSION['ConfigGOK']?>
          <script type="text/javascript">setTimeout(function() {
          document.getElementById('ul_alert_success').innerHTML = "";},7000);</script>
  </div>
</div>

<?php $_SESSION['ConfigGOK']=""; ?>
<?php endif ?>


    </div><!-- fin card shadow -->
</div><!-- fin card-body -->
<!-- ****************************** REPARTITION DES GROUPES *********************************** -->






<!-- ****************************** GESTION DES GROUPES *********************************** -->
<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary"><u>Etape 2:</u> Gestion des <b>Groupes</b></h2>

            </div>
            <!-- <div class="col-sm-3 d-flex justify-content-end ms-auto p-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutNiveauModal">
                    <i class="fas fa-plus "></i>
                    Ajouter Groupe
                </button>
            </div> -->
        </div>
    </div>
    <div class="card-body">

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


<div id="ul_alert">

</div>
<b><u>NB:</u></b> Dans cette partie, veuillez repartir les groupes dans des salles de TP. <br>
Les groupes sont créer automatiquement dans la première étape.
<div class="table-responsive">
    @csrf
    <h1 class="MCenter"></h1>
    <table class="table table-bordered table-striped tableGroupe" id="editable">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Libelle groupe</th>
                <th>Salle</th>
                <th>Date Modif</th>
                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);
/*guichet_service
guichet_personnel */ 
 ?></pre> -->
        <tbody>
            <?php $i=1; if ($Liste_groupe->count() > 0):  if (isset($_GET['page'])) {{ $i=$_GET['page']*5 - 4;}} ?>
                <?php foreach ($Liste_groupe as $La_Liste_groupe): ?>
            <tr  class="MCenter">
                <td style="display: none;">{{$La_Liste_groupe->id}}</td>
                <td><?=$i++ ?></td>
                <td>Groupe {{$La_Liste_groupe->numeroG}}</td>
                <?php if ($La_Liste_groupe->salle == NULL): ?>
                    <td>Groupe pas défini</td>
                <?php else: ?>
                <td>{{$La_Liste_groupe->salle->LibelleSalle}}</td>
                <?php endif ?>
                <td>{{$La_Liste_groupe->updated_at->format('d/m/Y')}}</td>
            </tr> 
                <?php endforeach ?> 
            <?php endif ?>
        </tbody>
        
        <tfoot  class="MCenter">
            <th>N°</th>
                <th>Libelle groupe</th>
                <th>Salle</th>
                <th>Date Modif</th>
            <!-- <th colspan="2">Action</th> -->
        </tfoot>
    </table>
</div>

    <div class="row">
        <div class="col-9 ">
            <div class="paginate float-end">
                {{ $Liste_groupe->links() }}   
            </div>
        </div>
    </div>

    </div><!-- fin card shadow -->
</div><!-- fin card-body -->
<!-- ****************************** GESTION DES GROUPES *********************************** -->






<!-- ****************************** Mini bilan *********************************** -->
<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary">Mini bilan de l'année universitaire</h2>
            </div>
            <div class="col-sm-3 d-flex justify-content-end ms-auto p-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FiltreGroupeModal">
                    <i class="fas fa-search-plus "></i>
                    Filtrer
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
<b><u>Effectuer un filtre:</u></b> Afficher le nombre  d'étudiant inscrit dans un TP en fonction du niveau.

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="editable">
        <thead>
            <tr class="MCenter">
                <th>Année en cours</th>
                <th>Niveau</th>
                <th>TP</th>
                <th>Nombre Etudiant</th>
                <th>Nombre Groupe</th>
                <th>Nb/Groupe</th>
            </tr>
        </thead>

        <tbody id="Tbody">
            <tr  class="MCenter">
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr> 
        </tbody>
        
    </table>
</div>

    </div><!-- fin card shadow -->
</div><!-- fin card-body -->
<!-- ****************************** Mini bilan *********************************** -->







<!-- ******************** CONTENU GLOGAL ****************************** -->
    </div> <!-- fin col-12 col-md-9 -->
</div> <!-- fin row -->

<div class="row">
    <div class="col-12 "></div> 
</div>








<!-- Modal Filiere-->
<div class="modal fade" id="ajoutNiveauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('configGroupe.store')}}" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajoutez un Groupe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Libelle Groupe:</b>
            <input type="text" name="LibelleGroupe"  class="form-control" required id="" placeholder="Groupe 1">
        </div>


        <div class="form-group">
            <b>Salle:</b>
            <select class="form-control" required name="SalleId" id="modale_etat_anne">
                <option value="" >--Choisir--</option>

                < ?php foreach ($Liste_Salle as $key => $Salle): ?>
                <option value="< ?=$Salle->id ?>">< ?=$Salle->LibelleSalle ?></option>
                < ?php endforeach ?>
                
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













<!-- Modal ConfigGroupe -->
<div class="modal fade" id="ConfigGroupeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('configGr')}}" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Configurez les Groupes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Niveau:</b>
            <select class="form-control" required name="NiveauId" id="modale_etat_anne">
                <option value="" >--Choisir--</option>

                <?php foreach ($Liste_Niveau as $key => $Niveau): ?>
                <option value="<?=$Niveau->id ?>"><?=$Niveau->LibelleNiveau?> <?=$Niveau->filiere->LibelleFiliere?></option>
                <?php endforeach ?>
                
            </select>
        </div>

        <div class="form-group">
            <b>TP:</b>
            <select class="form-control" required name="TpId" id="modale_etat_anne">
                <option value="" >--Choisir--</option>

                <?php foreach ($Liste_TP as $key => $tp): ?>
                <option value="<?=$tp->id ?>"><?=$tp->LibelleTp ?></option>
                <?php endforeach ?>
                
            </select>
        </div>

        <div class="form-group">
            <b>Nombre étudiant par groupe</b>
            <input type="text" name="nbGroupe"  class="form-control" required id="">
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













<!-- Modal Filtre -->
<div class="modal fade" id="FiltreGroupeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="ddddd" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Faire un filtre des groupes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Niveau:</b>
            <select class="form-control" required name="NiveauIdFiltre" id="modale_Niveau">
                <option value="" ><b>--Choisir--</b></option>

                <?php foreach ($Liste_Niveau as $key => $Niveau): ?>
                <option value="<?=$Niveau->id ?>"><?=$Niveau->LibelleNiveau?> <?=$Niveau->filiere->LibelleFiliere?></option>
                <?php endforeach ?>
                
            </select>
        </div>

        <div class="form-group">
            <b>TP:</b>
            <select class="form-control" required name="TpIdFiltre" id="modale_Tp">
                <option value="" ><b>--Choisir--</b></option>

                <?php foreach ($Liste_TP as $key => $tp): ?>
                <option value="<?=$tp->id ?>"><?=$tp->LibelleTp ?></option>
                <?php endforeach ?>
                
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fremer</button>
        <button type="button" data-bs-dismiss="modal" class="btn btn-primary" onclick="AfficheBilan()">Valider</button>
     </div>
    </form><!-- fin form -->
    </div>
  </div>
</div>


















<script type="text/javascript">

 

// {"1":"Inactive",}
$(document).ready(function(){
   
   /*********************** Controle de saisie*************/
  // $('#LibelleFiliere').mask('00/00/0000');
  // $('#numero').mask('0000000000'); Pour ne accepter que des nombres
/*********************** Controle de saisie*************/

// **************************************************************
// Formatage de la liste de filières
var Salles = '{';
<?php foreach ($Liste_Salle as $key => $Salle): ?> 
    Salles = Salles+'"<?=$Salle->id ?>":"<?=$Salle->LibelleSalle ?>",';
<?php endforeach ?>

Salles = Salles.slice(0, Salles.length - 1);
Salles = Salles+'}';
// **************************************************************
// alert(< ?php echo count($Liste_Salle); ?>);
// alert(Salles.charAt(Salles.length -2));
// alert(Salles);



// Supprimer un caractère spécifique en JS
/*const removeCharacterFromString = (position) => { 
    originalWord = 'DelftStack'; 
    newWord = originalWord.slice(0, position - 1) 
    + originalWord.slice(position, originalWord.length); 

    document.querySelector('#outputWord').textContent  
    = newWord; 
}
*/


  $.ajaxSetup({
    headers:{
      'X-CSRF-Token' : $("input[name=_token]").val()
    }
  });

  $('#editable').Tabledit({
    url:'{{ route("tabledit_Groupe") }}',
    dataType:"json",
    columns:{
        /*On donne la colonne des id comme identifiant et le numéro de chaque colonne à modifiée*/
      identifier:[0, 'id'], /*0 est le premier élément du tableau. les id mais en display none. 1 est N°*/
      editable:[[3, 'SalleId',Salles]]
    },
    restoreButton:false,
    onSuccess:function(data, textStatus, jqXHR)
    {

      if(data.action == 'delete')
      {
        $('#'+data.id).remove();
      }
      console.log('Reponse Jison ******************************');
      // console.log(jqXHR.responseJSON.ExistGroupe);

      console.log('ExistGroupe ******************************');
      var errorMsg = jqXHR.responseJSON.ExistGroupe;
      if (typeof errorMsg !== 'undefined') {
        // myVar is (not defined) OR (defined AND unitialized)
        var data= 'Pas de changement !';
         data= data+'<li>'+errorMsg+'</li>';
        AfficheAlert(data);
        
      } 

    },

    onFail:function(jqXHR, textStatus, errorThrown){
        console.log('Je passe ici ******************************');
        // console.log(jqXHR.responseJSON.errors);
        var errors = jqXHR.responseJSON.errors;
        var data ='';

        Object.entries(errors).forEach(([key,value])=>{
            data = data+'<li>'+value[0]+'</li>';
            
        })
    
        
    
        if(data != ''){

            AfficheAlert(data);
        }
        // console.log(data);
        // console.log(textStatus);
        // console.log(errorThrown);
    }


    
  });

AfficheButton();

    function AfficheButton(){
        /********** Buton Edite ********************/
    var spanButonEdit = document.getElementsByClassName('glyphicon-pencil');
    // console.log(spanButonEdit);
    for (var i = spanButonEdit.length - 2; i >= 0; i--) {
        // console.log(spanButonEdit[i]); 
        spanButonEdit[i].className = "fas fa-edit btnEditeTable";
    }

/*    var spanButonEditTest = document.getElementsByClassName('fas fa-edit ');
    console.log(spanButonEditTest);*/


/*********** Button Sup **************************/
    var spanButonSup = document.getElementsByClassName('glyphicon-trash');
    // console.log(spanButonSup);
    for (var i = spanButonSup.length - 2; i >= 0; i--) {
        // console.log(spanButonSup[i]); 
        spanButonSup[i].className = "fas fa-trash-alt btnSupTable";
    }

/*    var spanButonSupTest = document.getElementsByClassName('fas fa-trash-alt ');
    console.log(spanButonSupTest);*/


/*    var ListeTD = document.getElementsByTagName('td');*/
    var  LeTableGroupe = document.getElementsByClassName('tableGroupe');
    var  ListeTD = LeTableGroupe[0].getElementsByTagName('td');
    ListeTD[ListeTD.length-1].innerHTML="<b>Action</b>"
    console.log(ListeTD[ListeTD.length-1]);


    // var ListeTH = document.getElementsByTagName('th');
    var ListeTH = LeTableGroupe[0].getElementsByTagName('th');
    ListeTH[4].innerHTML="<b>Action</b>";
    console.log(ListeTH[4]);

    }


function AfficheAlert(message){
      var alertMsg = '<div class="alert alert-danger d-flex align-items-center">';
        alertMsg = alertMsg+'<ul id="ul_alert">';

        alertMsg = alertMsg+message;
        
        alertMsg = alertMsg+'</ul>';
        alertMsg = alertMsg+'</div>';

    document.getElementById('ul_alert').innerHTML = alertMsg;
    setTimeout(function() {
     document.getElementById('ul_alert').innerHTML = "";
    },5000);
}


});  /*** FIN document ready **************/












// !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function AfficherTableau(Donnees){
         // anneeUniv niveau tp nbEtudiant nbGroupe nbParGroupe

console.log('Je commence');
// console.log(Donnees);
var TrTd ='';


TrTd +='      <tr  class="MCenter"  id="tr">';
TrTd +='                <td>' +Donnees.anneeUniv+ '</td>';
TrTd +='                <td>' +Donnees.niveau+ '</td>';
TrTd +='                <td>' +Donnees.tp+ '</td>';
TrTd +='                <td>' +Donnees.nbEtudiant+ '</td>';
TrTd +='                <td>' +Donnees.nbGroupe+ '</td>';
TrTd +='                <td>' +Donnees.nbParGroupe+ '</td>';
TrTd +='       </tr>';
TrTd +='';
TrTd +='';

    // console.log(TrTd);
document.getElementById('Tbody').innerHTML = TrTd;
}/*fin function*/
// !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!






// !!!!!!!!!!!!!!!!!!!    LA FONCTION PRINCIPALE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function AfficheBilan(){
        viderTableau(); // On vide le tableau en attendant la réponse de l'API
// modale_Niveau
// modale_Tp
        var idNiveau = document.getElementById('modale_Niveau').value;
        var idTP = document.getElementById('modale_Tp').value;
        // console.log(idTP);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           var myArr = JSON.parse(this.responseText);  //Je transforme la réponse en array()
           var i=0;
           var DonneesBD = myArr;
           // console.log(DonneesBD);
           // viderTableau();
         // anneeUniv niveau tp nbEtudiant nbGroupe nbParGroupe
           AfficherTableau(DonneesBD); // Comme j'ai les données, je peut afficher le tableau
           }
        };

        url = "https://una-scolarite.herokuapp.com/APIMarqueurs";
        url = "http://localhost/site-etu-tp/public/configFiltreG/"+idNiveau+"/"+idTP;
        // alert(url);
        xhttp.open("GET",url , true);
        xhttp.send();

   
}
// !!!!!!!!!!!!!!!!!!!    LA FONCTION PRINCIPALE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


function viderTableau(){
    document.getElementById('Tbody').innerHTML = '';
}






</script>
@endsection   

<!-- <button type="button" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></button> -->
<!-- 
<button type="button" class="tabledit-delete-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button>
 -->