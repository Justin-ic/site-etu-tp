<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\AnneeUniv;
use App\Models\Niveau;
use App\Models\Tp;
use App\Models\Inscrit;

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
            $Etudiant = $_SESSION['Etudiant'][0];
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
        session_start();
        $_SESSION['inscritOk']="Inscrit avec succsès !";
        return redirect()->route('accueil');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
