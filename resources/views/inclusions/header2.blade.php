
<header  class="">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="color: blue; font-weight: bolder;">
        <img src="{{ asset('images/logoUNA.png') }}" title="SOTR UNA" style="width: 50px;" >
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{route('clientBienvenue')}}">Accueil étudiant </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('clientAppele')}}">Ecran d'appel </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('clientInfoFile')}}">Infos files </a>
          </li>


<!-- 
          <li class="nav-item">
              <a class="nav-link" href="{{route('guichets.index')}}">Guichets</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('descriptions.index')}}">Descriptions</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('bilan_clients.index')}}">Bilan clients</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="clientBienvenue">clientBienvenue</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="AdminVewClientLocation">AdminVewClientLocation</a> 
          </li>

        -->
      </ul>
      <span class="navbar-text">
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </span>
    </div>
  </div>
</nav>
</header>

