
@extends(' layouts.app')

@section('contenu')
<div class="row d-flex justify-content-center  align-items-center div_inscript">    

<div class="col-10 col-md-6">


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


 <div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary MCenter" id="info_tp">Info Admin</h1>
  </div>
    <div class="card-body">


        <form action="{{route('config.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <b>Nom:</b>
                <input class="form-control unTest" required type="text" name="nom" value="{{ old('nom') }}">
            </div>

            <div class="form-group">
                <b>Prénom:</b>
                <input class="form-control unTest" required type="text" name="prenom" value="{{ old('prenom') }}">
            </div>
           
            <div class="form-group">
                <b>Email:</b>
                <input class="form-control unTest" required type="text" name="email" value="{{ old('email') }}">
            </div>
           
            <div class="form-group">
                <b>Mot de passe:</b>
                <input class="form-control unTest" required type="password" name="passe" >
            </div>
           
            <div class="form-group">
                <b>Confirmez le mot de passe:</b>
                <input class="form-control unTest" required type="password" name="confirme_pass" >
            </div>
           
            <div class="row d-flex justify-content-center">
                <div class=" col-6">              
                  <a href="{{route('accueil')}}"><button type="button" class="btn btn-primary btnSuivRetour">Retour</button></a>
                </div>

                <div class=" col-6 ">
                  <button id="suivant" class="btn btn-success btnSuivRetour" type="submit" >Valider</button>
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


