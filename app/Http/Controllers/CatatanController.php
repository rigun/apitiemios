<?php

namespace App\Http\Controllers;

use App\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Catatan::all();
        return $item;
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
        $this->validateWith([
            'catatan' => 'required|max:255',
            'user_id' => 'required'
          ]);

          $item = new Catatan();
          $item->catatan = $request->catatan;
          $item->user_id = $request->user_id;
          $item->save();

          return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Catatan::where('id',$id)->first();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Catatan $catatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateWith([
            'catatan' => 'required|max:255',
          ]);

          $item = Catatan::findOrFail($id);
          $item->catatan = $request->catatan;
          $item->save();

          return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = Catatan::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }else{
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }
}
