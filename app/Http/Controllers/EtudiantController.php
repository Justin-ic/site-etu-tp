<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Etudiant;
use App\Models\AnneeUniv;
use App\Models\Inscrit;
use App\Models\infoTP;
use App\Models\Note;
use PDF;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
/*
            $data = [

            'title' => 'Welcome to ItSolutionStuff.com',

            'date' => date('m/d/Y'),

        ]; 

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');*/

     

        return view('formulaires.form_etu_enregistre');
        
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
            'nom' => ['required','string','max:30'], 
            'prenom' => ['required','string','max:30'], 
            'NCE' => ['required','string','max:30','unique:etudiants'],  
            /*NCE doit être le nom de la colonne de la table car in va faire un select avant*/
            'dateNaissance' => ['required','date'], 
            'email' => ['required','email','unique:etudiants'], 
            'password' => ['required'], 
            'passConfirme' => ['required','same:password']
        ]);
        // ,'password:mixed'


            Etudiant::create([
                'Nom' => $request->nom,
                'Prenom' => $request->prenom,
                'NCE' => $request->NCE,
                'DateNaissance' => $request->dateNaissance,
                'email' => $request->email,
                'password' => $request->password
            ]);
            $message = "Créer avec succsès!";
                $etudiantConnect = Etudiant::latest('id')->first();
                // dd($etudiantConnect->id);
                if (!isset($_SESSION)) { session_start(); }
                $_SESSION['Etudiant'] = $etudiantConnect;


            $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
            $idInscrit = Inscrit::where('Etudiants_id','=',$etudiantConnect->id)
            ->where('AnneeUnivs_id','=',$Anne_Univ->id)->first();
            if ($idInscrit != NULL) {

                $ListeNotesEtu = Note::where('Inscrits_id','=',$idInscrit->id)->get();
                if ($ListeNotesEtu->count() > 0) {
                    $_SESSION['ListeNotesEtu'] = $ListeNotesEtu;
                }
            }

            return redirect()->route('accueil')->with('message');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('formulaires.form_etu_modif');
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
        if (!isset($_SESSION['Etudiant'])) {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
        
        request()->validate([
            'idEtu' => ['required'], 
            'nom' => ['required','string','max:30'], 
            'prenom' => ['required','string','max:30'], 
            'nce' => ['required','string','max:30'], 
            'dateNaissance' => ['required','date'], 
            'email' => ['required','email'], 
            'password' => ['required'], 
            'passConfirme' => ['required','same:password']
        ]);

        $nceExiste = Etudiant::where('NCE','=',$request->nce)
                               ->where('id','!=',$request->idEtu)
                               ->first();

        $emailExiste = Etudiant::where('email','=',$request->email)
                               ->where('id','!=',$request->idEtu)
                               ->first();
        if ($nceExiste != NULL) {
            return back()->withErrors(["Erreur_nceExiste" =>"Ce Numéro de carte étudiante esxiste déjà !"]);  
        }
        if ($emailExiste != NULL) {
            return back()->withErrors(["Erreur_emailExiste" =>"Ce email esxiste déjà !"]);
        }

            $etudiant = Etudiant::find($request->idEtu);
            $etudiant->update([
                'Nom' => $request->nom,
                'Prenom' => $request->prenom,
                'NCE' => $request->nce,
                'DateNaissance' => $request->dateNaissance,
                'email' => $request->email,
                'password' => $request->password
            ]);

        return redirect()->route('accueil')->with('status','Données modiffiers avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Etudiant::find($id)->delete();
        return redirect()->route('accueil')->with('message');
    }

    








    /**
     * Accueil
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accueil()
    {
        if (!isset($_SESSION)) { session_start(); }

        if (isset($_SESSION['Admin']) || isset($_SESSION['Etudiant'])) {
            $infoTP = infoTP::first();
            if ($infoTP == NULL) {
                infoTP::create([
                    'texteInfo' => "Les informations sur le TP en cours s'affichent ici !"
                ]);
            $infoTP = infoTP::first();
            }

            // dd($infoTP->texteInfo);
            return view('accueil',compact('infoTP'));  
        }else{
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
    public function loginEtu(Request $request)
    {
        request()->validate([
            'email' => ['required','email'], 
            'pass' => ['required']
        ]);
        $etudiantConnect = Etudiant::where('email','=',$request->email)
                                    ->where('password','=',$request->pass)->first();
                                // dd($etudiantConnect->count());    
        if ($etudiantConnect != NULL) {
            if (!isset($_SESSION)) { session_start(); }
            $_SESSION['Etudiant'] = $etudiantConnect;

            $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
            $idInscrit = Inscrit::where('Etudiants_id','=',$etudiantConnect->id)
            ->where('AnneeUnivs_id','=',$Anne_Univ->id)->first();

            if ($idInscrit != NULL) {
                $ListeNotesEtu = Note::where('Inscrits_id','=',$idInscrit->id)->get();
                if ($ListeNotesEtu->count() > 0) {
                    $_SESSION['ListeNotesEtu'] = $ListeNotesEtu;
                }
            }
            

             return redirect()->route('accueil');
        } else {
            return back()->withErrors(["Erreur_Connect" =>"Nom d'utilisateur ou mot de passe incorect !"]);
        }
        
    }



}



/*


Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat. 
******
Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat.  
****

Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat. 
**
Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat.  
**

Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat. 
******
Jusque là, on a une seul table dans la BD; on va ajouter une deuxième et établir une relation entre elles. À la table clients, ajoutons la table entreprises. On dira qu’une entreprise peut avoir plusieurs clients et qu’un client peut appartenir à une et une entreprise. Donc on met la clef id) de entreprises dans clients comme clef secondaire. Voila le résultat.  
**


*/