<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\AnneeUniv;
use App\Models\Niveau;
use App\Models\Tp;
use App\Models\Inscrit;
use App\Models\Note;

class InscritsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        if (isset($_SESSION['Etudiant'])) {
            $Etudiant = $_SESSION['Etudiant'];
            $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
            $Liste_nivaux = Niveau::with('filiere')->orderBy('LibelleNiveau')->get(); /*L2 PC*/
            $Liste_Tp = Tp::All();
            // dd($Anne_Univ->LibelleAnnee);

            return view('formulaires.form_etu_inscript',compact('Etudiant','Anne_Univ','Liste_nivaux','Liste_Tp')); 
        } else {
            // return back()->withErrors(["Erreur_Connect" =>"Vous devez vous connecter d'abord !"]);
            return view('connexion')->withErrors(["Erreur_Connect" =>"Vous devez vous connecter d'abord !"]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     * 
     * La méthode exécuté quand je clique sur je m'inscrit de l'acceuil
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'Id_Etu' => ['required','numeric'], 
            'Id_Annee' => ['required','numeric'], 
            'niveau_id' => ['required','numeric'], 
            'tp_id' => ['required','numeric']
        ]);


        $inscrit = Inscrit::where('Etudiants_id','=',$request->Id_Etu)
                            ->where('AnneeUnivs_id','=',$request->Id_Annee)
                            ->where('Niveaus_id','!=',$request->niveau_id)
                            ->first();

        
        if ($inscrit != NULL) {
            return back()->withErrors(["Erreur_Ins" =>"Impossible de s'nscrire dans deux niveaux différents pour la même année !"]);
        }

        $inscrit = Inscrit::where('Etudiants_id','=',$request->Id_Etu)
                            ->where('AnneeUnivs_id','=',$request->Id_Annee)
                            ->where('Niveaus_id','=',$request->niveau_id)
                            ->where('TPs_id','=',$request->tp_id)->first();
        
        if ($inscrit != NULL) {
            return back()->withErrors(["Erreur_Inscrit" =>"Vous vous êtes déjà inscrit dans ce TP !"]);
        } 
        
        Inscrit::create([
                'Etudiants_id' => $request->Id_Etu,
                'AnneeUnivs_id' => $request->Id_Annee,
                'Niveaus_id' => $request->niveau_id,
                'TPs_id' => $request->tp_id
        ]);
        if (!isset($_SESSION)) { session_start(); }
        $_SESSION['inscritOk']="Inscrit avec succsès !";
        return redirect()->route('accueil')->with('status','Inscrit avec succsès !');
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
        //
    }

    /**
     * Je cherche son niveau
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
            'idEtu' => ['required','numeric'], 
            'niveauId' => ['required','numeric']
        ]);

        $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
        $ListEtu = Inscrit::where('Etudiants_id','=',$_SESSION['Etudiant']->id)
                            ->where('AnneeUnivs_id','=',$Anne_Univ->id)->get();

        $bolNote = false;
        foreach ($ListEtu as $ligneInscrit) {
            $exite = Note::where('Inscrits_id','=',$ligneInscrit->id)->first();
            if ($exite != NULL) {
                $bolNote = true;
                break;
            }
        }

        if ($bolNote == true) {
            return back()->withErrors(["Erreur_Inscrit" =>"Impossible de quiter car vous avez déja des notes dans un TP."]); 
        } else {
            foreach ($ListEtu as $ligneInscrit) {
                $ligneInscrit->update([
                    'Niveaus_id' => $request->niveauId
                ]);
            }
        }
        return redirect()->route('accueil')->with('status','Niveau modifier avec succès !');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTp(Request $request)
    {
        if (!isset($_SESSION)) { session_start(); }
        if (!isset($_SESSION['Etudiant'])) {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }

        request()->validate([
            'idEtu' => ['required','numeric'], 
            'tpID' => ['required','numeric']
        ]);

        $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
        $ligneInscrit = Inscrit::where('Etudiants_id','=',$_SESSION['Etudiant']->id)
                            ->where('TPs_id','=',$request->tpID)
                            ->where('AnneeUnivs_id','=',$Anne_Univ->id)->first();

        /*Dans tous les lines inscrit où son id apparait, il a le même niveau*/
        $NiveauEtu = Inscrit::where('Etudiants_id','=',$_SESSION['Etudiant']->id)
                            ->where('AnneeUnivs_id','=',$Anne_Univ->id)->first();

        

        if ($NiveauEtu == NULL) {
            return back()->withErrors(["Erreur_Inscrit" =>"Désolé vous n'ête pas encore inscrit !"]); 
        }        

        if ($ligneInscrit != NULL) {
            return back()->withErrors(["Erreur_Inscrit" =>"Vous vous êtes déjà inscrit dans ce TP !"]); 
        }else{
            Inscrit::create([
                'Etudiants_id' => $_SESSION['Etudiant']->id,
                'AnneeUnivs_id' => $Anne_Univ->id,
                'Niveaus_id' => $NiveauEtu->Niveaus_id,
                'TPs_id' => $request->tpID
            ]);
        }

        return redirect()->route('accueil')->with('status','TP ajouter avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }







    /**
     * Sortir du TP si on n'a pas encore de note
     *
     * @return \Illuminate\Http\Response
     */
    public function sortiTP($idTP)
    {

        if (!isset($_SESSION)) { session_start(); }
        if (!isset($_SESSION['Etudiant'])) {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }

        $Anne_Univ = AnneeUniv::where('etat','=','Active')->first();
        $LeInscrit = Inscrit::where('Etudiants_id','=',$_SESSION['Etudiant']->id)
                              ->where('TPs_id','=',$idTP)
                              ->where('AnneeUnivs_id','=',$Anne_Univ->id)->first();


        /* J'ai l'id de l'inscrit. Je regarde s'il apparête dans la table Note*/
        $Note = Note::where('Inscrits_id','=',$LeInscrit->id)->first();
        if ($Note == NULL) {
            $LeInscrit->delete();
        } else {
            return back()->withErrors(["Erreur_Inscrit" =>"Impossible de quiter car vous avez déja des note dans ce TP.!"]); 
        }
        

        return redirect()->route('accueil')->with('status','TP supprimer avec succsès !');
    }


}
