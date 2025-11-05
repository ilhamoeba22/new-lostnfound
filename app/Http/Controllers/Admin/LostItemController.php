<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua aduan dengan relasi kategori dan stasiun
        $collection = Aduan::with(['kategori', 'stasiun'])
            ->latest()
            ->paginate(10);

        // Ambil hanya stasiun yang muncul di data aduan
        $stasiuns = $collection
            ->pluck('stasiun')   // Ambil relasi stasiun dari setiap aduan
            ->filter()           // Hapus null
            ->unique('id')       // Ambil yang unik
            ->values();          // Reset index

        return view('admin.lostitems', compact('collection', 'stasiuns'));
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

        $collection =  Aduan::find($id);

        return view('admin.detail-lostitems', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    public function update(Request $request)
    {

        $id = $request->id;

        $aduan = Aduan::find($id);
        $aduan->status = '1';
        $aduan->save();


        if ($aduan) {
            //redirect dengan pesan sukses
            return redirect()->route('lostitems')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('lostitems')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;

        $aduan = Aduan::find($id);
        $aduan->status = '2';
        $aduan->save();


        if ($aduan) {
            //redirect dengan pesan sukses
            return redirect()->route('lostitems')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('lostitems')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
