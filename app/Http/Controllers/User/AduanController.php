<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Area;
use App\Models\Barang;
use App\Models\Claim;
use App\Models\Kategori;
use App\Models\Statiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $aduans =    DB::table('aduans', 'items')->get()->where('user_id', Auth::user()->id);


        // $aduans = $aduan->paginate(5);



        return view('users.aduan', compact('aduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //



        // dd(Aduan::firstwhere(Auth::user()->id));
        $stasiuns = Statiun::all();
        $areas = Area::all();
        $kategoris = Kategori::all();
        return view('users.bikin-aduan', compact('kategoris', 'stasiuns', 'areas'));
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

        // Simpan data aduan
        $aduan = Aduan::create([
            'id' => rand(0, 999999),
            'user_id'  => Auth::user()->id,
            'namabarang' => $request->namabarang,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'tglketinggalan' => $request->tglketinggalan,
            'stasiun_id' => $request->stasiun_id,
            'area_id' => $request->area_id,
            'keteranganlain' => $request->keteranganlain,
            'foto' => 'default.png', // Placeholder, atau ambil foto pertama nanti
        ]);

        // Proses upload multiple image
        if($request->hasfile('foto'))
        {
            $firstImage = true;
            foreach($request->file('foto') as $file)
            {
                $name = $file->hashName();
                $file->storeAs('public/assets/img/aduan', $name);  

                // Jika ini foto pertama, jadikan sebagai thumbnail di tabel aduans
                if ($firstImage) {
                     $aduan->update(['foto' => $name]);
                     $firstImage = false;
                }

                // Simpan ke tabel aduan_images
                \App\Models\AduanImage::create([
                    'aduan_id' => $aduan->id,
                    'image_path' => $name,
                ]);
            }
        }

        if ($aduan) {
            return redirect()->route('aduan');
        } else {
            return redirect()->route('bikinaduan');
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

        $aduan = Aduan::find($id);
        $stasiun_id = $aduan->kategori_id;

        // $items =  DB::table('barangs')->where('stasiun_id', $stasiun_id)->get();
        $items = Barang::all()->whereIn('kategori_id', $stasiun_id);

        return view('users.detail-aduan', compact('aduan', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function claim(Request $request)
    {

        $aduan = $request->aduan_id;
        $items = $request->barang_id;

        return view('users.claim-aduan', compact('aduan', 'items'));
    }
    public function postclaim(Request $request)
    {
        // Validasi
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

        // Placeholder untuk foto utama
        $primaryImageName = 'default.png';

        // Simpan Data Claim
        $aduan = Claim::create([
            'id' => rand(0, 999999),
            'user_id'  => Auth::user()->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
            'barang_id' => $request->barang_id,
            'aduan_id' => $request->aduan_id,
            'foto' => $primaryImageName,
        ]);

        // Proses multiple image
        if($request->hasfile('foto'))
        {
            $firstImage = true;
            foreach($request->file('foto') as $file)
            {
                $name = $file->hashName();
                $file->storeAs('public/assets/img/claim', $name);  

                // Set foto pertama sebagai thumbnail utama
                if ($firstImage) {
                     $aduan->update(['foto' => $name]);
                     $firstImage = false;
                }

                // Simpan ke detail images
                \App\Models\ClaimImage::create([
                    'claim_id' => $aduan->id,
                    'image_path' => $name,
                ]);
            }
        }

        if ($aduan) {
            return redirect('postclaimdetail/' . $aduan->id);
        } else {
            return redirect()->back();
        }
    }

    public function postclaimdetail(Request $request)
    {

        // dd($request->id);

        $collection = Claim::with(['images', 'barang.images', 'aduan.images'])->find($request->id);
        return view('users.claim-aduan-detail', compact('collection'));
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
