<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeUniv;
use App\Models\Inscrit;
use App\Models\Niveau;
use App\Models\Tp;
use App\Models\Groupe;
use App\Models\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }

        if (!isset($_SESSION['Niveaus_id'])) {
            $message = "Votre session est expirer !";
            return view('note_found', compact('message'));
        }

        

        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $ListeEtuInscrit = Inscrit::with('etudiant')
        ->with('niveau' , function($query) {
            $query->with('filiere');
        })
        ->with('Tp')
        ->with('notes')
        ->where('AnneeUnivs_id','=',$anneActive->id)
        ->where('Niveaus_id','=',$_SESSION['Niveaus_id'])
        ->where('TPs_id','=',$_SESSION['TPs_id'])
        ->where('Groupes_id','=',$_SESSION['Groupes_id'])
        ->get();

        $LeNiveau = Niveau::with('filiere')->find($_SESSION['Niveaus_id']);
        $LeTP = Tp::find($_SESSION['TPs_id']);
        $LeGroupe = Groupe::find($_SESSION['Groupes_id']);

        return view('configListeNotes',compact('ListeEtuInscrit','LeNiveau' ,'LeTP' ,'LeGroupe' ));        
    }











    public function action(Request $request)
    {
                 
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                /*Transformation du request en tableau index numérique*/
                $requestTable = array(); 
                $cpt =0;
                foreach ($request->all() as $key => $LaNote) {
                    if (strpos($key, "Note_") !== false) { /*Je crée une nouvelle ligne dans Note*/
                        if ($LaNote != NULL) {
                            if (!is_numeric($LaNote)) {
                                $noteIncorrecte = ["noteIncorrecte" =>"Il y a des notes qui contiennent des caractères ! Actualisez et reprennez s'il vous plaît !"];
                                return response()->json($noteIncorrecte);
                            }else{
                                $requestTable[$cpt++] = intval($LaNote);
                            }
                        }
                        
                    }
                }

                // dd($requestTable);

                $lesNotes = Note::where('Inscrits_id','=',$request->id)->get();
                $cpt =0;
                foreach ($lesNotes as  $note) {

                            $data = array(
                                'Note'    =>  $requestTable[$cpt++]
                            );

                            $note->update($data);
                }
                            // dd($lesNotes);




            } /* Fin if edite*/

            if($request->action == 'delete')
            {
                $lesNotes = Note::where('Inscrits_id','=',$request->id)->get();
                foreach ($lesNotes as  $note) {
                    $note->delete();
                }
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

        // dd($request);
        foreach ($request->all() as $key =>  $LaNote) {
            $LaNote = ($LaNote != NULL) ? $LaNote : 0 ;
            // echo "<br>  X!".$LaNote."!X ";

            if (strpos($key, "Note_") !== false) { /*Je crée une nouvelle ligne dans Note*/
                $idInscrit = str_replace("Note_", "", $key);
                // echo $key."==".$LaNote." idInscrit=".$idInscrit." <br> ";

                Note::create([
                    'Inscrits_id' => intval($idInscrit),
                    'Note' => $LaNote
                ]);
            }
            
        }

        return redirect()->route('config.index')->with("status","Groupe noté avec succsès !");
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
        if ($request->ajax()) {
            Product::find($request->pk)
            ->update([
                $request->name => $request->value
            ]);

            return response()->json(['success' => true]);
        }
    }


    /**
     * Write code for delete
     *
     * @return response()
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success' => 'success']);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function evaluation(Request $request)
    {
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }

        /*Je vérifie si il n'a pas été noté aujourd'hui*/
        /*Il a droit à une seul note par jour*/
        /*ainsi je prend un étudiant du groupe, s'il a eu une note aujourd'hui, j'arrête*/
        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $unEtuDuGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$request->idNiveau)
                    ->where('TPs_id','=',$request->tpId)
                    ->where('Groupes_id','=',$request->id_G)
                    ->first();

        $dd = date("Y-m-d"); 
        $dejaNote = Note::where('Inscrits_id', '=', $unEtuDuGroupe->id)
        ->where('created_at', '>', $dd.' 00:00:00')
        ->first();
        if ($dejaNote != NULL) {
            return redirect()->route('config.index')->with("status","Il semble que ce groupe à déjà été noté aujourd'hui. Rendez-vous dans la liste des notes pour la modification manuelle");
        }

        request()->validate([
            'id_G' => ['required','numeric'], 
            'idNiveau' => 'required|numeric',
            'tpId' => 'required|numeric'
        ]);


            
            $ListeEtuInscrit = Inscrit::with('etudiant')
                     ->with('niveau' , function($query) {
                            $query->with('filiere');
                        })
                    ->with('Tp')
                    ->with('notes')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$request->idNiveau)
                    ->where('TPs_id','=',$request->tpId)
                    ->where('Groupes_id','=',$request->id_G)
                    ->get();

        $LeNiveau = Niveau::with('filiere')->find($request->idNiveau);
        $LeTP = Tp::find($request->tpId);
        $LeGroupe = Groupe::find($request->id_G);

        return view('evaluerGroupe',compact('ListeEtuInscrit','LeNiveau' ,'LeTP' ,'LeGroupe' ));   
    }








    /**
     * Crée des sessions et redirectionne ver l'index
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function afficheNotes(Request $request)
    {
        request()->validate([
            'idNiveau_Notes' => ['required','numeric'], 
            'tpId_Notes' => 'required|numeric',
            'id_G_Notes' => 'required|numeric'
        ]);
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }

        /*Je vérifie si ce groupe a eu une note au moins cette année*/
        /*Si le groupe n'a pas de note, je me retourne */
        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $unEtuDuGroupe = Inscrit::where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$request->idNiveau_Notes)
                    ->where('TPs_id','=',$request->tpId_Notes)
                    ->where('Groupes_id','=',$request->id_G_Notes)
                    ->first();

        $dd = date("Y-m-d"); 
        $dejaNote = Note::where('Inscrits_id', '=', $unEtuDuGroupe->id)->first();
        if ($dejaNote == NULL) {
            return redirect()->route('config.index')->with("status","Désolé, ce groupe n'a pas encore été noté cette année !");
        }

        $_SESSION['Niveaus_id'] = $request->idNiveau_Notes;
        $_SESSION['TPs_id'] = $request->tpId_Notes;
        $_SESSION['Groupes_id'] = $request->id_G_Notes;

        return redirect()->route('configEval.index');

    }









}



