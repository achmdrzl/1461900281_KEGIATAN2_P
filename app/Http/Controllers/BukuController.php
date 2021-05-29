

<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


use DB;


use App\Buku;


use App\Kategori;
use App\Models\Buku as ModelsBuku;
use App\Models\Kategori as ModelsKategori;
use CreateBuku;
use CreateKategori;

class BukuController extends Controller


{


/**


     * Display a listing of the resource.


     *


     * @return \Illuminate\Http\Response


     */


public function index()


{


$buku = ModelsBuku::table('buku')


->join('kategori', 'buku.kategori_id', '=', 'kategori.kategori_nama')


->select('buku.buku_id','buku.buku_judul', 'buku.buku_deskripsi', 


'kategori.deskripsi as kategori', 'buku.buku_cover')


->get();


// return $buku;


return view('buku.index', compact('buku'));


}


/**


     * Show the form for creating a new resource.


     *


     * @return \Illuminate\Http\Response


     */


public function create()


{


$kategori = ModelsKategori::all();


return view('buku.create', compact('kategori'));


}


/**


     * Store a newly created resource in storage.


     *


     * @param  \Illuminate\Http\Request  $request


     * @return \Illuminate\Http\Response


     */


public function store(Request $request)


{


$this->validate($request, [


'buku_judul' => 'required',


'buku_deskripsi'  => 'required',


]);




$file = $request->file('buku_cover');


$buku = new BukuController;


$buku->judul_buku = $request->judul_buku;


$buku->deskripsi  = $request->deskripsi;


$buku->kategori   = $request->kategori;


$buku->cover_img  = $file->getClientOriginalName();




$tujuan_upload = 'image';


        $file->move($tujuan_upload,$file->getClientOriginalName());


$buku->save();


return redirect('buku')->with('msg','Data Berhasil di Simpan');


}


/**


     * Display the specified resource.


     *


     * @param  int  $id


     * @return \Illuminate\Http\Response


     */


public function show($id)


{


$buku = ModelsBuku::where('id_buku', $id)->first();


return $buku;


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




