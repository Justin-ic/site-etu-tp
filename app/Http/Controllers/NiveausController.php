<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Niveau;
use App\Models\Filiere;


class NiveausController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FiliereExiste = Filiere::first();
        if ($FiliereExiste == NULL) {
            $configNonTerminer = "Ajoutez une filière d'abord s'il vous plait !";
            return view('configurationEnCours',compact('configNonTerminer'));
        }

        $Liste_nivaux = Niveau::with('filiere')->latest()->Paginate(5);
        $Liste_Filiere = Filiere::latest()->get();

/*        foreach ($Liste_nivaux as $liste) {
            dd($liste->LibelleNiveau);
            // dd($liste->filiere->LibelleFiliere);
        }*/
        
        return view('configNiveau',compact('Liste_nivaux','Liste_Filiere'));
    }









    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                 request()->validate([
                    'LibelleNiveau' => ['required','string','max:30'], 
                    'FiliereId' => 'required'
                 ]);


                // dd($request->id);

                $existe = Niveau::where('LibelleNiveau','=',$request->LibelleNiveau)
                                  ->where('Filieres_id','=',$request->FiliereId)->first();
                if ($existe != NULL) {
                    if ($request->id != $existe->id) {
                        $ExistNiveau = ["ExistNiveau" =>"Cette filière existe déjà !"];
                        return response()->json($ExistNiveau);
                    }
                } 

                $data = array(
                    'LibelleNiveau'    =>  $request->LibelleNiveau,
                    'Filieres_id'    =>  $request->FiliereId
                );
                Niveau::where('id', $request->id)->update($data);    

            } /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                Niveau::where('id', $request->id)->delete();
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
        //
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
            'LibelleNiveau' => ['required','string','max:30'], 
            'FiliereId' => 'required'
         ]);


         $existe = Niveau::where('LibelleNiveau','=',$request->LibelleNiveau)
                           ->where('Filieres_id','=',$request->FiliereId)->first();
         if ($existe != NULL) {
            if ($request->id != $existe->id) {
                return back()->withErrors(["ExistNiveau" =>"Cette filière existe déjà !"]);
            }
        }else {
         Niveau::create([
            'LibelleNiveau' => $request->LibelleNiveau,
            'Filieres_id' => $request->FiliereId
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('niveaux.index')->with('message');
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
