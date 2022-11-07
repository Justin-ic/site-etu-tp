<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()
use App\Models\Tp;
use App\Models\infoTP;
use App\Models\Niveau;


class TPsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Liste_Tp = Tp::latest()->Paginate(5);
      return view('configTps',compact('Liste_Tp'));
    }







    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                 request()->validate([
                // 'LibelleFiliere' => ['required','stringmax:9'], oublien
                    'LibelleTP' => 'required|string|max:30'
                ]);


                // dd($request->etat);

                $existe = Tp::where('LibelleTp','=',$request->LibelleTP)->first();
                if ($existe != NULL) {
                    if ($request->id != $existe->id) {
                        $ExistTp = ["ExistTp" =>"Ce nom de TP existe déjà !"];
                        return response()->json($ExistTp);
                    }
                } 

                $data = array(
                    'LibelleTp'    =>  $request->LibelleTP
                );
                Tp::where('id', $request->id)->update($data);    

            } /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                Tp::where('id', $request->id)->delete();
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
            'LibelleTP' => 'required|string|max:30'
        ]);

        $existe = Tp::where('LibelleTp','=',$request->LibelleTP)->first();
        if ($existe != NULL) {
            return back()->withErrors(["ExistTp" =>"Ce nom de TP existe déjà !"]);
        } else {
         Tp::create([
            'LibelleTp' => $request->LibelleTP
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('Tps.index')->with('message');
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
    public function update(Request $request)
    {
        request()->validate([
            // 'TpId' => 'required|numeric',
            'LeTexte' => 'required|string'
        ]);

        $infoTP = infoTP::first();
        if ($infoTP == NULL) {
            infoTP::create([
                'texteInfo' => "Les informations sur le TP en cours s'affichent ici !"
            ]);
        }

        $texteOk = str_replace("**", "<br>", $request->LeTexte);
        infoTP::first()->update([
            'texteInfo' => $texteOk
        ]);

        return redirect()->route('Tps.index')->with('status',"Modiffications approtés avec succès !");
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
