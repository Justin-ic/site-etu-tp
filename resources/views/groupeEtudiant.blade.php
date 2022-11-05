@extends('layouts.app')

@section('contenu')

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-9">
<!-- ******************** CONTENU GLOGAL ****************************** -->



<!-- anneActive
LEniveau
LeTP
donnees

echo 'id: '.$anneActive->id.' Année Unive: '.$anneActive->LibelleAnnee.' <br>';
echo 'id: '.$LEniveau->id.' Niveau: '.$LEniveau->LibelleNiveau.' '.$LEniveau->filiere->LibelleFiliere.' <br>';
echo 'id: '.$LeTP->id.' TP: '.$LeTP->LibelleTp.' <br>';
foreach ($donnees as  $LaDonne) {
    foreach ($LaDonne as  $contenu) {
        echo 'id: '.$contenu->etudiant->id.' '.$contenu->etudiant->Nom.' '.$contenu->etudiant->Prenom.' Groupe '.$contenu->groupe->numeroG.'<br>';
    } 

    echo '<br>';
}


 -->
<!-- ****************************** GESTION DES GROUPES *********************************** -->

<div class="row mt-4 d-flex justify-content-center bg-ligth">

 <div class="col-12 col-md-6 d-flex justify-content-start ">
   <div class="row TitreDetailG">
       <div class="col-12"><h2><b><u>Année univ:</u></b> {{$anneActive->LibelleAnnee}} </h2></div> 
       <div class="col-12"><h2><b><u>Niveau:</u></b> {{$LEniveau->LibelleNiveau}} {{$LEniveau->filiere->LibelleFiliere}} </h2></div> 
       <div class="col-12"><h2><b><u>Tp:</u></b> {{$LeTP->LibelleTp}} </h2></div> 
    
   
   </div>
 </div>

<div class="col-8 col-md-3 d-flex justify-items-center  justify-content-center ">
    <a  type="button" class="col-12 col-md-12 d-flex justify-items-center  justify-content-center confid_a_R_detailG  ">
    <button type="button"  class="btn btn-success confid_b_R_detailG" onclick="TelechargerTout()">
       Tout Téléchargé
    </button>
</a>
</div>

<div class="col-8 col-md-3 d-flex justify-items-center  justify-content-center ">
    <a href="{{route('config.index')}}" type="" class="col-12 col-md-12 d-flex justify-items-center  justify-content-center confid_a_R_detailG  ">
    <button href="" class="btn btn-primary confid_b_R_detailG">
        Retour
    </button>
</a>
</div>

</div>

<?php 
/*$i=1;
foreach ($donnees as  $LaDonne) {
print_r( $infoGroupe[$i++]['LibelleSalle']);
    foreach ($LaDonne as  $contenu) {

    }  Fin foreach ($LaDonne as
}  Fin foreach ($donnees as
    dd();*/
 ?>


<?php 
$cpt=0;
$cptAll=0;
$dataDowloan[] = ""; /* Déclaration obligatoire*/
$dataDowloanAll[] = ""; /* Déclaration obligatoire*/



$dataDowloanAll[0] = array(
                                '0' => $LEniveau->LibelleNiveau." ".$LEniveau->filiere->LibelleFiliere." ".$LeTP->LibelleTp
                                );

$dataDowloanAll[1] = array(
                                '0' => "N°",
                                '1' => "Nom",
                                '2' => "Prenon",
                                '3' => "N°CarteEtudiante",
                                '4' => "DatedeNaissance",
                                '5' => "Email"
                                );


 ?>
@forelse ($donnees as  $LaDonne)
<?php $cpt++;  ?>
<div class="card shadow mb-4 TableCard">
    <div class="card-header py-3">
        <div class="row d-flex">
            <div class="col-sm-9 d-flex justify-content-start">
                <h2 class="m-0 font-weight-bold text-primary"> <b>Détails Groupe <?php echo $infoGroupe[$cpt]['numeroG'].' de la salle '.$infoGroupe[$cpt]['LibelleSalle'] ?></b></h2>
            </div>
        </div>
    </div>
    <div class="card-body">

<?php 
$dataDowloan[$cpt][0] = array(
                                '0' => "Détails du Groupe " .$infoGroupe[$cpt]['numeroG']." de la salle ".$infoGroupe[$cpt]['LibelleSalle']
                                );

$dataDowloan[$cpt][1] = array(
                                '0' => "N°",
                                '1' => "Nom",
                                '2' => "Prenon",
                                '3' => "N°CarteEtudiante",
                                '4' => "DatedeNaissance",
                                '5' => "Email"
                                );


 ?>

<div class="table-responsive">
    <h1 class="MCenter"></h1>
    <table class="table table-bordered table-striped tableGroupe" id="editable">
        <thead id="AjoutTitre">
            <tr class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prenon</th>
                <th>N° Carte Etudiante</th>
                <th>Date de Naissance</th>
                <th>Email</th>
                <!-- <th colspan="2">Action</th> -->
            </tr>
        </thead>

        <tbody>
            <?php $i=1;foreach ($LaDonne as  $contenu):    $cptAll++;  ?>

            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td><?=$contenu->etudiant->Nom ?></td>
                <td><?=$contenu->etudiant->Prenom ?></td>
                <td><?=$contenu->etudiant->NCE ?></td>
                <td><?=$contenu->etudiant->DateNaissance ?></td>
                <td><?=$contenu->etudiant->email ?></td>
            </tr> 
<?php 
$dataDowloan[$cpt][$i] = array(
                                '0' => ($i-1),
                                '1' => ($contenu->etudiant->Nom),
                                '2' => ($contenu->etudiant->Prenom),
                                '3' => ($contenu->etudiant->NCE),
                                '4' => ($contenu->etudiant->DateNaissance),
                                '5' => ($contenu->etudiant->email)
                                );




$dataDowloanAll[$cptAll+1] = array(
                                '0' => ($cptAll),
                                '1' => ($contenu->etudiant->Nom),
                                '2' => ($contenu->etudiant->Prenom),
                                '3' => ($contenu->etudiant->NCE),
                                '4' => ($contenu->etudiant->DateNaissance),
                                '5' => ($contenu->etudiant->email)
                                );





 ?>
            <?php endforeach ?>

        </tbody>
        
<!--         <tfoot  class="MCenter">
            <th>N°</th>
            <th>Nom</th>
            <th>Prenon</th>
            <th>N° Carte Etudiante</th>
            <th>Date de Naissance</th>
            <th>Email</th>
        </tfoot> -->
    </table>
</div>

<!-- { {route('config.index')}  } -->
<div class="row d-flex justify-content-end m-0">
    <a  type="button" class="col-6 col-md-3 d-flex justify-items-center  justify-content-end confid_a_Telecharg  m-0 ">
        <script type="text/javascript"> 
            var MaListe = <?=json_encode($dataDowloan[$cpt])?>; // Pour onclick='TelechargerTout(MaListe,NomFichier)

            var NomFichier = '< ?php echo $LEniveau->LibelleNiveau." ".$LEniveau->filiere->LibelleFiliere." ".$LeTP->LibelleTp." G".$infoGroupe[$cpt]["numeroG"]; ?>'; //L1 Math info Langage C G1
                // console.log(NomFichier);
            var Titre = '<?=$dataDowloan[$cpt][0][0]?>';

            /*onclick='Telechargement(MaListe,NomFichier)*/
            /* Ca ne marche pas car quand on clique, il prend la dernière valeur de NomFichier et Titre*/
        </script>
        <button type="button" class="btn btn-primary confid_b_R_Telecharg m-0 fas fa-arrow-alt-circle-down" onclick='Telechargement("<?=$dataDowloan[$cpt][0][0]?>","<?php echo $LEniveau->LibelleNiveau." ".$LEniveau->filiere->LibelleFiliere." ".$LeTP->LibelleTp." G".$infoGroupe[$cpt]["numeroG"]; ?>")'> 
        Téléchargé
     </button>
 </a>
</div>


    </div><!-- fin card shadow -->
</div><!-- fin card-body -->

@empty
<div class="row d-flex justify-content-center">
    <div class="alert alert-danger d-flex justify-content-center align-items-center">
        <h2>Oups ! Pas de données.</h2>
    </div>
</div>
@endforelse


<!-- ******************** CONTENU GLOGAL ****************************** -->
    </div> <!-- fin col-12 col-md-9 -->
</div> <!-- fin row -->


    <!-- (C) JAVASCRIPT -->
    <script>
    function TelechargerTout(){
      // (C1) DUMMY DATA 
    // console.log(donnees);
    var donnees  = '<?=json_encode($dataDowloanAll)?>';
     donnees = JSON.parse(donnees);

     var NomFichier = '<?=$dataDowloanAll[0][0]?>';
     NomFichier = NomFichier.substring(0, 30);
     console.log(NomFichier);
     console.log(donnees);
      // (C2) CREATE NEW EXCEL "FILE"
      var workbook = XLSX.utils.book_new(),
          worksheet = XLSX.utils.aoa_to_sheet(donnees); /* Doit être un tableau de tableau*/
          workbook.SheetNames.push(NomFichier); /*Nom de la feuille*/
          workbook.Sheets[NomFichier] = worksheet;

      // (C3) "FORCE DOWNLOAD" XLSX FILE
      XLSX.writeFile(workbook, NomFichier+".xlsx");
    };

/*!
 * Origine du script: 
 *  xlsx.js (C) 2013-present SheetJS -- http://sheetjs.com 
 * Fichier: xlsx.full.min.js
 * */












/* The live editor requires this function wrapper */
/*
Affiche le tableau telqu'il est visible sur la page. Les parties en display none ne s'affiche pas.
cependant, quand moi je recupère le tableau, je lui ajoute une ligne en haut qui contien son nom avant 
exportation. après je suprime
*/
function Telechargement(Titre,NomFichier) {

    var tHaed = document.getElementById("AjoutTitre");
        document.getElementById("AjoutTitre").innerHTML = "";
    console.log('Titre='+Titre+'  NomFichier='+NomFichier);
    var nouveauTh = '<td  class="MCenter Titre" colspan="6"> '+Titre+' </td>';
     // nouveauTh = '';
            nouveauTh += '<tr class="MCenter">';
                nouveauTh += '<th>N°</th>';
                nouveauTh += '<th>Nom</th>';
                nouveauTh += '<th>Prenon</th>';
                nouveauTh += '<th>N° Carte Etudiante</th>';
                nouveauTh += '<th>Date de Naissance</th>';
                nouveauTh += '<th>Email</th>';
            nouveauTh += '</tr>';

    document.getElementById("AjoutTitre").innerHTML=nouveauTh;
    var table = document.getElementById("editable");
    NomFichier = NomFichier.substring(0, 30); /* Ne doit pas depasser 31 caractères*/

    var wb = XLSX.utils.table_to_book(table);
    /* Export to file (start a download) */
    XLSX.writeFile(wb, NomFichier+".xlsx");

    // document.getElementsByClassName("Titre").innerHTML = "";
}
    </script>

@endsection   
