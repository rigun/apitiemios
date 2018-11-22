<?php

namespace App\Http\Controllers;

use App\Arsip;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('/images/arsip');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Arsip::all();
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
            'arsip' => 'required|max:255',
            'user_id' => 'required'
          ]);

          $photos = $request->file('file');
 
          if (!is_array($photos)) {
              $photos = [$photos];
          }
  
          if (!is_dir($this->photos_path)) {
              mkdir($this->photos_path, 0777);
          }
  
          $photo = $photos[0];
          $name = sha1(date('YmdHis') . str_random(30));
          $save_name = $name . '.' . $photo->getClientOriginalExtension();
  
          $photo->move($this->photos_path, $save_name);

          $item = new Arsip();
          $item->arsip = $request->arsip;
          $item->filename = $save_name;
          $item->originalName = basename($photo->getClientOriginalName());
          $item->user_id = $request->user_id;
          $item->save();

          return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Arsip::where('id',$id)->first();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function edit(Arsip $arsip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validateWith([
            'arsip' => 'required|max:255'
          ]);
          $item = Arsip::find($id);
              if (empty($item)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
            }else{
                $photos = $request->file('file');

                if($photos){
                    $file_path = $this->photos_path . '/' . $item->filename;
    
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
    
                    if (!is_array($photos)) {
                        $photos = [$photos];
                    }
    
                    if (!is_dir($this->photos_path)) {
                        mkdir($this->photos_path, 0777);
                    }
    
                    $photo = $photos[0];
                    $name = sha1(date('YmdHis') . str_random(30));
                    $save_name = $name . '.' . $photo->getClientOriginalExtension();
                    $photo->move($this->photos_path, $save_name);
    
                    $item->filename = $save_name;
                    $item->originalName = basename($photo->getClientOriginalName());
                }
                
              $item->arsip = $request->arsip;
              $item->save();
    
              return $item;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = Arsip::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }
 
        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }
}
