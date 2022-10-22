
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


       <a href="aaaaaaaa" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Ajouter une salle de TP
        </button>
    </a>
    

    <a href="aaaaaaaa" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Configurer les groupes
        </button>
    </a>


    <a href="aaaaaaaa" type="" class="col-md-3 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Faire un évaluation
        </button>
    </a>
    
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

