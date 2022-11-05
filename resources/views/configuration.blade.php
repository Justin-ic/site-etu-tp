
<!-- borderTest -->
@extends(' layouts.app')

@section('contenu')

<div class="container-fluid">
 <div class="row conf_row_titl">
     <div class="col-12 conf_titl MCenter ">
         Administration du système:
     </div><br><br>
     <div class="col-12 conf_titl MCenter">
         Configurez chaque étape pour que le système soit opérationnel.
     </div>
 </div>
<br><br>

    <div class="row d-flex justify-content-center">

        <a class="col-12  confid_a mb-4 config_buttonEval" data-bs-toggle="modal" data-bs-target="#evaluationModal">
            <button href="" class="btn config_button config_buttonEval">
                Démmarer une évaluation
            </button>
        </a>

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

    




<br><br><br><br><br><br><br><br><br>

<!-- <pre>
    < ?php print_r($donnees); ?>
</pre> -->
<!-- ****************************** Mini bilan *********************************** -->
<div class="col-12  ">
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-10 ">


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
                                <th colspan="2">Action</th>
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
                                    <td class="MCenter">
                                        <?php $idNiveau = $La_Ligne['Niveau']['id']; $idTP = $La_Ligne['TP']['id']; ?>
                                        <a href="{{route('configDetailG',[$idNiveau,$idTP])}}" data-bs-toggle="modal" data-bs-target="#evaluationModal" data-whatever="" class="confid_axxxx">
                                            <button href="" class="btn btn-primary config_detail_button">
                                                Détails
                                            </button>
                                        </a>
                                    </td>
 <!-- {"idNiveau":"2","niveau":"L1 Math Info","tpId":"4","TpLibelle":"Langage C","NbG":"3"} -->
                                    <?php
                                    $data = array(
                                        'idNiveau' => $idNiveau,
                                        'niveau' => $La_Ligne["Niveau"]["LibelleNiveau"],
                                        'tpId' => $idTP,
                                        'TpLibelle' => $La_Ligne["TP"]["libelleTP"],
                                        'NbG' => $La_Ligne["NbGroupe"]
                                     );
                                      ?>
                                      <?php if ( $La_Ligne["NbGroupe"]==0): ?>
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
                            <th colspan="2">Action</th>
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
</div>





<!-- Modal faire evaluation    Modal avec reception de données -->
<div class="modal fade" id="choixGroupe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Choisir un groupe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{route('evaluation')}}" method="POST">
            @csrf
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
                <select class="form-control  " id="id_G" required name="id_G" id="modale_etat_anne" >
                    <option value="" >--Choisir--</option>
                    
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Démmarer</button>
        </form>
    </div>
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

  document.getElementById('id_G').innerHTML = "";
    var i;
    for (i = 1; i <= data.NbG; i++) {
        var leSellect = document.getElementById('id_G');
        leSellect.options[leSellect.options.length]= new Option('Groupe '+i,i);
    }
    document.getElementById('niveau').value = data.niveau;
    document.getElementById('TpLibelle').value = data.TpLibelle;
    document.getElementById('idNiveau').value = data.idNiveau;
    document.getElementById('tpId').value = data.tpId;

})

</script>

@endsection


