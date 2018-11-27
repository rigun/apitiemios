<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
class UserController extends Controller
{

    public function register(Request $request)
    {
        if(User::where('email', '=', $request->email)->exists()){
            return response()->json(['message' => 'Email Sudah Ada'], 400);
        }
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->token = bin2hex(random_bytes(64));
      $user->save();
      $user->syncRoles(explode(',', "user"));
      
      Auth::login($user);

      return response()->json(['message' => 'Pendaftaran Berhasil'], 400);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$user = Auth::attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }else{
          $token = Auth::user()->first()->token;
      }

      return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
      
      return response()->json([
        'access_token' => $token,
        'status' => Auth::user()->status,
        'role' => Auth::user()->roles()->first()->name
      ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = User::all();
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

          $item = new User();
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::where('id',$id)->with('catatan','arsip','detail','jadwal')->first();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = User::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }else{
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }
}
