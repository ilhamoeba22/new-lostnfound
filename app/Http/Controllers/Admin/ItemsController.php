<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Statiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{

    public function index()
    {
        //
        $collection = Barang::all();
        return view('admin.items', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $stasiuns = Statiun::all();
        $areas = Area::all();
        return view('admin.tambah-items', compact('kategoris', 'stasiuns', 'areas'));
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
        // Validasi input
        $request->validate([
            'foto' => 'required',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('foto'))
        {
            if (count($request->file('foto')) > 3) {
                 return back()->withErrors(['foto' => 'Maksimal upload 3 foto.']);
            }
        }

        // Create Barang
        $barang = Barang::create([
            'id' => rand(0, 999999),
            'namabarang' => $request->namabarang,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'tglditemukan' => $request->tglditemukan,
            'stasiun_id' => $request->stasiun_id,
            'area_id' => $request->area_id,
            'foto' => 'default.png', // Placeholder
        ]);

        // Process Images
        if($request->hasfile('foto'))
        {
            $firstImage = true;
            foreach($request->file('foto') as $file)
            {
                $name = $file->hashName();
                $file->storeAs('public/assets/img/items', $name);  

                // Set first image as thumbnail
                if ($firstImage) {
                     $barang->update(['foto' => $name]);
                     $firstImage = false;
                }

                // Save to barang_images
                \App\Models\BarangImage::create([
                    'barang_id' => $barang->id,
                    'image_path' => $name,
                ]);
            }
        }

        if ($barang) {
            return redirect()->route('items');
        } else {
            return redirect()->route('tambahitems');
        }
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
        $collection = Barang::find($request->id);
        $kategoris = Kategori::all();
        $stasiuns = Statiun::all();
        $areas = Area::all();
        return view('admin.edit-items', compact('collection', 'stasiuns', 'kategoris', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $barang = Barang::findOrFail($request->id);

        $request->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if (count($request->file('foto')) > 3) {
                 return back()->withErrors(['foto' => 'Maksimal upload 3 foto.']);
            }
        }

        // Update Text Data
        $barang->update([
                'namabarang' => $request->namabarang,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'tglditemukan' => $request->tglditemukan,
                'stasiun_id' => $request->stasiun_id,
                'area_id' => $request->area_id,
        ]);

        // Process New Images if Uploaded
        if ($request->hasFile('foto')) {
            
            // Delete old images from DB and Storage (Optional, but cleaner)
            // Note: Keeping it simple, we just add new ones or replace logic.
            // Decision: Replace all images logic if user uploads new ones
            
            // 1. Delete old images files
            foreach($barang->images as $oldImage) {
                Storage::delete('public/assets/img/items/' . $oldImage->image_path);
                $oldImage->delete();
            }
            // Also delete the main thumbnail from storage if it differs? 
            // Actually relying on barang_images is better, but main foto column is separate.
            // Let's just overwrite everything.

            $firstImage = true;
            foreach($request->file('foto') as $file)
            {
                $name = $file->hashName();
                $file->storeAs('public/assets/img/items', $name);

                // Update thumbnail
                if ($firstImage) {
                     $barang->update(['foto' => $name]);
                     $firstImage = false;
                }

                \App\Models\BarangImage::create([
                    'barang_id' => $barang->id,
                    'image_path' => $name,
                ]);
            }
        }

        if ($barang) {
            //redirect dengan pesan sukses
            return redirect()->route('items');
        } else {
            //redirect dengan pesan error
            return redirect()->route('items');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
