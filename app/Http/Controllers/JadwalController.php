<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Jadwal::all();
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
            'jadwal' => 'required|max:255',
            'tempat' => 'required',
            'mulai' => 'required',
            'tanggal' => 'required',
            'user_id' => 'required'
          ]);

          $item = new Jadwal();
          $item->jadwal = $request->jadwal;
          $item->tempat = $request->tempat;
          $item->mulai = $request->mulai;
          $item->tanggal = $request->tanggal;
          $item->user_id = $request->user_id;
          $item->save();

          return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Jadwal::where('id',$id)->first();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateWith([
            'jadwal' => 'required|max:255',
          ]);

          $item = Jadwal::findOrFail($id);
          $item->jadwal = $request->jadwal;
          $item->tempat = $request->tempat;
          $item->mulai = $request->mulai;
          $item->tanggal = $request->tanggal;
          $item->save();

          return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = Jadwal::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }else{
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }
}
