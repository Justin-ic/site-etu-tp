  var compteur=0;
	var widthCouleur = 0;
	var compterCouleur = 0;
	function horloge()
	{
		var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		compteur++;
		ecouler=toTimeString(compteur);
		document.getElementById("timer").innerHTML = ecouler;
		document.getElementById("Heure").innerHTML = Heure;
		console.log("ddddddddddddddddd");
		// document.getElementById("progress-bar").innerHTML = ecouler;
		/***************** condition pour la partie verte, orange et rouge *****************/

		//  Normalement on fait 30 minute par client
// à 15min, on passe à orange: si compteur< 900s, progresVert: width=  (compteur*50)/900
// en effet, à 15min, on doit parcourir 50% de toute la bar de progression
// à 25min, on passe à Rouge

// 30min         100
// 25            ?   ->x=83.3 ->83; le width Maxi de orange doit être 83.3 - 50 = 33.3 ->33

// Le width Maxi de rouge est 100 -(50+33)=17

// 900         100
// compteur     ?

/*************************   gestion de la bar de progression *********************** */
				// if (compteur<=900) {
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*50)/900;
				// 	document.getElementById('progressVert').style.width = widthCouleur + '%';
				// 	if (compteur==900) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				// }else if (compteur>900 && compteur<=1500) { /* Entre 15 et 25min */
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*25)/600;  /*On fait 10min= 600s */
				// 	document.getElementById('progressOrange').style.width = widthCouleur + '%';
				// 	if (compteur==1500) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				// }else if (compteur>1500 && compteur<=1800){  /* Entre 25 et 30min */
				// 	compterCouleur++;
				// 	widthCouleur =  (compterCouleur*25)/300; /*On fait 5min= 300s */
				// 	document.getElementById('progressRouge').style.width = widthCouleur + '%';
				// 	if (compteur==1800) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/	
				// }
/*************************   gestion de la bar de progression *********************** */


/*************************   Un test de la bar de progression *********************** */

// On supose que le tems maxi est 3min
//  à 1 minute, on passe à orange
// à 2min on passe à rouge

				if (compteur<=90) {
					compterCouleur++;
					widthCouleur =  (compterCouleur*50)/90;
					document.getElementById('progressVert').style.width = widthCouleur + '%';
					if (compteur==90) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				}else if (compteur>90 && compteur<=135) {
					compterCouleur++;
					widthCouleur =  (compterCouleur*25)/45;
					document.getElementById('progressOrange').style.width = widthCouleur + '%';
					if (compteur==135) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/
				}else if (compteur>135 && compteur<=180){
					compterCouleur++;
					widthCouleur =  (compterCouleur*25)/45;
					document.getElementById('progressRouge').style.width = widthCouleur + '%';
					if (compteur==180) {compterCouleur=0; widthCouleur=0;} /*remise à zéro*/	
				}
/*************************   Un test de la bar de progression *********************** */

        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
  }
    function toTimeString(seconds) {
   		 return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
			}



		function AllumerLED(){

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("demo").innerHTML = xhttp.responseText;
		       // alert("Je suis ici");
		     }
		   };
// localhost/una_scolarite/public/EnvoiESP/192.168.43.240/type=1&numeroClient=123&nom=OUATTARA&prenom=JUSTIN&ticketClient=A-3&guichet=A
		   
	   xhttp.open("GET", "http://localhost/una_scolarite/public/EnvoiESP/192.168.43.240/type=1&numeroClient=123&nom=OUATTARA&prenom=JUSTIN&ticketClient=A-3&guichet=A", true);
	   xhttp.send();
			}
			function EteindreLED(){

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       document.getElementById("demo").innerHTML = xhttp.responseText;
		       // alert("Je suis ici");
		     }
		   };
		   xhttp.open("GET", "http://192.168.137.125/switchLedOn", true);
		   xhttp.send();
		 }



		 function debutService(){
		 	var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		 	document.getElementById("debutService").value = Heure;
		 }


		 function finService(){
		 	var Heure = new Date().toLocaleTimeString();// hh:mm:ss
		 	document.getElementById("finService").value = Heure;
		 }
