
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


        <a href="{{route('Tps.index')}}" type="" class="col-md-12 col-12  confid_a">
            <button href="" class="btn btn-warning  btn btn-warning config_button">
               Ajouter un TP
           </button>
       </a>


       <a href="{{route('configSalleTps.index')}}" type="" class="col-md-6 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Ajouter une salle de TP
        </button>
    </a>
    

    <a href="{{route('configGroupe.index')}}" type="" class="col-md-6 col-12  confid_a">
        <button href="" class="btn btn-warning  btn btn-warning config_button">
            Configurer les groupes
        </button>
    </a>




<div id="ul_alert_success" class="col-6 mt-4"> 
    <div class="alert d-flex align-items-center justify-content-center alert_success">
        {{$configNonTerminer}}
  </div>
</div>



  </div><!-- Fin row  -->
</div>

@endsection

