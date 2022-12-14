@extends('layouts.app')

@section('contenu')

<!-- ****************************** GESTION DES FILIERES *********************************** -->
<div class="row d-flex justify-content-center align-items-center mt-4">
    <div class="col-12 col-md-9">


<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-12 col-md-8 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary">Gestion des <b>TPs</b></h2>

            </div>
            <div class="col-12 col-md-4 d-flex justify-content-end ms-auto p-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mx-4" data-bs-toggle="modal" data-bs-target="#ajoutInfoTPModal">
                    <i class="fas fa-file-alt"></i>
                    Info TP
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutTPModal">
                    <i class="fas fa-plus "></i>
                    Ajouter TP
                </button>
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

<div class="row mt-4">
    <div class="col-12 d-flex justify-content-center">
     <?php if (!isset($_SESSION)) { session_start(); } ?>
     @if (session('status')) 
     <div id="ul_alert_error" class=" col-12 col-md-8 d-flex justify-content-center ">
        <div class="MCenter h1_alert alert alert-danger">
           {{session('status')}}
           <script type="text/javascript">setTimeout(function() {
           document.getElementById('ul_alert_error').innerHTML = "";},10000);</script>
        </div>
     </div>
     @endif

    </div>
</div>





<div class="table-responsive">
    @csrf
    <h1 class="MCenter"></h1>
    <table class="table table-bordered table-striped" id="editable">
        <thead>
            <tr class="MCenter">
                <th>N??</th>
                <th>Libelle</th>
                <th>Date Modif</th>
                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);
/*guichet_service
guichet_personnel*/ 
 ?></pre> -->
        <tbody>
            <?php $i=1; if ($Liste_Tp->count() > 0):  if (isset($_GET['page'])) {{ $i=$_GET['page']*5 - 4;}} ?>
                <?php foreach ($Liste_Tp as $La_Liste_Tp): ?>
            <tr  class="MCenter">

                <td style="display: none;">{{$La_Liste_Tp->id}}</td>
                <td><?=$i++ ?></td>
                <td>{{$La_Liste_Tp->LibelleTp}}</td>
                <td>{{$La_Liste_Tp->updated_at->format('d/m/Y')}}</td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>
        </tbody>
        
        <tfoot  class="MCenter">
            <th>N??</th>
                <th>Libelle</th>
                <th>Date Modif</th>
            <!-- <th colspan="2">Action</th> -->
        </tfoot>
    </table>
</div>

    <div class="row">
        <div class="col-9 ">
            <div class="paginate float-end">
                {{ $Liste_Tp->links() }}   
            </div>
        </div>
    </div>

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














<!-- Modal Ajout Infos TP-->
<div class="modal fade"  id="ajoutInfoTPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">

    <form action="{{route('update_TP')}}" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modiffier les informations sur TP</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
<!--         <div class="form-group">
          <b>TP:</b>
          <select class="form-control" required name="TpId" id="modale_etat_anne">
            <option value="" >--Choisir--</option>

            < ?php foreach ($Liste_Tp as $key => $LeTP): ?>
              <option value="< ?=$LeTP->id ?>">< ?=$LeTP->LibelleTp ?></option>
            < ?php endforeach ?>
          </select>
        </div> -->   
        <b><u>NB:</u></b> Vous pouvez saisir le texte sur un autre fichier et coller le rendu ici. <br>
        <b><u>Remarque:</u></b> Pour faire un retours ?? la ligne, saisissez deux ??toilles ?? la place. Ex: <br>pararaphe 1 <br>
        **<br>
        pararaphe 2
        <div class="form-group mt-4">
            <b>Votre text:</b>
            <textarea type="textarea" name="LeTexte"  class="form-control " required id=""></textarea>
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













<script type="text/javascript">
$(document).ready(function(){
   
   /*********************** Controle de saisie*************/
  // $('#LibelleFiliere').mask('00/00/0000');
  // $('#numero').mask('0000000000'); Pour ne accepter que des nombres
/*********************** Controle de saisie*************/

  $.ajaxSetup({
    headers:{
      'X-CSRF-Token' : $("input[name=_token]").val()
    }
  });

  $('#editable').Tabledit({
    url:'{{ route("tabledit_Tp") }}',
    dataType:"json",
    columns:{
        /*On donne la colonne des id comme identifiant et le num??ro de chaque colonne ?? modifi??e*/
      identifier:[0, 'id'], /*0 est le premier ??l??ment du tableau. les id mais en display none. 1 est N??*/
      editable:[[2, 'LibelleTP']]
    },
    restoreButton:false,
    onSuccess:function(data, textStatus, jqXHR)
    {

      if(data.action == 'delete')
      {
        $('#'+data.id).remove();
      }
      console.log('Reponse Jison ******************************');
      console.log(jqXHR.responseJSON.ExistTp);

      console.log('ExistTp ******************************');
      var errorMsg = jqXHR.responseJSON.ExistTp;
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


    var ListeTD = document.getElementsByTagName('td');
    ListeTD[ListeTD.length-1].innerHTML="<b>Action</b>"
    console.log(ListeTD[ListeTD.length-1]);

    var ListeTH = document.getElementsByTagName('th');
    ListeTH[3].innerHTML="<b>Action</b>";
    console.log(ListeTH[3]);
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




</script>
@endsection   

<!-- <button type="button" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></button> -->
<!-- 
<button type="button" class="tabledit-delete-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button>
 -->