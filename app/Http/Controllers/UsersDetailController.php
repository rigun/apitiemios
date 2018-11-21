<?php

namespace App\Http\Controllers;

use App\UsersDetail;
use Illuminate\Http\Request;
use App\User;
class UsersDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = UsersDetail::all();
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
            'tanggalLahir' => 'required',
            'nomorHp' => 'required',
            'jenisKelamin' => 'required',
            'user_id' => 'required'
          ]);

          $item = new UsersDetail();
          $item->tanggalLahir = $request->tanggalLahir;
          $item->nomorHp = $request->nomorHp;
          $item->jenisKelamin = $request->jenisKelamin;
          $item->user_id = $request->user_id;
          $item->save();

          return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsersDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::where('id',$id)->with('detail')->first();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsersDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersDetail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsersDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateWith([
            'detail' => 'required|max:255',
          ]);

          $user = User::findOrFail($id);
          if($user)
          {
            if($request->name != null){
                $user->name = $request->name;
            }
            $item = UsersDetail::where('user_id', $id)->first();
            $item->detail = $request->detail;
            $item->tanggalLahir = $request->tanggalLahir;
            $item->nomorHp = $request->nomorHp;
            $item->jenisKelamin = $request->jenisKelamin;
            $item->save();  
              return $item;
          }else{
              return 'gagal';
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsersDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = UsersDetail::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }else{
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }
}
