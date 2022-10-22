<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // pour utiliser les requêtes personnalisées
use Illuminate\Support\Facades\Http; // pour utiliser les requêtes personnalisées API Laravel http::get()

use App\Models\AnneeUniv;

class AnneeUnivsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Liste_annee = AnneeUniv::orderBy('etat', 'ASC')->Paginate(5);
        // $Liste_annee = AnneeUniv::latest()->Paginate(5);
        return view('configAnnee',compact('Liste_annee')); 
    }



    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
             request()->validate([
            // 'LibelleAnnee' => ['required','stringmax:9'], oublien
                'LibelleAnnee' => 'required|string|max:9',
                'etat' => 'required'
            ]);


        // dd($request->etat);

        $existe = AnneeUniv::where('LibelleAnnee','=',$request->LibelleAnnee)->first();
        if ($existe != NULL) {
            if ($request->id != $existe->id) {
                $ExistAnee = ["ExistAnee" =>"Ce libelle existe déjà !"];
                return response()->json($ExistAnee);
            }
        } 

                if ($request->etat == "2") { /*etat 1 est inactive et 2=Active Voir dans le code ajaxs*/
                    $etat = "Active";
                        $changEtat = AnneeUniv::where('etat','=',"Active")->first();
                       // dd($changEtat->LibelleAnnee);
                        if ($changEtat != NULL){   
                           $changEtat->update([
                            'etat' => "Inactive"
                        ]);
                       }
                }else{
                    $etat = "Inactive";
                }

/*                $annee = AnneeUniv::find($request->id);
                dd($request->id);
                $annee->update([
                    'LibelleAnnee'    =>  $request->LibelleAnnee,
                    'etat'     => $etat 
                 ]);
*/


                $data = array(
                    'LibelleAnnee'    =>  $request->LibelleAnnee,
                    'etat'     => $etat 
                );
                AnneeUniv::where('id', $request->id)->update($data);


        // return redirect()->route('annee_univs.index')->withErrors(["ExistAnee" =>"Ce libelle existe déjà !"]);
    


} /* Fin if edite*/

            if($request->action == 'delete')
            {
            // dd($request->id);
                
                AnneeUniv::where('id', $request->id)->delete();
            }

            return response()->json($request);
        }/*Fin ajax*/
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formulaires.form_conf_anne'); 
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
            // 'LibelleAnnee' => ['required','stringmax:9'], oublien
            'LibelleAnnee' => 'required|string|max:9',
            'etat' => 'required'
        ]);
        // dd($request->etat);

        $existe = AnneeUniv::where('LibelleAnnee','=',$request->LibelleAnnee)->first();
        if ($existe != NULL) {
            return back()->withErrors(["ExistAnee" =>"Ce libelle existe déjà !"]);
        } else {
        if ($request->etat == "Active"){ /*etat 1 est inactive et 2=Active*/
            $changEtat = AnneeUniv::where('etat','=',"Active")->first();
        // dd($changEtat->LibelleAnnee);

             if ($changEtat != NULL){   
                 $changEtat->update([
                'etat' => "Inactive"
                 ]);
             }
         }
         AnneeUniv::create([
            'LibelleAnnee' => $request->LibelleAnnee,
            'etat' => $request->etat
        ]);
         $message = "Créer avec succsès!";
        return redirect()->route('annee_univs.index')->with('message');
     } /*fin annee n'existe pas*/

} /*fin public function*/

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
         request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'numero' => 'required',
            'nce' => 'required',
            'dateNaissance' => 'required|date'
        ]);
        /*
        'nom' => 'required|not_regex:/^.+$*#/i',
            'prenom' => 'required|not_regex:/^.+$*#/i',
            'genre' => 'required|not_regex:/^.+$*#/i',
            'numero' => 'required|not_regex:/^.+$*#/i',
            'nce' => 'required|not_regex:/^.+$*#/i',
            'dateNaissance' => 'required|date'
            */
// <!-- nom     prenom  genre   numero  nce     dateNaissance -->
// dd($request->prenom);
        $client = etudiant::find($request->id);
        $client->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'numero' => $request->numero,
            'nce' => $request->nce,
            'dateNaissance' => $request->dateNaissance
        ]);
        $message = "Modifier avec succsès!";
        return redirect()->route('clients.index')->with('message');
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
