@extends(' layouts.app')

@section('contenu')

<div class="d-flex justify-content-center  align-items-center div_connexion">


<div class="container-fluid ">
<div class="row d-flex justify-content-center align-items-center">
    
    <div class="col-10 col-md-4">
        <h1 class="MCenter text_connexion">Administrateur</h1> 
        <h1 class="MCenter text_connexion">Connectez-vous!!!</h1> 
        <?php if (isset($message)): ?>
            <div class="bg-danger bg-opacity-50 MCenter">
                {{$message}}
            </div>
        <?php endif ?>

        <form action="{{route('loginAdmin')}}" method="POST" class="connexionForme">
            @csrf
            <div class="form-group">
                <b>Email:</b>
                <input class="form-control" required type="text" name="user" placeholder="gnjustin.ic@gmail.com">
            </div>
            <div class="form-group">
              <b>Pass:</b>
              <input class="form-control" type="password" required name="pass">
            </div>
            <div class="d-grid gap-2 col-8 mx-auto btnValide MCenter borderTest">
              <button type="submit" class="btn btn-success ">Valider</button> 
              <a href="{{route('config.create')}}"><button type="button" class="btn btn-primary enregisterNouveau">Pas encore enregister ?</button></a>
            </div>
            <!-- borderTest -->
        </form>
    </div>
</div>

</div>

</div>

@endsection
