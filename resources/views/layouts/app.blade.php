<?php  /*hea der(Access-Control-Allow-Origin: *");*/ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap5_2_1.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/style.css') }}">
  <!-- Pour PDF -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script> --> 
  <link rel="stylesheet" type="text/css" href="{{ asset('images/styleBienvenue.css') }}">
  <script type="text/javascript" src="{{  asset('styles/js/ajax_2_2_0_jquery.min.js')  }}"></script>
  
  <!-- Matérial designe -->
  <!-- <link rel="stylesheet" href="{{  asset('styles/MDB5/ css/mdb.min.css')  }}" /> -->


<!-- ******************************** Templat ******************************************** -->

<!-- ******************************** Templat ******************************************** -->

	<title>Site-UNA-TP</title>

<!-- 	<script type="text/javascript">
function horloge()
{
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
}
</script>  -->

</head>
<!-- <body onload="horloge()"> -->
<body>
@include('inclusions.header')

<div class="container-fluid" id="invoice">
    @yield('contenu')
</div>



	<!-- @ include('inclusions.footer') -->


  <!-- popper pour dropdown et doit être placer avant les bootstraps.js-->


  <script type="text/javascript" src="{{  asset('styles/js/popper.min.js')  }}"></script> 
  <!-- <script type="text/javascript" src="{{  asset('styles/js/jquery3.4.1.js')  }}"></script> -->
  <!-- <script type="text/javascript" src="  asset('styles/js/bootstrap5_2_1.min.js') "></script> -->
  <!-- on inclu pas bootstrap.min.js et bootstrap.bundle.min.js à la fois car c'est le même fichier-->


<!-- **********************  **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/TweenMax.min.js')  }}"></script> 
<!-- **********************  **************************************** -->

  
<!-- **********************  **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/bootstrap/bootstrap5_2_1.bundle.min.js')  }}"></script>
<!-- **********************  **************************************** -->

<!-- **********************  **************************************** -->
  <script type="text/javascript" src="{{  asset('styles/js/tabledit.min.js')  }}"></script>
<!-- **********************  **************************************** -->

</body>
</html>