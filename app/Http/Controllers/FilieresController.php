<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Filiere;

class FilieresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Liste_filiere = Filiere::latest()->Paginate(5);
        return view('configFiliere',compact('Liste_filiere'));
    }









    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                 request()->validate([
                // 'LibelleFiliere' => ['required','stringmax:9'], oublien
                    'LibelleFiliere' => 'required|string'
                ]);


                // dd($request->etat);

                $existe = Filiere::where('LibelleFiliere','=',$request->LibelleFiliere)->first();
                if ($existe != NULL) {
                    if ($request->id != $existe->id) {
                        $ExistFiliere = ["ExistFiliere" =>"Cette filière existe déjà !"];
                        return response()->json($ExistFiliere);
                    }
                } 

                $data = array(
                    'LibelleFiliere'    =>  $request->LibelleFiliere
                );
                Filiere::where('id', $request->id)->update($data);    

            } /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                Filiere::where('id', $request->id)->delete();
            }

            return response()->json($request);
        }/*Fin ajax*/
    }/*public function*/

















    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('formulaires.testTable'); 
        return view('formulaires.form_conf_filiere'); 
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
            // 'LibelleFiliere' => ['required','string|max:9'], oublien
            'LibelleFiliere' => 'required|string'
        ]);

        $existe = Filiere::where('LibelleFiliere','=',$request->LibelleFiliere)->first();
        if ($existe != NULL) {
            return back()->withErrors(["ExistFiliere" =>"Cette filière existe déjà !"]);
        } else {
         Filiere::create([
            'LibelleFiliere' => $request->LibelleFiliere
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('filieres.index')->with('message');
        } /*fin annee n'existe pas*/

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
