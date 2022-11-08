<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeUniv;
use App\Models\admin;
use App\Models\Inscrit;
use App\Models\Etudiant;
use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Niveau;
use App\Models\Tp;
use App\Models\Filiere;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }

/*$configNonTerminer = "Configuration mal faite: Il esxiste des étudiants inscrits qui n'ont pas de groupe !";
return view('configurationEnCours',compact('configNonTerminer'));*/

$etatConfig = admin::where('etatConfig', '=',1)->first();
if ($etatConfig == NULL) {
    
        $anneActive = AnneeUniv::first();
        $FiliereExiste = Filiere::first();
        $niveauExiste = Niveau::first();
        $tpExiste = Tp::first();
        $salleExiste = Salle::first();
        $groupeExiste = Groupe::first();
/*
$configNonTerminer = "Configuration mal faite: Il esxiste des étudiants inscrits qui n'ont pas de groupe !";
            return view('configurationEnCours',compact('configNonTerminer'));
*/
// dd($anneActive);

if ($anneActive == NULL) {
    $configNonTerminer = "Etape 1: Déffinissez une année universitaire s'il vous plait !";
} else if($FiliereExiste == NULL){
    $configNonTerminer = "Etape 2: Configurez les filières s'il vous plait !";
} else if($niveauExiste == NULL){
    $configNonTerminer = "Etape 3: Configurez les niveaux s'il vous plait !";
} else if($tpExiste == NULL){
    $configNonTerminer = "Etape 4: Configurez les TPs s'il vous plait !";
} else if($salleExiste == NULL){
    $configNonTerminer = "Etape 5: Configurez les salles de TPs s'il vous plait !";
} else if($groupeExiste == NULL){
    $configNonTerminer = "Etape 6: Configurez les groupes pour terminer s'il vous plait ! <br>Vous pourez le faire une fois que vous aurez des étudiants inscrits.";
} 


        if ($FiliereExiste == NULL || $niveauExiste == NULL || $tpExiste == NULL || $salleExiste == NULL || $groupeExiste == NULL || $anneActive == NULL ) {
            return view('configurationEnCours',compact('configNonTerminer'));
        }



        /*Je confirme que la configuration est terminée*/
        $adminOK = admin::first();
        $adminOK->update([
        'etatConfig' => 1
           ]);
} /*Fin vérification etat config*/





         /* niveaux.Filieres_id: niveaux est le nom de la table et non la relation
           $Liste_niveau = Niveau::with('filiere')->orderBy(Filiere::select('LibelleFiliere')->whereColumn('id','=','niveaux.Filieres_id'),'ASC')->get();
         */

        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $Liste_niveau = Niveau::with('filiere')->orderBy('LibelleNiveau','ASC')->get();
        $Liste_TP = Tp::All();

        $donnees = array(); $Ligne = array(); $cpt=0;
        foreach ($Liste_niveau as  $niveau) {
            $Ligne['Niveau']=array(
                'id' => $niveau->id, 
                'LibelleNiveau' => $niveau->LibelleNiveau.' '.$niveau->filiere->LibelleFiliere);
            foreach ($Liste_TP as $LeTP) {
                $NbEtuInscrit = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$niveau->id)
                    ->where('TPs_id','=',$LeTP->id)->get()->count();


                $NbGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$niveau->id)
                    ->where('TPs_id','=',$LeTP->id)->distinct()
                    ->where('Groupes_id','!=',NULL)
                    ->get(['Groupes_id'])->count();
/*foreach ($NbGroupe as  $value) {
    echo "NbGroupeId =".$value.' ';
}
echo "xxxxxx";*/
                $idG1 = Groupe::where('numeroG','=',1)->first();
                $NbParGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$niveau->id)
                    ->where('TPs_id','=',$LeTP->id)->where('Groupes_id','=',$idG1->id)->get()->count();



                $Ligne['TP']= array('id' =>$LeTP->id, 'libelleTP'=>$LeTP->LibelleTp);
                $Ligne['nbEtudiant']= $NbEtuInscrit;
                $Ligne['NbGroupe']= $NbGroupe;
                $Ligne['NbParGroupe']= $NbParGroupe;


            $donnees[$cpt++] = $Ligne;

            }/*Fin foreach ($Liste_TP */
        }/*foreach ($Liste_niveau */

// dd('OK');



/*

1) Je recupère tous les niveaux
2) Pour chaque niveau fixé, je parcours tous les TP. quand je recupère un niveau et un TP, je compte le nombre étudiants qui y sont inscrit.
3) je profite pour recuperer le nombre de groupe et le nombre par groupe en cherchant parmis ces étudiants, combien sont ceux qui sont dans le groupe 1 ? car dans la repartition on commence par le groupe 1.

Je retourne un tableau de tableau


dans les données retournés, je dois garder le id de chaque niveau et TP pour le bouton détail. Ce bouton retourne la liste de tous les étudiants qui y sont inscrit regroupé par groupe


pour le bouton détail:
quand je prens le id Nineau et le id TP, je cherche dans la table inscrit tous les étudiants avec des groupes distincte. Ce qui me permet d'avoir le id de chaque groupe concerné.

Je parcours la liste des inscrit où le id Niveau et id TP figure, pour chaque groupe, je recupère l'étudiant.

*/

        return view('configuration', compact('donnees','anneActive'));
        
}/*public function index()*/




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AdminExist = admin::latest('id')->first();
        if ($AdminExist !== NULL) {
            return back()->withErrors(["Erreur_Connect" =>"Il esxiste déjà un Admin. Connectez-vous !"]);
        }
        return view('formulaires.form_admin'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       request()->validate([
        'nom' => ['required','string','max:100'], 
        'prenom' => ['required','string','max:100'],
        'email' => ['required','email','unique:admins'],
        'passe' => ['required'],
        'confirme_pass' => ['required','same:passe']
       ]);

        admin::create([
            'Nom' => $request->nom,
            'Prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->passe
        ]);


        $message = "Créer avec succsès!";
        $AdminConnect = admin::latest('id')->first();
           
        if (!isset($_SESSION)) { session_start(); }
            $_SESSION['Admin'] = $AdminConnect;

        return redirect()->route('config.index');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!isset($_SESSION)) { session_start(); }
       
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!isset($_SESSION)) { session_start(); }
        
        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }


         request()->validate([
        'idAdmin' => ['required'],
        'nom' => ['required','string','max:100'], 
        'prenom' => ['required','string','max:100'],
        'email' => ['required','email'],
        'passe' => ['required'],
        'confirme_pass' => ['required','same:passe']
       ]);

         $admin = admin::find($request->idAdmin);

        $admin->update([
            'Nom' => $request->nom,
            'Prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->passe
        ]);

        $adminOK = admin::find($request->idAdmin);
        $_SESSION['Admin'] = $adminOK;
        return redirect()->route('config.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session_start();
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginAdmin(Request $request)
    {
         request()->validate([
            'email' => ['required','email'], 
            'password' => ['required']
        ]);


     $AdminTest = admin::first();
     if ($AdminTest == NULL) {
         return back()->withErrors(["Erreur_Connect" =>"Il n'y a pas d'administrateur d'abord. Enregistrez vous s'il vous plaît !"]);
     }


     $AdminConnect = admin::where('email','=',$request->email)
                                    ->where('password','=',$request->password)->first();
        // $test = admin::first();
        // dd($AdminConnect);

        if ($AdminConnect != NULL) {
 
         if (!isset($_SESSION)) { session_start(); } 
         $_SESSION['Admin'] = $AdminConnect;
         return redirect()->route('config.index');
        } else {
            return back()->withErrors(["Erreur_Connect" =>"Nom d'utilisateur ou mot de passe incorect !"]);
        }
        

    }





    /**
     *  Repartition des étudiants dans des groupes. Dans ce formulaire, on recoit NiveauId TpId 
     *  nbGroupe est le nombre par groupe choisit par l'Admin
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configGroupes(Request $request)
    {
        /* Repartition des étudiants dans des groupes */
        request()->validate([
            'nbGroupe' => ['required','numeric'],
            'NiveauId' => ['required'],
            'TpId' => ['required']
        ]);


/* inscrits.Etudiants_id: inscrits est le nom de la table et non la relation*/
$anneActive = AnneeUniv::where('etat','=','Active')->first();
$LiesteEtuInscrit = Inscrit::with('etudiant')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$request->NiveauId)
                    ->where('TPs_id','=',$request->TpId)
                    ->orderBy(Etudiant::select('Nom')->whereColumn('id','=','inscrits.Etudiants_id'),'ASC')
                    ->get();


if ($LiesteEtuInscrit->count() == 0) {
    return redirect()->route('configGroupe.index')->with('status',"Désolé! Il n'y a pas d'étudiant !");
}


/* Je crée les groupe si ce n'est pas encore le cas*/
$reste = ($LiesteEtuInscrit->count()%$request->nbGroupe);
$nombreGroupe= intval($LiesteEtuInscrit->count()/$request->nbGroupe);
if ($reste!=0) {
    $nombreGroupe= $nombreGroupe +1;
}
for ($i=1; $i <=$nombreGroupe ; $i++) { 
    $GExist = Groupe::where('numeroG','=',$i)->first();
    if ($GExist == NULL ) {
        // echo "Groupe non créer je le crée <br> <br>";
        Groupe::create(['numeroG' => $i, 'Salles_id' => NULL]);
    }else{/*echo "Je passe  <br> <br>";*/}
}



/* Repartition*/
$cptPG = 0;
$nbGr = 1; /*Compteur de groupe*/
$GExist = Groupe::where('numeroG','=',1)->first(); /*Les premiers sont dans groupe 1*/
foreach ($LiesteEtuInscrit as  $inscrit) {
    $cptPG++;
    if (($cptPG-1) == $request->nbGroupe) {
        $cptPG=1;
        $nbGr++;
        $GExist = Groupe::where('numeroG','=',$nbGr)->first();
    }

    $inscrit->update([
        'Groupes_id' => $GExist->id
    ]);
        // echo "OK OK Groupe:".$nbGr."<br><br>";
}


// dd($nombreGroupe);


        $message = "La magie s'est opérée avec succsès!";
        if (!isset($_SESSION)) { session_start(); }
        $_SESSION['ConfigGOK'] = $message;
        return redirect()->route('configGroupe.index');

    }







    /**
     *  Un filtre appelé par javaScrypte. Il affiche un mini bilan de la configuration des groupe
     *
     * @param  int  $idNiveau, int $idTP
     * @return \Illuminate\Http\Response
     */
    public function configFiltreG($idNiveau,$idTP)
    {
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }
        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $Le_niveau = Niveau::with('filiere')->find($idNiveau);
        $Le_TP = Tp::find($idTP);
        $LiesteEtuInscrit = Inscrit::with('etudiant')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)->get();

       $LiesteGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)->distinct()->get(['Groupes_id']);

       $idG1 = Groupe::where('numeroG','=',1)->first();
       $NbParGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)->where('Groupes_id','=',$idG1->id)->get();

     

        // return 'nbEtu, nbGroupe, nb par groupe';
     $anneeUniv = $anneActive->LibelleAnnee;
     $niveau = $Le_niveau->LibelleNiveau." ".$Le_niveau->filiere->LibelleFiliere;
     $tp = $Le_TP->LibelleTp;
     $nbEtudiant = $LiesteEtuInscrit->count();
     $nbGroupe = $LiesteGroupe->count();
     $nbParGroupe = $NbParGroupe->count();

     // dd($LiesteEtuInscrit->count());
     // dd($niveau->filiere->LibelleFiliere);
     // dd($Le_niveau->LibelleNiveau);
     // echo   'anneeUniv='.$anneeUniv.'; niveau='.$niveau.'; tp='.$tp.'; nbEtudiant='.$nbEtudiant. '; nbGroupe='.$nbGroupe.'; nbParGroupe='.$nbParGroupe; 
     // dd($LiesteGroupe->count());

     $reponseFiltre = array('anneeUniv' => $anneeUniv, 
                            'niveau' => $niveau, 
                            'tp' => $tp, 
                            'nbEtudiant' => $nbEtudiant, 
                            'nbGroupe' => $nbGroupe, 
                            'nbParGroupe' => $nbParGroupe
                        );


            return response()->json($reponseFiltre);
    }





    
    /**
     * Affiche la liste des étudiants par groupe en fonction du Niveau et du TP. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configAfficheDetailG($idNiveau, $idTP)
    {
/*
pour le bouton détail:
quand je prens le id Nineau et le id TP, je cherche dans la table inscrit tous les étudiants avec des groupes distincte. Ce qui me permet d'avoir le id de chaque groupe concerné.

Je parcours la liste des inscrit où le id Niveau et id TP figure, pour chaque groupe, je recupère l'étudiant.

*/



        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $inscritSanGroupe = Inscrit::where('Groupes_id','=',NULL)
                                    ->where('Niveaus_id','=',$idNiveau)
                                    ->where('TPs_id','=',$idTP)
                                    ->where('AnneeUnivs_id','=',$anneActive->id)->first();
            if ($inscritSanGroupe != NULL) {
            $configNonTerminer = "Configuration mal faite: 
            Il esxiste des étudiants inscrits dans ce TP qui n'ont pas de groupe !";
            return view('configurationEnCours',compact('configNonTerminer'));
        }




        $LEniveau = Niveau::with('filiere')->find($idNiveau);
        $LeTP = Tp::find($idTP);

        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $ListeInscrit = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)->distinct()->get(['Groupes_id']);

        $donnees = array(); $i = 0;
        foreach ($ListeInscrit as $inscrit) {
            $ListeEtudiant = Inscrit::with('etudiant')
                     ->with('niveau' , function($query) {
                            $query->with('filiere');
                        })
                    ->with('Tp')
                    ->with('groupe' , function($query) {
                            $query->with('salle');
                        })
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)
                    ->where('Groupes_id','=',$inscrit->Groupes_id)->get();
            $donnees[$i++] = $ListeEtudiant;
         }/* fin foreach ($ListeInscrit as */  


/*echo 'id: '.$anneActive->id.' Année Unive: '.$anneActive->LibelleAnnee.' <br>';
echo 'id: '.$LEniveau->id.' Niveau: '.$LEniveau->LibelleNiveau.' '.$LEniveau->filiere->LibelleFiliere.' <br>';
echo 'id: '.$LeTP->id.' TP: '.$LeTP->LibelleTp.' <br>';*/
$infoGroupe = array(); $i=0;
foreach ($donnees as  $LaDonne) {
    $i++;
    foreach ($LaDonne as  $contenu) {
        // echo 'id: '.$contenu->etudiant->id.' '.$contenu->etudiant->Nom.' '.$contenu->etudiant->Prenom.' Groupe '.$contenu->groupe->numeroG.'<br>';
        dd($contenu->groupe);
        $infoGroupe[$i] = array('id' =>$contenu->groupe->id, 
                                  'numeroG' =>$contenu->groupe->numeroG,
                                  'LibelleSalle' =>$contenu->groupe->salle->LibelleSalle
                                    );
    } 
    // echo '<br>';
}
        // dd($infoGroupe);


        return view('groupeEtudiant',compact('anneActive','LEniveau', 'LeTP', 'infoGroupe', 'donnees', ));
    }













    /**
     * Gestion des profils
     *
     * @return \Illuminate\Http\Response
     */
    public function profil()
    {

        if (!isset($_SESSION)) { session_start(); }

        if (isset($_SESSION['Admin'])) {
            return view('formulaires.form_admin_profil'); 
        }else if(isset($_SESSION['Etudiant'])){
            $Liste_nivaux = Niveau::with('filiere')->get();
            $Liste_TP = Tp::All();

            $anneActive = AnneeUniv::where('etat','=','Active')->first();
            $ListeEtuInscrit = Inscrit::with('etudiant')
                     ->with('niveau' , function($query) {
                            $query->with('filiere');
                        })
                    ->with('Tp')
                    ->with('notes')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Etudiants_id','=',$_SESSION['Etudiant']->id)
                    ->get();
            return view('formulaires.form_etu_profil',compact('Liste_nivaux', 'Liste_TP','ListeEtuInscrit')); 
        }else{
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
    }


/*

pour la même année et pour un niveau donné, si elle a des note, elle ne peut plus changer de niveau ni de TP

sur la page profil, il a un seul champ TP  et on lui dit deja inscrit en ...

si le tp choisit ne fait pas parti de ceux dont il deja inscrit, je l'ajoute si non erreur: deja inscrit

si tu as au moins une note dans l'année en cours, tu ne peut plus changer de niveau
si tu as au moins une note dans l'année en cours dans le TP donnée, tu ne peut plus changer ce TP
*/





}
