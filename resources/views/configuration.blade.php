
<!-- borderTest -->
@extends(' layouts.app')

@section('contenu')

<div class="container-fluid">
 <div class="row conf_row_titl mb-4">
     <div class="col-12 conf_titl MCenter ">
         Administration du système:
     </div><br><br>
     <div class="col-12 conf_titl MCenter">
         Configurez chaque étape pour que le système soit opérationnel.
     </div>
 </div> <!-- Fin <div class="row conf_row_titl"> -->



    <div class="row d-flex justify-content-center">

        <a href="{{route('annee_univs.index')}}" type="" class="col-md-4 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Deffinir l'année universitaire
            </button>
        </a>

        <a href="{{route('filieres.index')}}" type="" class="col-md-4 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Ajouter un filière
            </button>
        </a>


        <a href="{{route('niveaux.index')}}" type="" class="col-md-4 col-12   confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Ajouter un niveau
            </button>
        </a>


        <a href="{{route('Tps.index')}}" type="" class="col-md-4 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
               Ajouter un TP
           </button>
       </a>


       <a href="{{route('configSalleTps.index')}}" type="" class="col-md-4 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Ajouter une salle de TP
        </button>
    </a>
    

    <a href="{{route('configGroupe.index')}}" type="" class="col-md-4 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Configurer les groupes
        </button>
    </a>


<!--     <a class="col-12 col-md-8  confid_a mt-4 config_buttonEval" data-bs-toggle="modal" data-bs-target="#detaillesGModal">
        <button href="" class="btn config_button config_buttonEval">
            Détailles sur les notes
        </button>
    </a> -->




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
        </div>
    </div>





<!-- <pre>
    < ?php print_r($donnees); ?>
</pre> -->
<!-- ****************************** Mini bilan *********************************** -->
<div class="col-12  ">
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-12 ">


            <div class="card shadow mb-4 TableCard">
                <div class="card-header py-3">
                    <div class="row d-flex">
                        <div class="col-sm-9 d-flex justify-content-start">
                            <h2 class="m-0 font-weight-bold text-primary">Etat de la configuration</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                <h1>Année universitaire: {{$anneActive->LibelleAnnee}}</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table_Bilan" id="editable">
                        <thead>
                            <tr class="MCenter">
                                <th>Niveau</th>
                                <th>TP</th>
                                <th>Nb Etudiant</th>
                                <th>Nb Groupe</th>
                                <th>Nb/Groupe</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>
  
                        <tbody id="Tbody">

                             <?php foreach ($donnees as $La_Ligne): ?>
                                <tr class="">
                                    <td> {{$La_Ligne['Niveau']['LibelleNiveau']}}</td>
                                    <td> {{$La_Ligne['TP']['libelleTP']}}</td>
                                    <td class="MCenter"> {{$La_Ligne['nbEtudiant']}}</td>
                                    <td class="MCenter"> {{$La_Ligne['NbGroupe']}}</td>
                                    <td class="MCenter"> {{$La_Ligne['NbParGroupe']}}</td>
                                   
 <!-- {"idNiveau":"2","niveau":"L1 Math Info","tpId":"4","TpLibelle":"Langage C","NbG":"3"} -->
                                    <?php $idNiveau = $La_Ligne['Niveau']['id']; $idTP = $La_Ligne['TP']['id']; ?>
                                    <?php
                                    $data = array( 
                                        'idNiveau' => $idNiveau,
                                        'niveau' => $La_Ligne["Niveau"]["LibelleNiveau"],
                                        'tpId' => $idTP,
                                        'TpLibelle' => $La_Ligne["TP"]["libelleTP"],
                                        'NbG' => $La_Ligne["NbGroupe"]
                                     );
                                      ?>

                                      <?php if ( $La_Ligne["nbEtudiant"]==0): ?>
                                         <td class="MCenter">
                                            <a class="confid_axxxx">
                                                <button class="btn btn-primary config_detail_button disabled ">
                                                    Détails
                                                </button>
                                            </a>
                                        </td>
                                      <?php else: ?>
                                        <td class="MCenter">
                                            <a href="{{route('configDetailG',[$idNiveau,$idTP])}}" class="confid_axxxx">
                                                <button class="btn btn-primary config_detail_button">
                                                    Détails
                                                </button>
                                            </a>
                                        </td>
                                      <?php endif  ?> 

                                      <?php if ( $La_Ligne["NbGroupe"]==0): ?>
                                          <td class="MCenter"> 
                                            <a  class="" >
                                                <button class="btn btn-warning disabled  config_detail_button" style="background-color:#e8cc78;" data-bs-toggle="modal" data-bs-target="#detaillesGModal" data-bs-whatever='' title="Il n'y a pas de groupe.">
                                                    Notes
                                                </button>
                                            </a>
                                         </td>
                                         <td class="MCenter"> 
                                            <a  class="" >
                                                <button class="btn btn-warning disabled  config_detail_button" style="background-color:#e8cc78;" data-bs-toggle="modal" data-bs-target="#choixGroupe" data-bs-whatever='' title="Il n'y a pas de groupe.">
                                                    Evaluation
                                                </button>
                                            </a>
                                         </td>
                                      <?php else: ?>
                                        <td class="MCenter"> 
                                            <a type="" class="confid_axxxx" >
                                                <button class="btn btn-warning config_detail_button" data-bs-toggle="modal" data-bs-target="#detaillesGModal" data-bs-whatever='<?=json_encode($data)?>'>
                                                    Notes
                                                </button>
                                            </a>
                                        </td>
                                        <td class="MCenter"> 
                                            <a type="" class="confid_axxxx" >
                                                <button class="btn btn-warning config_detail_button" data-bs-toggle="modal" data-bs-target="#choixGroupe" data-bs-whatever='<?=json_encode($data)?>'>
                                                    Evaluation
                                                </button>
                                            </a>
                                        </td>
                                      <?php endif  ?> <?php $data=""; ?>
                                    
                                </tr> 
                            <?php endforeach ?> 

                        </tbody>

                        <tfoot  class="MCenter">
                            <th>Niveau</th>
                            <th>TP</th>
                            <th>Nb Etudiant</th>
                            <th>Nb Groupe</th>
                            <th>Nb/Groupe</th>
                            <th colspan="3">Action</th>
                        </tfoot>
                    </table>
                </div>

            </div><!-- fin card-body-->
        </div><!-- fin  card shadow mb-4 TableCard-->
    </div> <!-- fin col-10 d-flex -->
</div>
</div><!-- fin div col-12 col-md-12 -->
<!-- ****************************** Mini bilan *********************************** -->


  </div><!-- Fin row  -->
</div> <!-- Fin containeur fluide -->





<!-- Modal faire evaluation    Modal avec reception de données -->
<div class="modal fade" id="choixGroupe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Choisir un groupe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="{{route('evaluation')}}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label class="col-form-label"><b>Niveau:</b></label>
                <input type="text" class="form-control" disabled required readonly id="niveau">
                <input type="hidden" id="idNiveau" name="idNiveau">
            </div>
            <div class="mb-3">
                <label class="col-form-label"><b>TP:</b></label>
                <input type="text" class="form-control" disabled required readonly id="TpLibelle">
                <input type="hidden" id="tpId" name="tpId" >
            </div>


            <div class="form-group">
                <b>Groupe:</b>
                <select class="form-control  " id="Num_G" required name="Num_G" id="modale_etat_anne" >
                    <option value="" >--Choisir--</option>
                    
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Démmarer</button>
        </div>
    </form>
  </div>
 </div>
</div>













<!-- Modal affiche les note en fonction des paramêttre    Modal avec reception de données -->
<div class="modal fade" id="detaillesGModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Afficher les notes de:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="{{route('afficheNotes')}}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label class="col-form-label"><b>Niveau:</b></label>
                <input type="text" class="form-control" disabled required readonly id="niveau_Notes">
                <input type="hidden" id="idNiveau_Notes"  name="idNiveau_Notes">
            </div>
            <div class="mb-3">
                <label class="col-form-label"><b>TP:</b></label>
                <input type="text" class="form-control" disabled required readonly id="TpLibelle_Notes">
                <input type="hidden" id="tpId_Notes" name="tpId_Notes" >
            </div>

            <div class="form-group">
                <b>Groupe:</b>
                <select class="form-control  " id="Num_G_Notes" required name="Num_G_Notes" id="modale_etat_anne" >
                    <option value="" >--Choisir--</option>
                    
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Démmarer</button>
        </div>
    </form>
  </div>
 </div>
</div>















<script type="text/javascript">
    


const exampleModal = document.getElementById('choixGroupe')
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var data = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
    console.log(data);
    data = JSON.parse(data);
  console.log(data);
  console.log(' idNiveau='+data.idNiveau+' niveau='+data.niveau+' tpId='+data.tpId+' TpLibelle='+data.TpLibelle+' NbG='+data.NbG);

  document.getElementById('Num_G').innerHTML = "";
    var i;
    for (i = 1; i <= data.NbG; i++) {
        var leSellect = document.getElementById('Num_G');
        leSellect.options[leSellect.options.length]= new Option('Groupe '+i,i);
    }
    document.getElementById('niveau').value = data.niveau;
    document.getElementById('TpLibelle').value = data.TpLibelle;
    document.getElementById('idNiveau').value = data.idNiveau;
    document.getElementById('tpId').value = data.tpId;

})



const exampleModalNotes = document.getElementById('detaillesGModal')
exampleModalNotes.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var data = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
    console.log(data);
    data = JSON.parse(data);
  console.log(data);
 /* console.log(' idNiveau='+data.idNiveau+' niveau='+data.niveau+' tpId='+data.tpId+' TpLibelle='+data.TpLibelle+' NbG='+data.NbG);*/

  document.getElementById('Num_G_Notes').innerHTML = "";
    var i;
    for (i = 1; i <= data.NbG; i++) {
        var leSellect = document.getElementById('Num_G_Notes');
        leSellect.options[leSellect.options.length]= new Option('Groupe '+i,i);
    }
    document.getElementById('niveau_Notes').value = data.niveau;
    document.getElementById('TpLibelle_Notes').value = data.TpLibelle;
    document.getElementById('idNiveau_Notes').value = data.idNiveau;
    document.getElementById('tpId_Notes').value = data.tpId;

})

</script>

@endsection


