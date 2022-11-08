<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Custom Error Page</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('styles/bootstrap/bootstrap5_2_1.min.css') }}">
    <!-- http://localhost/site-etu-tp/public/styles/bootstrap/bootstrap5_2_1.min.css -->
</head>
<body class="alert alert-danger">
    <div class="container-fluid">
        <div class="row text-center d-flex justify-content-center align-items-center" style="height: 100vh; ">
            <div class="col-12">
                <div class="row">
                    <div class="col-12" style=""><h2 class="display-3">404</h2></div>
                    <div class="display-5 col-12" style="">{{$message}} <br><br></div>
                    <div class=" col-12 d-flex justify-content-center" style="">
                     <a href="{{route('connexion')}}" class="btn btn-primary d-grid gap-2 col-12 col-md-8 a_text_accueil">
                       <h1 class="MCenter h1_accueil">Retour au portail !</h1>
                   </a>
                   <!-- <button  id="download" class="btn btn-primary"> PDF</button> -->
               </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>