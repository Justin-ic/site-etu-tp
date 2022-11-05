@extends(' layouts.app')

@section('contenu')

<div class="d-flex justify-content-center  align-items-center div_connexion">
<div class="container-fluid ">
<div class="row d-flex justify-content-center align-items-center">
<div class="col-10 col-md-4">
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
        <h1 class="MCenter text_connexion">Connectez-vous!!!</h1> 
        <?php if (isset($message)): ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                {{$message}}
            </div>
        <?php endif ?>

        <form action="{{route('loginEtu')}}" method="POST" class="connexionForme">
            @csrf
            <div class="form-group">
                <b>Email:</b>
                <input class="form-control" required type="text" name="email" placeholder="gnjustin.ic@gmail.com">
            </div>
            <div class="form-group">
              <b>Pass:</b>
              <input class="form-control" type="password" required name="pass">
            </div>
            <div class="d-grid gap-2 col-8 mx-auto btnValide MCenter">
              <button type="submit" class="btn btn-success ">Valider</button> 
              <a href="{{route('etudiant.create')}}"><button type="button" class="btn btn-primary enregisterNouveau">Pas encore enregister ?</button></a>
            </div>
            <!-- borderTest -->
        </form>
    </div>
</div>

</div>

</div>

<!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" > -->
	<!-- <img src="{{ asset('images/carrosels/bg-masthead.jpg') " class="d-block w-100 div_accuil" alt="..."> -->
	<!-- 
  <div class="carousel-inner div_accuil" >
    <div class="carousel-item active">
      <img src="{{ asset('images/carrosels/una1.jpg') " class="d-block w-100 div_accuil" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/una2.jpg') " class="d-block w-100 div_accuil" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/una3.jpg') " class="d-block w-100 div_accuil" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/bg-masthead.jpg') " class="d-block w-100" alt="...">
    </div>
  </div> -->
<!-- </div> -->




@endsection
