<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Salle;

class SallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Liste_Salle = Salle::latest()->Paginate(5);
      return view('configSalleTps',compact('Liste_Salle'));
    }







    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                 request()->validate([
                // 'LibelleFiliere' => ['required','stringmax:9'], oublien
                    'Libelle_Salle' => 'required|string|max:30'
                ]);


                // dd($request->etat);

                $existe = Salle::where('LibelleSalle','=',$request->Libelle_Salle)->first();
                if ($existe != NULL) {
                    if ($request->id != $existe->id) {
                        $ExistSalle = ["ExistSalle" =>"Cette salle de TP existe déjà !"];
                        return response()->json($ExistSalle);
                    }
                } 

                $data = array(
                    'LibelleSalle'    =>  $request->Libelle_Salle
                );
                Salle::where('id', $request->id)->update($data);    

            } /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                Salle::where('id', $request->id)->delete();
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
            // 'LibelleFiliere' => ['required','string|max:9'], oublien
            'Libelle_Salle' => 'required|string|max:30'
        ]);

        $existe = Salle::where('LibelleSalle','=',$request->Libelle_Salle)->first();
        if ($existe != NULL) {
            return back()->withErrors(["ExistSalle" =>"Cette salle de TP existe déjà !"]);
        } else {
         Salle::create([
            'LibelleSalle' => $request->Libelle_Salle
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('configSalleTps.index')->with('message');
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
