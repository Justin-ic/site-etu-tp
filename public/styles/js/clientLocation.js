   
// Rechargement de la page après chaque 7s
/*
setTimeout(function () {
    initialize();
        location.href="AdminVewClientLocation";  
    }, 60000);*/








// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Affiche les marquers xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
var DonneesBD = new Array();
 // setInterval(function () {   ,X} // ecécute la fonction chaque X Millie sécondes. La première exécution est automatique après le chargement de la page

// setTimeout ecécute la fonction après chaque X Millie sécondes. c'est lui qu'on utilise car on a déja dépasser la balise body pour utiliser onloade= "NomFonction()"

/*setInterval(function () {   

    AfficheMarqueurs();
    // location.href="AdminVewClientLocation";  
}, 30000);*/






// !!!!!!!!!!!!!!!!!!!!!!  Actualisation de la page REDIRECTION IMPECABLE !!!!!!!!!!!!!!!!!

function redirection(){
    setInterval(direction,90000); // Chaque 8secondes

// location.href="http://localhost/una_scolarite/public/clientBienvenue";
}

function direction(){
    // location.href="AdminVewClientLocation";
    AfficheMarqueurs();
}
// !!!!!!!!!!!!!!!!!!!!!!  Actualisation de la page REDIRECTION IMPECABLE !!!!!!!!!!!!!!!!!



// !!!!!!!!!!!!!!!!!!!    AFFICHAGE DES MARQUEURS   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function setMarkers(map,locations){
    // alert('Je suis dans marker');
    console.log('Je suis dans marker');
    console.log(locations);
    console.log(DonneesBD);
    for(var i=0; i<locations.length; i++){
        var client = locations[i];
        console.log(client[1]);
        var myLatLng = new google.maps.LatLng(client[8],client[9]);
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker ({
            position: myLatLng,
            map: map,
            icon: "images/marker.png",
            animation: google.maps.Animation.DROP
        });

// ::::::::::::::: POUR LE MARQUEUR CENTRAL ::::::::::::::::::::::::::
 var myLatLng = new google.maps.LatLng(5.387056402459017,-4.016037567213115);
        var infoWindow = new google.maps.InfoWindow();
        var centrale = new google.maps.Marker ({
            position: myLatLng,
            map: map,
            icon: "images/marqueur_Central.png",
            animation: google.maps.Animation.DROP
            });
// ::::::::::::::: POUR LE MARQUEUR CENTRAL ::::::::::::::::::::::::::

        
        (function(i){
            google.maps.event.addListener(centrale, "click", function(){
                var info = locations[i];
                infoWindow.close();
                infoWindow.setContent("Centrale");
                infoWindow.open(map, this);
            });
        }) (i);

        (function(i){
            google.maps.event.addListener(marker, "click", function(){ 
                var info = locations[i];
                let distance = parseInt(info[10]).toFixed(1);
                infoWindow.close();
                infoWindow.setContent("<div>"+info[5]+" "+info[6]+"<br>Ticket: "+info[2]+"<br>Distance= "+distance+"m </div>");
                infoWindow.open(map, this);
            });
        }) (i);
    }
}
// !!!!!!!!!!!!!!!!!!!    AFFICHAGE DES MARQUEURS   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!





// !!!!!!!!!!!!!!!!!!!    INITIALISATION DE LA MAPE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function loadMap(){
    // alert('Je suis bien appelé!');
    var mapOptions={
    zoom: 19, // 0 à 21
    center: new google.maps.LatLng(5.387056402459017,-4.016037567213115), // centre de la carte
    mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP, SATELLITE, HYBRID, TERRAIN
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    setMarkers(map,DonneesBD);
}
// !!!!!!!!!!!!!!!!!!!    INITIALISATION DE LA MAPE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!




// !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function AfficherTableau(Donnees){
 // <!-- clientId clientNumero clientTicket nbClientAvant tAttenteEstime nom prenom genre clientLatitude clientLongitude -->
// alert('Je suis la');
console.log('Je commence');
console.log(Donnees);
var TrTd ='';
    for (var i = 0; i < Donnees.length; i++) {
        console.log(Donnees[i]);
        infoLigne = Donnees[i];

TrTd +='      <tr  class="MCenter"  id="tr">';
TrTd +='                <td>' +(i+1)+ '</td>';
TrTd +='                <td>' +infoLigne[0]+ '</td>';
TrTd +='                <td>' +infoLigne[1]+ '</td>';
TrTd +='                <td>' +infoLigne[2]+ '</td>';
TrTd +='                <td>' +infoLigne[5]+ '</td>';
TrTd +='                <td>' +infoLigne[6]+ '</td>';
TrTd +='                <td>' +infoLigne[7]+ '</td>';
TrTd +='                <td>' +infoLigne[8]+ '</td>';
TrTd +='                <td>' +infoLigne[9]+ '</td>';
TrTd +='                <td>' +infoLigne[10]+ '</td>';
TrTd +='       </tr>';
TrTd +='';
TrTd +='';

    } // Fin For
    console.log(TrTd);
document.getElementById('Tbody').innerHTML = TrTd;
}
// !!!!!!!!!!!!!!!!!!!    REMPLISSAGE DU TABLEAU   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!




// !!!!!!!!!!!!!!!!!!!    SUPPRIME UN ELEMENT DE TBODY   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

/*  On va suprimer l'element dans les lignes d'appel*/

function removeElementTbody(element) {
  if (typeof(element) == "string") {
     element = document.getElementById(element);
  console.log(element);
  element.parentNode.removeChild(element);
/*  elementxx = document.getElementById('leBody');
  console.log(elementxx);*/
  }

}
// !!!!!!!!!!!!!!!!!!!    SUPPRIME UN ELEMENT DE TBODY   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

 


// !!!!!!!!!!!!!!!!!!!    AVANT DE REMPLIR LE TABLEAU IL FAUT LE VIDER   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function viderTableau(){
    tableau = document.getElementById('MonTableau');
     // alert('Vider ');
     console.log(tableau);
     tr = tableau.getElementsByTagName("tr");
    console.log(tr);
    for (var i = 0; i < tr.length; i++) {
        removeElementTbody('tr');
        // alert('Elément '+i+ ' est parti');
    }
    
/*    tableau = document.getElementById('Tbody');
    console.log('FIN');
    console.log(tableau);*/
}
// !!!!!!!!!!!!!!!!!!!    AVANT DE REMPLIR LE TABLEAU IL FAUT LE VIDER   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!





// !!!!!!!!!!!!!!!!!!!    LA FONCTION PRINCIPALE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function AfficheMarqueurs(){
        viderTableau(); // On vide le tableau en attendant la réponse de l'API
        if (navigator.geolocation) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
           var i=0;
           DonneesBD = myArr;
           
           // viderTableau();
           AfficherTableau(DonneesBD); // Comme j'ai les données, je peut afficher le tableau
         google.maps.event.addDomListener('window','load',loadMap());
           }
        };

        // url = "route('APIMarqueurs')}}"; /*Pas de {{ }} ici car ce n'est pas un blade*/
        url = "http://localhost/una_scolarite/public/APIMarqueurs";
        url = "https://glacial-everglades-43629.herokuapp.com/APIMarqueurs";
        // alert(url);
        xhttp.open("GET",url , true);
        xhttp.send();

    } else {
        alert('Activer la géolocalisation s\'il vous plait !');
    }
}
// !!!!!!!!!!!!!!!!!!!    LA FONCTION PRINCIPALE   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



// Debugage
console.log('En dehor des fonctions, je n est plus acces à DonneesBD car les données ne sont pas encore chargées');
console.log(DonneesBD);


// !!!!!!!!!!!!!!!!!!!    LANCEMENT DU TRAITEMENT   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//  LE SCRIPTE DOIT ETRE FORCEMENT A LA FIN DU TABLEAU 

AfficheMarqueurs(); //  Je lancer l'exécution
redirection();  // Je fait la relance 

// !!!!!!!!!!!!!!!!!!!    LANCEMENT DU TRAITEMENT   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

