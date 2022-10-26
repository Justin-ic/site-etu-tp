<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Etudiant;
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
            'nce' => ['required','string','max:30','unique:etudiants'], 
            'dateNaissance' => ['required','date'], 
            'email' => ['required','email','unique:etudiants'], 
            'password' => ['required'], 
            'passConfirme' => ['required','same:password']
        ]);
        // ,'password:mixed'


            Etudiant::create([
                'Nom' => $request->nom,
                'Prenom' => $request->prenom,
                'NCE' => $request->nce,
                'DateNaissance' => $request->dateNaissance,
                'email' => $request->email,
                'password' => $request->password
            ]);
            $message = "Créer avec succsès!";
                $etudiantConnect = Etudiant::latest('id')->first();
                // dd($etudiantConnect->id);
                session_start();
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
    public function update(Request $request, $id)
    {
        $client = Etudiant::find($request->id);
        $client->update([
            'Nom' => $request->nom,
            'Prenom' => $request->prenom,
            'NCE' => $request->genre,
            'DateNaissance' => $request->numero,
            'email' => $request->nce,
            'password' => $request->nce
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('accueil');
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
                                    ->where('password','=',$request->pass)->get();
                                // dd($etudiantConnect->count());    
        if ($etudiantConnect->count() > 0) {
            session_start();
            $_SESSION['Etudiant'] = $etudiantConnect;

             return redirect()->route('accueil');
        } else {
            return back()->withErrors(["Erreur_Connect" =>"Nom d'utilisateur ou mot de passe incorect !"]);
        }
        
    }
}
