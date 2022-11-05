<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Etudiant;
use App\Models\AnneeUniv;
use App\Models\Inscrit;
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

        $nceExiste = Etudiant::where('nce','=',$request->nce)
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

             return redirect()->route('accueil');
        } else {
            return back()->withErrors(["Erreur_Connect" =>"Nom d'utilisateur ou mot de passe incorect !"]);
        }
        
    }



}
