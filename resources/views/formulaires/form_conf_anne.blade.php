
@extends(' layouts.app')

@section('contenu')
<div class="row d-flex justify-content-center  align-items-center div_inscript mt-4">    

<div class="col-10 col-md-6">

 <div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary MCenter" id="info_tp">Déffinissez l'année en cours</h1>
  </div>
    <div class="card-body">


        <form action="{{route('config.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <b>Année universitaire:</b>
                <select class="form-control" required name="service_id">
                    <option value="" >vv</option>
                    < ?php foreach ($listeService as $service): ?>
                    <option value="{$service->id}">{$service->nom}}</option>
                    < ?php endforeach ?>
                </select>
            </div>

            <div class="row d-flex justify-content-center">
                <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Valider</button>
                </div>

                <div class=" col-6">              
                  <a href="{{route('config.index')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>

                </div>
            </div>
      </form>


   </div><!-- fin card-body  -->
  </div><!-- fin card shadow -->
 </div>
</div>


@endsection

<!-- </body>
</html> -->


