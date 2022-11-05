<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
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
        //
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

        echo $request->id_G;
        echo $request->idNiveau;
        echo $request->tpId;
        dd();
        request()->validate([
            'id_G' => ['required','string','max:30'], 
            'idNiveau' => 'required'
            'tpId' => 'required'
        ]);
        Groupe::create([
            'LibelleG' => $request->LibelleGroupe,
            'Salles_id' => $request->SalleId
        ]);

        return view('testeTableCellesEdite');   
    }
}


