<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistik;
use Illuminate\Support\Facades\Storage;

class inventoryController extends Controller
{
    public function index(){ //read

        $inventory = logistik::all();

        return view('logistik.index', compact('inventory'));
    }
    
    public function create(){ //create
        return view('logistik.create');
    }

    public function store(Request $request){ //store
        $this -> validate($request, [
            'foto'=>'required|image|mimes:jpeg,png,jpg',
            'nama'=>'required',
            'deskripsi'=>'required',
        ]);

        $foto = $request->file('foto');
        $foto -> storeAs('public/foto', $foto->hashName());

        logistik::create([
            'foto'=> $foto->hashName(),
            'nama'=> $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        
        return redirect()->route('logistik.index');
    }

    public function edit(logistik $logistik){ //edit
        return view('logistik.editLogistik', compact('logistik'));
    }

    public function update(Request $request, logistik $logistik){

        $this -> validate($request, [
            'foto'=>'required|image|mimes:jpeg,png,jpg',
            'nama'=>'required',
            'deskripsi'=>'required',
        ]);

        if($request -> file ('foto')){

            //upload image
            $foto = $request->file('foto');
            $foto -> storeAs('public/foto', $foto->hashName());

            //delete yg lama
            Storage::delete('public/foto/', $logistik->foto);

            //update inventory dengan new image
            $logistik->update([
                'foto'=> $foto->hashName(),
                'nama'=> $request->nama,
                'deskripsi'=> $request->deskripsi,
            ]);
        } else {
            //update inven tnpa image
            $logistik->update([
                'foto'=> $request->nama,
                'deskripsi'=> $request->deskripsi,
            ]);
        }

        //return
        return redirect()->route('logistik.index');
    }

    public function destroy(logistik $logistik){
        Storage::delete('public/foto/' . $logistik->foto);

        $logistik->delete();

        return redirect()->route('logistik.index');
    }
}
