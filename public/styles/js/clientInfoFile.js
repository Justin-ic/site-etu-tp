// <script type="text/javascript">
	function horloge()
	{
        var tt = new Date().toLocaleTimeString();// hh:mm:ss
        
        document.getElementById("timer").innerHTML = tt;
        setTimeout(horloge, 1000); // mise à jour du contenu "timer" toutes les secondes
    }



var iii=0;
    function APIclientInfoFile(){
iii++;
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       var myArr = JSON.parse(this.responseText); /* Je transforme la réponse en array()*/
		       var i;
		       var div=''; /* Il faut forcement l'initialiser*/
		       // console.log(myArr[0].nom);

		       for(i = 0; i < myArr.length; i++) {
		       	 
	 div += '<div class=" contourLigneFile MCenter" style="font-size: 30px; font-weight: bold;"> <!-- Début Une ligne de détail d appel -->';
	 // div += '<div class=" contourLigneFile MCenter" style="font-size: 30px; font-weight: bold;">'+ iii +'s<!-- Début Une ligne de détail d appel -->';
	 // div += '	<div class="col-12">';
	 // div += '		<div class="row">';
	 // div += '		<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">'+'</div>';
	 div += '		Guichet '+ myArr[i].nom +': ==>  '+ myArr[i].nbClient ;
	 // div += '		</div>';
	 // div += '	</div>';
	 div += '</div><!-- fin Une ligne de détail d appel -->';
	 div += '';
	 div += '';

	 /*		       	 
	 div += '<div class="row  contourLigneFile">'+ iii +'s<!-- Début Une ligne de détail d appel -->';
	 // div += '	<div class="col-12">';
	 // div += '		<div class="row">';
	 div += '		<div class="col-12 d-flex justify-content-center" style="font-size: 30px; font-weight: bold;">';
	 div += '		Guichet '+ myArr[i].nom +': ==>  '+ myArr[i].nbClient +'</div>';
	 // div += '		</div>';
	 // div += '	</div>';
	 div += '</div><!-- fin Une ligne de détail d appel -->';
	 div += '';
	 div += '';*/

		       }
		       document.getElementById("reponseAPI").innerHTML = div;
		       setTimeout(APIclientInfoFile, 1000); // mise à jour du contenu "timer" toutes les secondes
		   }
		};
		url = "https://glacial-everglades-43629.herokuapp.com/public/APIclientInfoFile";
		url = "http://localhost/una_scolarite/public/APIclientInfoFile";
		xhttp.open("GET", url, true);
		xhttp.send();
	}


// </script> 