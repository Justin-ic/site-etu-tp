
<header  class="">

    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: blue; font-weight: bolder;">
          <img src="{{ asset('images/logoUna.png') }}" title="Logo UNA" style="width: 50px;" >
          <!-- alt si l'image ne s'affiche pas
               title si on survole l'image -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
              <a class="nav-link" href="{{route('accueil')}}">Accueil</a>
          </li>

          <?php  if (!isset($_SESSION)) {session_start();} ?>
          <?php if(isset($_SESSION['Admin'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="{{route('config.index')}}">Configuration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('config.index')}}">Evaluation</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="{{route('accueil')}}">Notes</a>
          </li>
          <?php endif ?>

          <li class="nav-item">
              <a class="nav-link" href="{{route('monProf')}}">Profil</a>
          </li>
          
      </ul>
     <!--  <span class="navbar-text">
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </span> -->
<?php  if (!isset($_SESSION)) {session_start();} ?>
  <?php if(isset($_SESSION['Admin'])): ?>
      <a href="{{route('admin')}}" title="Je me déconnecte">
        <span class="d-flex justify-content-start profil_header fas fa-power-off btnDeconnect">
          <span class=" textBtnDeconnect"> 
            <b><?=$_SESSION['Admin']->Nom?> <?=$_SESSION['Admin']->Prenom[0]?></b>
          </span>
        </span>
      </a>
  <?php endif ?>


  <?php if (isset($_SESSION['Etudiant'])): ?>
      <a href="{{route('connexion')}}" title="Je me déconnecte">
        <span class="d-flex justify-content-start profil_header  fas fa-power-off btnDeconnect">
          <span class=" textBtnDeconnect"> 
          <b><?=$_SESSION['Etudiant']->Nom?> <?=$_SESSION['Etudiant']->Prenom[0]?></b>
          </span>
        </span>
      </a>
  <?php endif ?>
</div>

</div>
</nav>


<!-- <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar w/ text</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
      <span class="navbar-text">
        Navbar text with an inline element
      </span>
    </div>
  </div>
</nav> -->
</header>

<!-- 
<nav class="navbar navbar-light bg-light fixed-top">
  <div class="">
    <a class="navbar-brand" href="#">Offcanvas dark navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-red" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
 -->