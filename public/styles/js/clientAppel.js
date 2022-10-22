/*Access-Control-Allow-Origin: http://localhost/una_scolarite/public/APIclientAppel
Access-Control-Allow-Credentials: true
Access-Control-Expose-Headers: FooBar
Content-Type: text/html; charset=utf-8*/
var actualiser = 0;
	function horloge()
	{
		actualiser++;
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        	// window.location.href = "http://stackoverflow.com";
        	// On actualise la page toutes les 20 secondes 
		       // if (actualiser == 20) {window.location.replace("https://glacial-everglades-43629.herokuapp.com/clientAppele");}
		       // if (actualiser == 20) {window.location.replace("http://localhost/una_scolarite/public/clientAppele");}

        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
    }






var iii=0;

/* On va dans la base de données, on prend tout ceux dont Appel=1 et on remplace par Appel=ok*/
function APIclientAppel(){
iii++;
       document.getElementById('tours').value = iii;

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		// alert(this.responseText);
       // Typical action to be performed when the document is ready:
       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
       var i;

       console.log(myArr[0]);
       console.log(myArr[1]);


// alert(nouvelleClass);
       for(i = 0; i < myArr[0].length; i++) {
       var div=''; /* Il faut forcement l'initialiser*/  
       leId = creerId();   	 
	 // div += '  <div class="row  contourLigneAppel">';
	 div += '	<div class="col-6">';
	 div += '		<div class="row">';
	 div += '			<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">'+ myArr[0][i].ticket +' '+leId+'</div>';
	 // div += '			<div class="col-12"><img src="https://glacial-everglades-43629.herokuapp.com/images/fleche.png" style="width:100%; height: 30px;"></div>';
	 div += '			<div class="col-12"><img src="http://localhost/una_scolarite/public/images/fleche.png" style="width:100%; height: 30px;"></div>';
	 div += '		</div>';
	 div += '	</div>';
	 div += '	<div class="col-6">';
	 div += '		<div class="row">';
	 div += '			<div class="col-12  d-flex justify-content-center" style="font-size:20px">Guichet</div>';
	 div += '			<div class="col-12  d-flex justify-content-center" style="font-weight: bold; font-size: 30px;">'+ myArr[0][i].guichet +'</div>';
	 div += '		</div>';
	 div += '	</div>';
	 // div += '</div>';
	 div += '';
	 div += '';



creerDiv(leId); /* Je l'appelle en précisant le id*/
document.getElementById(leId).innerHTML = div;
addTimeLine(leId);



/* On envoi les données au ESP*/
ddd = Envoi_Au_ESP_SMS_Appel(myArr[0][i].idBilan, myArr[0][i].ticket, myArr[0][i].guichet, myArr[0][i].numero, myArr[0][i].nom, myArr[0][i].prenom);


// console.log(document.getElementById(leId));
	

	} /* fin for appel*/






       for(i = 0; i < myArr[1].length; i++) {

if (myArr[1][i].tAttenteEstime == "00:00:00") {tAttenteEstime ="0"}else{tAttenteEstime =myArr[1][i].tAttenteEstime }
       
       	// On imprime le ticket
       	// Envoi_A_IMPRIMANTE(nom, prenom, ticketClientEnCours, guichet, nbClientAvant, tAttenteEstime);
       	Envoi_A_IMPRIMANTE(myArr[1][i].nom, myArr[1][i].prenom, myArr[1][i].ticket, myArr[1][i].guichet, myArr[1][i].nbClientAvant, tAttenteEstime);


       	/* On envoi les données au ESP*/
       	ppp = Envoi_Au_ESP_SMS_Ticket(myArr[1][i].idBilan, myArr[1][i].ticket, myArr[1][i].guichet, myArr[1][i].numero, myArr[1][i].nom, myArr[1][i].prenom, myArr[1][i].nbClientAvant, tAttenteEstime);


       } /* fin for ticket*/









/*		DEBUGAGE
  test = document.getElementById("reponseAPIv");
  if (test == null) {alert('vide; pas trouve')}else{alert('On trouve quelque chose')}
  console.log(test);

*/
		       // document.getElementById("reponseAPI").innerHTML = div;
		       // addTimeLine();


		       // setTimeout(APIclientAppel, 1000); // mise à jour du contenu "timer" toutes les secondes
		       // window.location.href = "http://stackoverflow.com";
        	// On actualise la page toutes les 20 secondes 
		       // if (actualiser == 20) {window.location.replace("https://glacial-everglades-43629.herokuapp.com/clientAppele");}
		       // window.location.replace("http://localhost/una_scolarite/public/clientAppele");
		   }
		};
		// xhttp.open("GET", "route('APIclientAppel')}}", true); Utilisable dans un .blade
		url = "http://localhost/una_scolarite/public/api/APIclientAppelDonneLigne"; /* API LACALE*/
		url = "https://glacial-everglades-43629.herokuapp.com/api/APIclientAppel";
		// url = "http://localhost/una_scolarite/public/api/APIclientAppel";
		xhttp.open("GET", url, true);
		xhttp.send();

}/* FIN APIclientAppel*/



/*  On va suprimer l'element dans les lignes d'appel*/
function removeElement(element) {
  if (typeof(element) === "string") {
    element = document.getElementById(element);
  }
  return function() {
    element.parentNode.removeChild(element);
  };
}






/* retarde l'exécution du programme mais avec ca selement, on attend que la boucle finisse avant de lancer l'annimation*/
function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
}




/* POUR CONVERTIR DES SECONDES EN TIME*/
function toTimeString(seconds) {
	 return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
	}




/* POUR CREER UN NOUVEAU ID EN FONCTION DS LIGNES DEJA AFFICHE*/
function creerId(){
	for (var i = 0; i < 100; i++) {
		var nouveauID = 'ligne'+(i+1);
		 resultat = document.getElementById(nouveauID);
		if (resultat == null) {return nouveauID;}
	}
  }


/* CREATION D'UNE div QUI LE ID RECEMENT CREER  */
function creerDiv(leId) {
	let bloc = document.getElementById("reponseAPI");
    div = document.createElement('div');
    div.classList.add("row");
    div.classList.add("contourLigneAppel");
    div.id = leId;
	bloc.append(div);
}


/* AJOUTER A LA Time Line */
function addTimeLine(id){
	const TL = new TimelineMax({paused: false}); 
	/* paused: false active l'animation dèsle chargement*/
	const ligneAppel = document.getElementById(id);
	// console.log(ligneAppel);

	TL
	.from(ligneAppel,3,{opacity:0, x: -100})
	.to(ligneAppel,60, {opacity:1} )
	.call(removeElement(id))

}
/*		PRINCIPE
Je veux que à chaque fois que un guichet clique sur son bouton SUIVANT, je modifie le fichier 
nomGuichet.txt en mettant ceci à l'intérieur:
		appel=false 
		C-2
Quant à l'API, elle ira lire chaque fichier. Si on trouve false à l'intérieur, on récupere le ticket qui est à la ligne suivante et on l'ajoute à un tableau. En suite, on remplace false par true dans le dit fichier.

A la fin, ce tableau sera retourné.

BON QUAND ON RECOIT LE TABLEAU, ON FAIT QUOI AVEC ????

Pour chaque ligne du tableau reçu, on doit créer une div, lui associer un id unique (qui n'est pas encore dans une des lignes d'appel). En suite, on doit l'ajouter à un time Line de une minute

*/


// unitile! comme l'ip ne change pas, on le charge avec la page depuis le controleur
/******************** Recuperer ID ESP8266***********************/

/*    function IPEsp8266(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; // Je recupère la réponse en string
		       console.log('ID du ESP est:'+laReponse);
		        //alert('ID du ESP est:'+laReponse)
		       document.getElementById("IDEsp").value = laReponse;
		   }
		};

		// En production
		// url = "https://glacial-everglades-43629.herokuapp.com/API_IPESP8266";
		url = "http://localhost/una_scolarite/public/API_IPESP8266";
		// alert(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}

	*/
/******************** Recuperer ID ESP8266***********************/





/******************** TRANSFERT DES DONNEES VERS LE ESP8266***********************/

    function Envoi_Au_ESP_SMS_Appel(idBilan, ticketClientEnCours, guichet, numeroClientProchain, nom, prenom){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);
		       document.getElementById("reponseEsp").innerHTML = laReponse;
		   }
		};
		
		IPDuEsp8266 = document.getElementById("IPEsp").value;

		// url = "https://"+IPDuEsp8266+"/?numeroClient="+numeroClient+"&nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClient+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime;

		// Ces informations sont utilisée pour lui envoyer un message disant: Ticket Mr OUATTARA Justin, vous êtes attendu au guichet A-4
		// ticketClient nom  prenom guichet numeroClient
		// url = "http://"+IPDuEsp8266+"/?type=1&numeroClient=123&nom=OUATTARA&prenom=JUSTIN&ticketClient=A-3&guichet=A";
    url = "http://localhost/una_scolarite/public/EnvoiESPAppel/"+IPDuEsp8266+"/type=1&idBilan="+idBilan+"&numeroClient="+numeroClientProchain+"&nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClientEnCours+"&guichet="+guichet;
		 // Ici, j'envoie deux arguments le IPESP et les arguments pour aller former l'URL
		 // alert(url);

// c'est votre tour OUATTARA Gninlnafanlan Justin au tickrt: A-45. Merci d'aller au guichet A
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}


  /******************** TRANSFERT DES DONNEES VERS LE ESP8266**********************
 * <body onload="horloge(), APIclientAppel(), Envoi_Au_ESP_SMS_AppelTest('A-6','A',1233)">
*/





// unitile! comme l'ip ne change pas, on le charge avec la page depuis le controleur
// xxxxxxxxxxxxxxxxxxxxxxxxxxxxx POSITIONNEMENT CLIENT xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Non utilisé   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    function NouveauClient(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:		       

						var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
						       var i;

						       // console.log(myArr[0].nom);


						// alert(nouvelleClass);
						       for(i = 0; i < myArr.length; i++) {


						/* On envoi les données au ESP*/
						Envoi_Au_ESP_SMS_Ticket(myArr[i].idBilan, myArr[i].ticket, myArr[i].guichet, myArr[i].numero, myArr[i].nom, myArr[i].prenom, myArr[i].nbClientAvant, myArr[i].tAttenteEstime);


								       }
		       setTimeout(NouveauClient, 1000); // mise à jour du contenu "timer" toutes les secondes

		   }
		};

		// En production
		// url = "https://glacial-everglades-43629.herokuapp.com/API_NouveauClient";
		url = "http://localhost/una_scolarite/public/API_NouveauClient";
		// alert(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}

	// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx




/******************** TRANSFERT DES DONNEES VERS LE ESP8266***********************/

    function Envoi_Au_ESP_SMS_Ticket(idBilan, ticketClientEnCours, guichet, numeroClientProchain, nom, prenom, nbClientAvant, tAttenteEstime){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);
		       document.getElementById("reponseEsp").innerHTML = laReponse;
//nom prenom ticketClientEnCours guichet nbClientAvant tAttenteEstime
		   }
		};
		
		IPDuEsp8266 = document.getElementById("IPEsp").value;

		// url = "https://"+IPDuEsp8266+"/?numeroClient="+numeroClient+"&nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClient+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime;

		// Ces informations sont utilisée pour lui envoyer un message disant: Ticket Mr OUATTARA Justin, vous êtes attendu au guichet A-4
		// ticketClient nom  prenom guichet numeroClient
		// url = "http://"+IPDuEsp8266+"/?type=1&numeroClient=123&nom=OUATTARA&prenom=JUSTIN&ticketClient=A-3&guichet=A";
    url = "http://localhost/una_scolarite/public/EnvoiESPTicket/"+IPDuEsp8266+"/type=0&idBilan="+idBilan+"&numeroClient="+numeroClientProchain+"&nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClientEnCours+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime;
		 // alert(url);

// c'est votre tour OUATTARA Gninlnafanlan Justin au tickrt: A-45. Merci d'aller au guichet A   numeroClient nom prenom ticketClient guichet nbClientAvant tAttenteEstime
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}



  // /******************** TRANSFERT DES DONNEES VERS LE ESP8266**********************






/******************** TRANSFERT DES DONNEES VERS L IMPRIMANTE***********************/

// Ce code peut rester ici car il sera exécuté par le terminal sur lequel est connecté l'imprimate
    function Envoi_A_IMPRIMANTE(nom, prenom, ticketClientEnCours, guichet, nbClientAvant, tAttenteEstime){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var laReponse = this.responseText; /* Je recupère la réponse en string*/
		       console.log(laReponse);

		       // document.getElementById("reponseEsp").innerHTML = laReponse;
		   }
		};
		
/*		nom = document.getElementById("nom").value;
		prenom = document.getElementById("prenom").value;
		ticketClient = document.getElementById("ticketClient").value;
		guichet = document.getElementById("guichet").value;
		nbClientAvant = document.getElementById("nbClientAvant").value;
		tAttenteEstime = document.getElementById("tAttenteEstime").value;
		date = document.getElementById("date").value;*/
 // numeroClient nom prenom ticketClient guichet nbClientAvant tAttenteEstime

var Heure = new Date().toLocaleTimeString();// hh:mm:ss
date = document.getElementById("dateImpression").value;
LaDateImpression = date+" "+Heure;
// alert(LaDateImpression);
url = "http://localhost/una_scolarite/public/escpos_printer/example/interface/windows-usb.php/?nom="+nom+"&prenom="+prenom+"&ticketClient="+ticketClientEnCours+"&guichet="+guichet+"&nbClientAvant="+nbClientAvant+"&tAttenteEstime="+tAttenteEstime+"&date="+date;

		  // alert(url);
		 console.log(url);
		xhttp.open("GET", url, true);
		xhttp.send();
	}
  
 // ******************* TRANSFERT DES DONNEES VERS L IMPRIMANTE********************* 

// http://localhost/una_scolarite/public/escpos_printer/example/interface/windows-usb.php/?nom=OUATTARA&prenom=Gninlnafanlan Justin&ticketClient=A-36&guichet=A&nbClientAvant=35&tAttenteEstime=1635273000
