
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

    <div class="row">


        <a href="{{route('annee_univs.index')}}" type="" class="col-md-3 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Deffinir l'année universitaire
            </button>
        </a>

        <a href="{{route('filieres.index')}}" type="" class="col-md-3 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Ajouter un filière
            </button>
        </a>


        <a href="{{route('niveaux.index')}}" type="" class="col-md-3 col-12   confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
                Ajouter un niveau
            </button>
        </a>


        <a href="{{route('Tps.index')}}" type="" class="col-md-3 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
               Ajouter un TP
           </button>
       </a>


       <a href="{{route('configSalleTps.index')}}" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Ajouter une salle de TP
        </button>
    </a>
    

    <a href="{{route('configGroupe.index')}}" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Configurer les groupes
        </button>
    </a>


    <a href="aaaaaaaa" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Faire un évaluation
        </button>
    </a>
    




<br><br><br><br><br><br><br><br><br>


<!-- ****************************** Mini bilan *********************************** -->
<div class="col-12  ">
    <div class="row d-flex justify-content-center mt-4 borderTest">
        <div class="col-10 ">


            <div class="card shadow mb-4 TableCard">
                <div class="card-header py-3">
                    <div class="row d-flex">
                        <div class="col-sm-9 d-flex justify-content-start">
                            <h2 class="m-0 font-weight-bold text-primary">Etat de la configuration</h2>
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
                    Vous avez au total 10 étudiants inscrit dont:
                    TP: Langage C nb ETu, nb Groupe

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="editable">
                            <thead>
                                <tr class="MCenter">
                                    <th>N°</th>
                                    <th>Libelle groupe</th>
                                    <th>Salle</th>
                                    <th>Date Modif</th>
                                </tr>
                            </thead>

                            <tbody id="Tbody">
                                <tr  class="MCenter">
                                 <td>Groupe pas défini</td>
                                 <td>Groupe pas défini</td>
                                 <td>Groupe pas défini</td>
                                 <td>Groupe pas défini</td>
                             </tr> 
                         </tbody>

                         <tfoot  class="MCenter">
                            <th>N°</th>
                            <th>Libelle groupe</th>
                            <th>Salle</th>
                            <th>Date Modif</th>
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




<!-- 

  <table id="my_table_id"
    data-url="data/url.json"
    data-id-field="id"
    data-editable-emptytext="Default empty text."
    data-editable-url="/my/editable/update/path">
    <thead>
      <tr>
        <th class="col-md-1" data-field="id" data-sortable="true" data-align="center">#</th>
        <th class="col-md-4" data-field="name" data-editable="true">Name</th>
        <th class="col-md-7" data-field="description" data-editable="true" data-editable-emptytext="Custom empty text.">Description</th>
      </tr>
    </thead>
  </table> -->
@endsection

