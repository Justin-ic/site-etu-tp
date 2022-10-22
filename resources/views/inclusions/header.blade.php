
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
              <a class="nav-link" href="{{route('config.index')}}">Accueil</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('config.index')}}">Configuration</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{route('accueil')}">Notes</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{route('accueil')}">Profil</a>
          </li>
          
      </ul>
     <!--  <span class="navbar-text">
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </span> -->
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



