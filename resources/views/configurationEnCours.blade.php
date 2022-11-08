
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

    <div class="row d-flex justify-content-center mt-4">


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

