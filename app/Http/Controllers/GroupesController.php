<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Niveau;
use App\Models\Tp;
use App\Models\Inscrit;
use App\Models\AnneeUniv;

class GroupesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testAnne = AnneeUniv::first();
        $testGroupe = Groupe::first();
        $testSalle = Salle::first();
        $testNiveau = Niveau::first();
        $testTp = Tp::first();
        $testlatest = latest::first();
        if ($testAnne == NULL || $testGroupe == NULL || $testSalle == NULL || $testNiveau == NULL || $testTp == NULL || $testlatest == NULL || ) {
            return back()->withErrors(["ExistGroupe" =>"Désolé vous devez suivre les étapes indiquées !"]);
        }

        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $Liste_groupe = Groupe::with('salle')->orderBy('numeroG','ASC')->Paginate(5);
        $Liste_Salle = Salle::latest()->get();
        $Liste_Niveau = Niveau::with('filiere')->get();
        $Liste_TP = Tp::latest()->get();

        $Liste_InscritSansGroupe = Inscrit::with('etudiant')
                     ->with('niveau' , function($query) {
                            $query->with('filiere');
                        })
                    ->with('Tp')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Groupes_id','=', NULL)->get();

/*        foreach ($Liste_nivaux as $liste) {
            dd($liste->LibelleGroupe);
            // dd($liste->filiere->LibelleFiliere);
        }*/
        
        return view('configGroupes',compact('Liste_groupe','Liste_Salle','Liste_Niveau','Liste_TP','Liste_InscritSansGroupe'));
    }







    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                 request()->validate([
                    // 'LibelleGroupe' => ['required','string','max:30'], 
                    'SalleId' => 'required'
                 ]);


                // dd($request->id);

                // $existe = Groupe::where('LibelleG','=',$request->LibelleGroupe)->first();
                                  // ->where('Salles_id','=',$request->SalleId)->first();
/*                if ($existe != NULL) {
                    if ($request->id != $existe->id) {
                        $ExistGroupe = ["ExistGroupe" =>"Ce groupe est déjà dans une salle !"];
                        return response()->json($ExistGroupe);
                    }
                } */

                $data = array(
                    // 'LibelleG'    =>  $request->LibelleGroupe,
                    'Salles_id'    =>  $request->SalleId
                );
                Groupe::where('id', $request->id)->update($data);    

            } /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                Groupe::where('id', $request->id)->delete();
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
            'LibelleGroupe' => ['required','string','max:30'], 
            'SalleId' => 'required'
         ]);


         $existe = Groupe::where('LibelleG','=',$request->LibelleGroupe)->first();
                           // ->where('Salles_id','=',$request->SalleId)->first();
         if ($existe != NULL) {
            if ($request->id != $existe->id) {
                return back()->withErrors(["ExistGroupe" =>"Ce groupe est déjà dans une salle !"]);
            }
        }else {
         Groupe::create([
            'LibelleG' => $request->LibelleGroupe,
            'Salles_id' => $request->SalleId
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('configGroupe.index')->with('message');
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
