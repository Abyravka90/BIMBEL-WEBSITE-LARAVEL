<?php

namespace App\Http\Controllers;

use App\Program;
use App\Edulevel;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // menampilkan data yang sudah masuk trash
        // $programs = Program::withTrashed()->get();
        // menampilkan data yang hanya di trash
        // $programs = Program::onlyTrashed()->get();
        // tampilkan semua data
        // $programs = Program::all();

        // $programs = Program::with('edulevel')->simplePaginate(2);
        $programs = Program::with('edulevel')->paginate(2);
        return view('program.index')->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $edulevels = Edulevel::all();
        return view('program.create')->with('edulevels', $edulevels);
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
        $request->validate([
            'name' => 'required|min:2',
            'edulevel_id' => 'required',
            'student_price' => 'required',
            'student_max' => 'required',
        ],[
            'name.required' => 'Nama Program Tidak Boleh Kosong',
            'edulevel_id.required' => 'Pilih Salah Satu Jenjang',
            'student_price.required' => 'Harga Member Tidak Boleh Kosong',
            'student_max.required' => 'Jumlah Siswa maksimum tidak boleh kosong'
        ]);
        // Cara 1 :
        // $program = new Program;
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        // Cara 2 :
        // Program::create([
        //     'name' => $request->name,
        //     'edulevel_id' => $request->edulevel_id,
        //     'student_price' => $request->student_price,
        //     'student_max' => $request->student_max,
        //     'info' => $request->info
        // ]);
        
        // Cara 3 : quick mass assignment > syarat : field tabel dan nama inputan harus sama
        // Program::create($request->all());

        // Cara 4 : gabungan
        $program = Program::create([
            'name'=> $request->name,
            'edulevel_id' => $request->edulevel_id,
            'student_price' => $request->student_price,
            'student_max' => $request->student_max,
            'info' => $request->info
        ]);
        $program->student_max = 20;
        $program->save();

        return redirect('programs')->with('status', 'Data Program Berhasil ditambahkan');
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        // $program->makeHidden(['edulevel_id','updated_at']);
        
        return view('program.show')->with('program', $program);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $edulevels = Edulevel::all();
        // return view('program.edit', compact('program','edulevels'));
        return view('program.edit', ['program' => $program, 'edulevels'=>$edulevels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|min:2',
            'edulevel_id' => 'required',
            'student_price' => 'required',
            'student_max' => 'required',
        ],[
            'name.required' => 'Nama Program Tidak Boleh Kosong',
            'edulevel_id.required' => 'Pilih Salah Satu Jenjang',
            'student_price.required' => 'Harga Member Tidak Boleh Kosong',
            'student_max.required' => 'Jumlah Siswa maksimum tidak boleh kosong'
        ]);

        // cara 1 : 
        // $program = new Program;
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        // cara 2 :
        Program::where('id', $program->id)
        ->update([
                'name' => $request->name,
                'edulevel_id' => $request->edulevel_id,
                'student_price' => $request->student_price,
                'student_max' => $request->student_max,
                'info' => $request->info            
        ]);
        return redirect('programs')->with('status', 'Data Berhasil di Rubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        // cara 1:
        // $program->delete();
        
        // cara 2:
        // Program::destroy($program->id);

        // cara 3
        Program::where('id', $program->id)->delete();

        // kalau menggunakan softDeletes mau dipaksa hapus pakai ini
        // $program->forceDelete();
        return redirect('programs')->with('status', 'Data Berhasil Di Hapus');
    }

    public function trash()
    {
        $programs = Program::onlyTrashed()->get();
        return view('program.trash', ['programs' => $programs ]);
    }

    public function restore($id = null)
    {
        if($id != null)
        {
            $programs = Program::onlyTrashed()->where('id', $id)->restore();
        } else{
            $programs = Program::onlyTrashed()->restore();
        }
        return redirect('programs/trash')->with('status', 'Data Berhasil Di Restore');
    }

    public function delete($id = null)
    {
        if($id != null)
        {
            $programs = Program::onlyTrashed()->where('id', $id)->forceDelete();
        } else{
            $programs = Program::onlyTrashed()->forceDelete();
        }
        return redirect('programs/trash')->with('status', 'Data Berhasil Di Hapus permanen!'); 
    }
}
