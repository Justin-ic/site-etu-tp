
@extends('layouts.app')

@section('contenu')

<div class="row d-flex justify-content-center align-items-center mt-4">
    <div class="col-12 col-md-12">

        @foreach($ListeEtuInscrit as $LigneInsscrit)


        <?php 
        $dateTable = array();
        for ($i=0; $i < $LigneInsscrit->presences->count(); $i++) { 
                $dateTable[$i] = $LigneInsscrit->presences[$i]->created_at->format('d/m/Y');
                // echo $LigneInsscrit->notes[$i]->created_at->format('d/m/Y');

         } ?>
        @break
        @endforeach


<!-- ****************************** Mini bilan *********************************** -->
<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary"><u>Historique Appel:</u> {{$LeNiveau->LibelleNiveau}} <b>=></b> {{$LeNiveau->filiere->LibelleFiliere}} <b>=></b> {{$LeTP->LibelleTp}} <b>=></b> <b>G{{$LeGroupe->numeroG}} </b></h2>
            </div>
            <div class="col-sm-3 d-flex justify-content-end ms-auto p-2">
                <a href="{{ route('config.index') }}">
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left "></i>
                        Retour
                    </button>
                </a>
            </div>
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
          document.getElementById('ul_alert_error').innerHTML = "";},10000);</script>
          @endforeach
      </ul>
  </div>
</div>
@endif
<div id="ul_alert">

</div>

<h4><b><u>NB:</u></b> Dans cette section, on ne peut que modiffier une présence existante.</h4>

<div class="table-responsive">
    @csrf
	<table class="table table-bordered table-striped tableGNontes" id="editable">
		<thead>
			<tr class="MCenter">
				<th>N°</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>NCE</th>
                <?php 
                for ($i=1; $i <= $LigneInsscrit->presences->count(); $i++) {  ?>
                    <th>{{$dateTable[$i-1]}} </th>
                <?php } ?>
                    <th>Total:</th>
			</tr>
		</thead>
		<tbody>
			<?php $cpt=1; $present=0; ?>
			@foreach($ListeEtuInscrit as $LigneInsscrit)
			<!-- @ dd($LigneInsscrit->etudiant->Nom); -->
			<tr>
                <td style="display: none;">{{$LigneInsscrit->id}}</td>
				<td class="MCenter"><?=$cpt++?></td>
				<td>{{$LigneInsscrit->etudiant->Nom}}</td>
				<td>{{$LigneInsscrit->etudiant->Prenom}}</td>

				<td>{{$LigneInsscrit->etudiant->NCE}}</td>

				<!-- @ foreach($LigneInsscrit->notes as $LaNote) -->


				<?php $present=0; for ($i=0; $i < $LigneInsscrit->presences->count(); $i++) { ?>
					<td class="MCenter">{{$LigneInsscrit->presences[$i]->etat}}</td>
                    <?php 
                        if ($LigneInsscrit->presences[$i]->etat == 1) {
                            $present++;
                        }
                     ?>

                     <!-- < ?php for ($i=0; $i < $LigneInsscrit->presences->count(); $i++) { ?>
                     < ?php if ($LigneInsscrit->presences[$i]->etat == 1): $present++;?>
                         <td class="MCenter"><span class="fas fa-check-circle"></span></td>
                     < ?php else: ?>
                         <td class="MCenter"><span class="fas fa-times-circle"></span></td>
                     < ?php endif ?> -->

				<?php } ?>

                    <td class="MCenter"><?php echo $present."/".$LigneInsscrit->presences->count(); ?></td>
			</tr>
			@endforeach
			<!-- @ endforeach -->
		</tbody>
	</table>

</div>

    </div><!-- fin card shadow -->
</div><!-- fin card-body -->
<!-- ****************************** Mini bilan *********************************** -->







<!-- ******************** CONTENU GLOGAL ****************************** -->
    </div> <!-- fin col-12 col-md-12 -->
</div> <!-- fin row -->







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

                < ?php foreach ($Liste_Niveau as $key => $Niveau): ?>
                <option value="< ?=$Niveau->id ?>">< ?=$Niveau->LibelleNiveau?> < ?=$Niveau->filiere->LibelleFiliere?></option>
                < ?php endforeach ?>
                
            </select>
        </div>

        <div class="form-group">
            <b>TP:</b>
            <select class="form-control" required name="TpIdFiltre" id="modale_Tp">
                <option value="" ><b>--Choisir--</b></option>

                < ?php foreach ($Liste_TP as $key => $tp): ?>
                <option value="< ?=$tp->id ?>">< ?=$tp->LibelleTp ?></option>
                < ?php endforeach ?>
                
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
$(document).ready(function(){
   
   /*********************** Controle de saisie*************/
  // $('#LibelleAnnee').mask('00/00/0000');
  // $('#numero').mask('0000000000'); Pour ne accepter que des nombres
/*********************** Controle de saisie*************/
var tab=new Array();
tab[0]=Array(2,"Lundi");
tab[1]=Array(2,"Mardi");
tab[2]=Array(2,"Mercredi");
tab[3]=Array(2,"Jeudi");
tab[4]=Array(2,"Vendredi");
tab[5]=Array(2,"Samedi");
tab[6]=Array(2,"Dimanche");
var longueur=tab.length;

var test = [[5, 'Note_1'], [6, 'Note_2'], [7, 'Note_3'], [8, 'Note_4'], [9, 'Note_5'], [10, 'Note_6'], [11, 'Note_7'], [12, 'Note_8'], [13, 'Note_9'], [14, 'Note_10']];


var appel = Array();
var cpt=0;
for (var i = 0; i < <?=$LigneInsscrit->presences->count()?> ; i++) {
    appel[cpt++] = Array(i+5,"appel_"+cpt);
}



console.log(test);
console.log(tab);
console.log(appel);

  $.ajaxSetup({
    headers:{
      'X-CSRF-Token' : $("input[name=_token]").val()
    }
  });

  $('#editable').Tabledit({
    url:'{{ route("tabledit_Presence") }}',
    dataType:"json",
    columns:{
        /*On donne la colonne des id comme identifiant et le numéro de chaque colonne à modifiée*/
      identifier:[0, 'id'], /*0 est le premier élément du tableau. les id mais en display none. 1 est N°*/
      editable:appel
    },
    restoreButton:false,
    onSuccess:function(data, textStatus, jqXHR)
    {

      if(data.action == 'delete')
      {
        $('#'+data.id).remove();
      }
      console.log('Reponse Jison ******************************');
      console.log(jqXHR.responseJSON.noteIncorrecte);

      console.log('noteIncorrecte ******************************');
      var errorMsg = jqXHR.responseJSON.noteIncorrecte;
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
    
        
    
console.log();
        if(data != ''){

            AfficheAlert(data);
        }
        console.log(data);
        // console.log(textStatus);
        // console.log(errorThrown);
    }


    
  });

AfficheButton();

    function AfficheButton(){
        /********** Buton Edite ********************/
    var spanButonEdit = document.getElementsByClassName('glyphicon-pencil');
    // console.log(spanButonEdit);
    for (var i = spanButonEdit.length - 1; i >= 0; i--) {
        // console.log(spanButonEdit[i]); 
        spanButonEdit[i].className = "fas fa-edit btnEditeTable";
    }

/*    var spanButonEditTest = document.getElementsByClassName('fas fa-edit ');
    console.log(spanButonEditTest);*/


/*********** Button Sup **************************/
    // Pas de bouton supprimmer dans les appels
    var spanButonSup = document.getElementsByClassName('tabledit-delete-button');
    // console.log(spanButonSup);
    for (var i = spanButonSup.length - 1; i >= 0; i--) {
        spanButonSup[i].remove();
        console.log(spanButonSup[i]); 
    }


    var ListeTH = document.getElementsByTagName('th');
    ListeTH[<?=$LigneInsscrit->presences->count()+4+1 ?>].innerHTML="<b>Action</b>";
    console.log(ListeTH[<?=$LigneInsscrit->presences->count()+4+1 ?>]);

/*    var ListeTD = document.getElementsByTagName('td');
    ListeTD[ListeTD.length-1].innerHTML="<b>Action</b>";
    ListeTD[ListeTD.length-1].classList.add('MCenter');
    console.log(ListeTD[ListeTD.length-1]);*/
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
    },10000);
}


});  /*** FIN document ready **************/




</script>

@endsection   
