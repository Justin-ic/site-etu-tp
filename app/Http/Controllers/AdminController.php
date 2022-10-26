<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeUniv;
use App\Models\admin;
use App\Models\Inscrit;
use App\Models\Etudiant;
use App\Models\Groupe;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Liste_annee = AnneeUniv::latest()->Paginate(5);
        // return view('configuration',compact('Liste_annee')); 
        session_start();
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AdminExist = admin::latest('id')->first();
        if ($AdminExist !== NULL) {
            return back()->withErrors(["Erreur_Connect" =>"Il esxiste déjà un Admin. Connectez-vous !"]);
        }
        return view('formulaires.form_admin'); 
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
        'nom' => ['required','string','max:100'], 
        'prenom' => ['required','string','max:100'],
        'email' => ['required','email','unique:admins'],
        'passe' => ['required'],
        'confirme_pass' => ['required','same:passe']
       ]);

        admin::create([
            'Nom' => $request->nom,
            'Prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->passe
        ]);
        $message = "Créer avec succsès!";
            $AdminConnect = admin::latest('id')->first();
            // dd($etudiantConnect->id);
           if(session_status() === PHP_SESSION_NONE){ session_start();} 
            $_SESSION['Admin'] = $AdminConnect;
        return view('configuration');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session_start();
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
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
        session_start();
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session_start();
        if (isset($_SESSION['Admin'])) {
            return view('configuration'); 
        } else {
            $message = "Connectez-vous d'abord s'il vous plait !";
            return view('note_found', compact('message'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginAdmin(Request $request)
    {
         request()->validate([
            'email' => ['required','email'], 
            'password' => ['required']
        ]);

     $AdminConnect = admin::where('email','=',$request->email)
                                    ->where('password','=',$request->password)->first();
        // $test = admin::first();
        // dd($AdminConnect);

        if ($AdminConnect != NULL) {
         // if(session_status() === PHP_SESSION_NONE){ session_start();}
         // if (!isset($_SESSION)) { session_start(); } 
         session_start(); 
         $_SESSION['Admin'] = $AdminConnect;
         // dd($_SESSION['Admin']->Nom);
         return redirect()->route('config.index');
        } else {
            return back()->withErrors(["Erreur_Connect" =>"Nom d'utilisateur ou mot de passe incorect !"]);
        }
        

    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configGroupes(Request $request)
    {
        /* Repartition des étudiants dans des groupes */
        request()->validate([
            'nbGroupe' => ['required','numeric'],
            'NiveauId' => ['required'],
            'TpId' => ['required']
        ]);
/*        $LiesteEtuInscrit = Inscrit::whereHas(
        'etudiant' , function($query) {
            // $query->where('Nom', 'OUATTARA');
            // $query->orderBy('Prenom', 'ASC');
        })->with('etudiant')->orderBy('Prenom', 'ASC')->get(); DESC

        $ClientsNonServie = bilanEtudiant::with('etudiant')
          ->where('ticket', 'like', $nomGuichet.'-%')
          ->where('created_at', '>', $dd.' 00:00:00')
          ->where('etat', '=', 0)
          ->get();
*/

$anneActive = AnneeUniv::where('etat','=','Active')->first();
$LiesteEtuInscrit = Inscrit::with('etudiant')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$request->NiveauId)
                    ->where('TPs_id','=',$request->TpId)
                    ->orderBy(Etudiant::select('Nom')->whereColumn('id','=','inscrits.Etudiants_id'),'ASC')->get();

$cpt=0;
$nbGr = 1;
$GExist = Groupe::where('numeroG','=','1')->first();
if ($GExist == NULL) {
    Groupe::create(['numeroG' => '1']);
    $idG = Groupe::latest('id')->first();
}else{$idG = $GExist->id; echo 'Comme le groupe est là son id='.$idG;}

foreach ($LiesteEtuInscrit as  $inscrit) {
    echo $inscrit->etudiant->Nom; echo '<pre>  </pre>';
    // dd($LiesteEtuInscrit);
    $cpt++;
    if (($cpt-1) == $request->nbGroupe) {
        echo 'cpt='.$cpt.' <br>';
        $cpt=1;
        $nbGr++;
        echo 'nbGr = '.$nbGr.'<br>';
        $GExist = Groupe::where('numeroG','=',$nbGr)->first();
        // echo 'nbGr trouve = '.$GExist->numeroG.' <br>';
        if ($GExist == NULL) {
            Groupe::create(['numeroG' => $nbGr]);
            $idG = Groupe::latest('id')->first();
            echo ' Comme il n est pas là je le crée <br>';
        }else{$idG = $GExist->id; echo 'nbGr trouve = '.$GExist->numeroG.' <br>';}
    }
    $inscrit->update([
        'Groupes_id' => $idG
    ]);
    echo 'Update OK <br><br><br>';
    // dd('Stop');
}

// update `inscrits` set `Groupes_id` = {"id":17,"numeroG":3,"Salles_id":null,"created_at":"2022-10-25T15:59:55.000000Z","updated_at":"2022-10-25T15:59:55.000000Z"}, `inscrits`.`updated_at` = 2022-10-25 15:59:55 where `id` = 24
// dd('OK');

        $message = "Modifier avec succsès!";
        return redirect()->route('configGroupe.index');

    }







        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configFiltreG($idNiveau,$idTP)
    {
        if (!isset($_SESSION)) { session_start(); }

        if (!isset($_SESSION['Admin'])) {
            $message = "Connectez-vous d'abord en tant que admin s'il vous plait !";
            return view('note_found', compact('message'));
        }
        $anneActive = AnneeUniv::where('etat','=','Active')->first();
        $LiesteEtuInscrit = Inscrit::with('etudiant')
                    ->where('AnneeUnivs_id','=',$anneActive->id)
                    ->where('Niveaus_id','=',$idNiveau)
                    ->where('TPs_id','=',$idTP)->get();
     dd($LiesteEtuInscrit->count());
        // return 'nbEtu, nbGroupe, nb par groupe';


     $reponseFiltre = array('nbEtudiant' => trim($bEtudiantAppel[0]['idBilan']), 
                            'nbGroupe' => trim($bEtudiantAppel[0]['ticket']), 
                            'nbParGroupe' => trim($bEtudiantAppel[0]['guichet'])
                        );


        return view('',compact(''));
    }

}
