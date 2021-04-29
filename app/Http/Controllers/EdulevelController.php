<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdulevelController extends Controller
{
    //
    public function data(){
        $edulevels = DB::table('edulevels')->paginate(2);
        return view('edulevel.data', ['edulevels' => $edulevels]);
    }

    public function add(){
        return view('edulevel.add');
    }

    public function addProcess(Request $request){
        $request->validate(
            [
                'name' => 'required|min:2',
                'desc' => 'required'
            ],[
                'name.required' => 'Field Nama Tidak Boleh Kosong',
                'desc.required' => 'Field Deskripsi Tidak Boleh Kosong'
            ]
            );
        DB::table('edulevels')->insert(
            [
                'name' => $request->name,
                'desc' => $request->desc
            ]
        );
        return redirect('edulevels')->with('status', 'Jenjang Berhasil Ditambah!');
    }
    
    public function edit($id){
        $edulevels = DB::table('edulevels')->where('id', $id)->first(); 
        return view('edulevel.edit')->with('edulevels', $edulevels);
    }

    public function editProcess(Request $request, $id){
        $request -> validate(
            [
                'name'=>'required|min:2',
                'desc'=>'required'
            ],[
                'name.required' => 'Field Nama Tidak Boleh Kosong',
                'desc.required' => 'Field Deskripsi Tidak Boleh Kosong'
            ]);
        $edulevels = DB::table('edulevels')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'desc' => $request->desc
                    ]);
        return redirect('edulevels')->with('status', 'Jenjang Berhasil Diupdate!');
    }

    public function delete($id){
        DB::table('edulevels')->where('id', $id)->delete();
        return redirect('edulevels')->with('status', 'Data berhasil dihapus');
    }
}
