@extends(' layouts.app')

@section('contenu')

<?php if (!isset($_SESSION)) { session_start(); } ?>

<div id="carouselExampleSlidesOnly" class="carousel slide div_carousel " data-bs-ride="carousel" >	
<div class="row  col-12 d-flex justify-content-center align-items-end text_accueil">



  @if (session('status')) 
  <div id="ul_alert_error" class=" col-12 col-md-8 d-flex justify-content-center align-items-end">
    <div class="MCenter h1_alert bg-info">
     {{session('status')}}
     <script type="text/javascript">setTimeout(function() {
     document.getElementById('ul_alert_error').innerHTML = "";},7000);</script>
    </div>
  </div>
  @endif


  <?php if (isset($_SESSION['Admin'])): ?>  
    <div class=" col-12 d-flex justify-content-center align-items-end">
       <a href="" class="btn btn-primary d-grid gap-2 col-12 col-md-8 a_text_accueil">
         <h1 class="MCenter h1_accueil">Bienvenue Admin!</h1>
       </a>
      <!-- <button  id="download" class="btn btn-primary"> PDF</button> -->
    </div>
  <?php else: ?>
    <div class=" col-12 d-flex justify-content-center align-items-end">
       <a href="{{route('inscrits.create')}}" class="btn btn-primary d-grid gap-2 col-12 col-md-8 a_text_accueil">
         <h1 class="MCenter h1_accueil">Je m'inscris!</h1>
       </a>
      <!-- <button  id="download" class="btn btn-primary"> PDF</button> -->
    </div>
  <?php endif ?>

</div>
 
  <div class="carousel-inner div_accuil" >
    <div class="carousel-item active ">
      <img src="{{ asset('images/carrosels/tp_una.jpg')}}" class="d-block w-100 img_carousel" alt="...">
    </div>

    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/tp_una2.jpg')}}" class="d-block w-100 img_carousel" alt="...">
    </div>

    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/tp_una3.jpg')}}" class="d-block w-100 img_carousel" alt="...">
    </div>

    <div class="carousel-item">
      <img src="{{ asset('images/carrosels/tp_una4.jpg')}}" class="d-block w-100 img_carousel" alt="...">
    </div>
  </div>
</div>

<div class="sectionAccueil">
    <section class="features-icons  text-center ">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-4 a1 a_accueil  sectionChild">
                      <a href="#info_tp" class="a_white" type="button">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-0 mb-lg-3"> 
                          <!-- mb-0 = margin buttom -->
                            <h3 class="fs-2 fw-bold">Information sur TP</h3>
                            <p class="lead mb-0 fs-3">Actualité sur le TP en cours</p>
                        </div>
                      </a>
                    </div>

                    <div class="col-lg-4 a2 a_accueil sectionChild" >
                    <a href="#mes_notes" class="a_white" type="button">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-0 mb-lg-3">
                            <h3 class="fs-2 fw-bold">Mes notes</h3>
                            <p class="lead mb-0 fs-3">Voir mes notes et mon assiduité</p>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-4 a3 a_accueil sectionChild">
                      <a href="{{route('monProf')}}" class="a_white" type="button">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div>
                            <h3 class="fs-2 fw-bold">Mon profil </h3>
                            <p class="lead mb-0 fs-3">Modifier mon prfil</p>
                        </div>
                      </a>
                    </div>

                </div>
            </div>
        </section>
     </div>
        

<!-- ************************** Détailles1 ***************************** -->

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-12">
      <div class="card shadow mb-4 TableCard">
        <div class="card-header py-3">
         <div class="row">
          <div class="col-12 col-md-7"><h1 class="m-0 font-weight-bold text-primary " id="info_tp">Information sur TP</h1></div>
         <?php if (isset($_SESSION['Admin'])): ?>  

          <div class="col-sm-3 d-flex justify-content-end ms-auto p-2 ">
            <!-- Button trigger modal -->
            <a href="{{route('Tps.index')}}">
              <button type="button" class="btn btn-primary">
                <i class="fas fa-plus "></i>
                Modiffier 
              </button>
            </a>
          </div>
        <?php endif ?>

         </div>
        </div>
        <div class="card-body">

          @if ($infoTP != NULL) 
          {!! $infoTP->texteInfo !!}
          
          @endif

        </div><!-- fin card-body -->
      </div><!-- fin card shadow -->

    </div> <!-- fin col-12 col-md-9 -->
  </div> <!-- fin row -->

<!-- ************************** Détailles1 ***************************** -->




  <?php if (isset($_SESSION['ListeNotesEtu'])): ?>  



<!-- ************************** Détailles2 ***************************** -->

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 ">
      <div class="card shadow mb-4 TableCard">
        <div class="card-header py-3">
          <h1 id="mes_notes" class="m-0 font-weight-bold text-primary MCenter">Mes notes</h1>
        </div>
        <div class="card-body">


          <div class="row d-flex justify-content-center ">
            <div class="col-12 col-md-6 ">
              <h3 class="MCenter">{{$_SESSION['Etudiant']->Nom}} {{$_SESSION['Etudiant']->Prenom}}</h3>
            </div>
          </div>

  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-8">
      <div class="table-responsive">
        <table class="table table-bordered table-striped tableNote">
          <thead>
            <tr class="MCenter">
              <th>N°</th>
              <th>Note</th>
              <th>Date</th>
            </tr>
          </thead>
        <!--         <pre>
        <?php 
        // print_r($liste);

        ?></pre> -->
        <tbody>
          <?php /*$i=1; if ($liste->count() > 0):  if (isset($_GET['page'])) { $i=$_GET['page']*5 - 4;}*/ ?>
          <?php $i=1; foreach ($_SESSION['ListeNotesEtu'] as $note): ?>
            <tr  class="MCenter">
              <td><?=$i++?></td>
              <td>{{$note->Note}}</td>
              <td>{{$note->created_at->format('d/m/Y')}}</td>
              </tr> 
            <?php endforeach ?> 
          <?php /*endif*/ ?>
        </tbody>

        <tfoot  class="MCenter">
          <th>N°</th>
          <th>Note</th>
          <th>Date</th>
        </tfoot>
    </table>
  </div><!-- fin div table-responsive -->
              

 </div> <!-- fin col-8 -->
</div><!-- fin row -->

<br>
<!-- <div>
  <p class="fs-3"><b>Assiduité:</b> Vous avez manqué 2 séances de TP. Ce qui vous totalise 5 heurs d'absence.
    <a href="#mes_notes" type="button" class="btn btn-primary">Détails !</a>
  </p>
</div> -->



        </div><!-- fin card-body -->
      </div><!-- fin card shadow -->

    </div> <!-- fin col-12 col-md-9 -->
  </div> <!-- fin row -->



<!-- ************************** Détailles2 ***************************** -->
  
  <?php endif ?>

















@endsection
<!-- 
borderTest

position horizontale
<div class="d-flex justify-content-start">...</div>
<div class="d-flex justify-content-end">...</div>
<div class="d-flex justify-content-center">...</div>
<div class="d-flex justify-content-between">...</div>
<div class="d-flex justify-content-around">...</div>


position verticale
<div class="d-flex align-items-start">...</div>
<div class="d-flex align-items-end">...</div>
<div class="d-flex align-items-center">...</div>
<div class="d-flex align-items-baseline">...</div>
<div class="d-flex align-items-stretch">...</div>


 -->
<!-- 
<script type="text/javascript" >
  window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
}
</script>  -->