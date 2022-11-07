@extends('layouts.app')

@section('contenu')

<!-- ****************************** GESTION DES FILIERES *********************************** -->
<div class="row d-flex justify-content-center align-items-center mt-4">
    <div class="col-12 col-md-9">


<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary">Gestion des <b>Filières</b></h2>

            </div>
            <div class="col-sm-3 d-flex justify-content-end ms-auto p-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutFiliereModal">
                    <i class="fas fa-plus "></i>
                    Ajouter filière
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">


<!-- 
  // ****************Erreur lié au libelle***************
@ if ($errors->any())
<div class="alert alert-danger d-flex align-items-center">
    <ul id="ul_alert">
    @ foreach ($errors->get('LibelleFiliere') as $error)
    <li>{$error}</li>
    @ endforeach
    </ul>
</div>
@ endif -->

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

<div class="table-responsive">
    @csrf
    <h1 class="MCenter"></h1>
    <table class="table table-bordered table-striped" id="editable">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
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
            <?php $i=1; if ($Liste_filiere->count() > 0):  if (isset($_GET['page'])) {{ $i=$_GET['page']*5 - 4;}} ?>
                <?php foreach ($Liste_filiere as $La_Liste_filiere): ?>
            <tr  class="MCenter">

                <td style="display: none;">{{$La_Liste_filiere->id}}</td>
                <td><?=$i++ ?></td>
                <td>{{$La_Liste_filiere->LibelleFiliere}}</td>
                <td>{{$La_Liste_filiere->updated_at->format('d/m/Y')}}</td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>
        </tbody>
        
        <tfoot  class="MCenter">
            <th>N°</th>
                <th>Libelle</th>
                <th>Date Modif</th>
            <!-- <th colspan="2">Action</th> -->
        </tfoot>
    </table>
</div>

    <div class="row">
        <div class="col-9 ">
            <div class="paginate float-end">
                {{ $Liste_filiere->links() }}   
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
<div class="modal fade" id="ajoutFiliereModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="{{route('filieres.store')}}" method="POST">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajoutez une filière</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <b>Nom de la filière:</b>
            <input type="text" name="LibelleFiliere"  class="form-control" required id="" placeholder="Math-Info">
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
    url:'{{ route("tabledit_filiere") }}',
    dataType:"json",
    columns:{
        /*On donne la colonne des id comme identifiant et le numéro de chaque colonne à modifiée*/
      identifier:[0, 'id'], /*0 est le premier élément du tableau. les id mais en display none. 1 est N°*/
      editable:[[2, 'LibelleFiliere']]
    },
    restoreButton:false,
    onSuccess:function(data, textStatus, jqXHR)
    {

      if(data.action == 'delete')
      {
        $('#'+data.id).remove();
      }
      console.log('Reponse Jison ******************************');
      console.log(jqXHR.responseJSON.ExistFiliere);

      console.log('ExistFiliere ******************************');
      var errorMsg = jqXHR.responseJSON.ExistFiliere;
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