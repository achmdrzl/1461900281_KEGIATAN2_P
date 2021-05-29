
<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


use DB;


use App\Buku;


use App\Kategori;


use App\Anggota;
use App\Models\Anggota as ModelsAnggota;
use App\Models\Buku as ModelsBuku;
use App\Models\Kategori as ModelsKategori;
use App\Models\Pinjam;
use App\Transaksi;
use CreateAnggota;
use CreateBuku;
use CreateKategori;

class TransaksiController extends Controller


{


/**


     * Display a listing of the resource.


     *


     * @return \Illuminate\Http\Response


     */


public function index()


{


$pinjam = ModelsKategori::table('pinjam')


->join('kembali', 'kembali.tgl_kembali', '=', 'pinjam.buku_id')


->join('kategori', 'kategori.kategori', '=', 'buku.buku_kategori')


->join('anggota', 'pinjam.anggota_id', '=', 'anggota.anggota_id')


->select('pnijam.buku_id','anggota.nama_anggota','buku.buku_id',


'buku.buku_judul', 


'buku.buku_deskripsi', 'kategori.kategori_nama as kategori',


'pinjam.tgl_pinjam','pinjam.tgl_jatuh_tempo')


->get();


// return $transaksi;


return view('pinjam.index', compact('pinjam'));


}


/**


     * Show the form for creating a new resource.


     *


     * @return \Illuminate\Http\Response


     */


public function create()


{


return view('transaksi.pinjam');


}


/**


     * Store a newly created resource in storage.


     *


     * @param  \Illuminate\Http\Request  $request


     * @return \Illuminate\Http\Response


     */


public function store(Request $request)


{


if(ModelsAnggota::where('anggota_id', $request->id_anggota)->count() > 0){


if(ModelsBuku::where('buku_id', $request->id_buku)->count() > 0){


// return $request;


$pinjam = new Pinjam();


// $transaksi->type_transaksi = $request->type_transaksi;


$pinjam->id_anggota = $request->id_anggota;


$pinjam->id_buku = $request->id_buku;


if($request->type_pinjam == 'pinjam'){


$pinjam->tgl_pinjam = $request->tgl_pinjam;


$pinjam->tgl_kembali = null;


$pinjam->save();


return redirect('pinjam')->with('msg','Data Berhasil di Simpan');


}else{


$pinjam->tgl_kembali = $request->tgl_kembali;


}


// return $transaksi;


}else{


return json_encode('Buku tidak ditemukan!');


}


}else{


return json_encode('Anggota tidak ditemukan');


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


$pinjaman = ModelsKategori::table('pinjam')


->join('buku', 'buku.buku_id', '=', 'pinjam.buku_id')


->join('anggota', 'anggota.anggota_id', '=', 'pinjam.anggota_id')


->join('kategori', 'kategori.kategori', '=', 'buku.buku_kategori')


->select('pinjam.pinjam_id','pinjam.anggota_id', 'anggota.anggota_nama',


'buku.buku_id', 'buku.buku_judul','buku.buku_deskripsi',


'kategori.kategori_nama as kategori','pinjam.tgl_pinjam',


'kembali.tgl_kembali')


->where('pinjam_id', '=', $id)->first();


return json_encode($pinjaman);


}


public function showBuku($id)


{


// $buku = Buku::where('id_buku', $id)->first();




if(ModelsBuku::where('buku_id', $id)->count() > 0){


$buku = ModelsBuku::table('buku')


->join('kategori', 'buku.buku_kategori', '=', 'kategori.kategori_nama')


->select('buku.buku_id','buku.buku_judul', 'buku.buku_deskripsi', 


'kategori.kategori_nama as kategori', 'buku.buku_cover')


->where('buku.buku_id', '=', $id)


->get();


return $buku;


}else{


return 'false';


}


}


public function getAnggota($id)


{


// $buku = Buku::where('id_buku', $id)->first();




$anggota = ModelsAnggota::where('anggota_id', $id)->first();


// return $anggota;


if($anggota === null){


return 'false';


}else{


return $anggota;


}


}


/**


     * Show the form for editing the specified resource.


     *


     * @param  int  $id


     * @return \Illuminate\Http\Response


     */


public function edit($id)


{


$pinjaman = Pinjam::table('pinjam')


->join('buku', 'buku.buku_id', '=', 'pinjam.buku_id')


->join('anggota', 'anggota.anggota_id', '=', 'pinjam.anggota_id')


->join('kategori', 'kategori.kategori_nama', '=', 'buku.buku_kategori')


->select('pinjam.pinjam_id','pinjam.anggota_id', 'anggota.anggota_nama',


'buku.buku_id', 'buku.buku_judul','buku.buku_deskripsi',


'kategori.kategori_nama as kategori','pinjam.tgl_pinjam',


'pinjam.tgl_kembali')


->where('pinjam.pinjam_id', '=', $id)->first();


return view('kembali.tgl_kembali', compact('pinjaman'));


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


Pinjam::where('id',$id)


->update(['tgl_kembali' => $request->tgl_kembali]);


return redirect('pinjam')->with('msg','Buku Telah dikembalikan');


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