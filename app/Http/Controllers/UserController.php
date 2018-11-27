<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Auth;
class UserController extends Controller
{

    public function register(Request $request)
    {
        if(User::where('email', '=', $request->email)->exists()){
            return response()->json(['message' => 'Email Sudah Ada', 'status'=> '440'], 400);
        }
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->token = bin2hex(random_bytes(64));
      $user->save();
      $user->syncRoles(explode(',', "user"));
      
      Auth::login($user);

      return response()->json(['message' => 'Pendaftaran Berhasil, Silahkan Lakukan Verifikasi Email', 'status'=> '200'], 400);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$user = Auth::attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }else{
          $token = Auth::user()->token;
      }

      return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
      
      return response()->json([
        'access_token' => $token,
        'name' => Auth::user()->name,
        'user_id' => Auth::user()->id,
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
        $item = User::where('id',$id)->with('catatan','arsip','jadwal')->first();
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
        $this->validateWith([
            'name' => 'required',
        
          ]);
      $item = User::find($id);
      $item->name = $request->name;
      $item->save();
      return $item;
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validateWith([
            'password_lama' => 'required',
            'password_baru' => 'required',
          ]);
          $user = User::findOrFail($id);
          if(Hash::check($request->password_lama, $user->password)){
            $user->password = Hash::make($request->password_baru);    
            $json=['status' => 'success','msg'=>'Password berhasil diubah'];
          }else{
            $json=['status' => 'failed','msg'=>'Password yang anda masukkan salah, silahkan coba lagi'];
          }
          $user->save();
          
          return response()->json($json);
    }
    public function verifikasi($token)
    {
          $user = User::where('token', $token)->first();
          $user->status = 1;
          $user->save();
          return 'Verifikasi Berhasil';
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
