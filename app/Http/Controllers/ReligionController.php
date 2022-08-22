<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Religion::all();

        return view('religion', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahagama()
    {
        return view('tambahagama');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertagama(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2|max:45'
        ]);

        $data = Religion::create($request->all());
        return redirect('religion')->with('success', 'AGAMA Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function tampilagama($id)
    {
        $data = Religion::find($id);
        return view('tampilagama', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function updateagama(Request $request, $id)
    {
        $data = Religion::find($id);
        $data->update($request->all());
        return redirect('religion')->with('success', 'Data Berhasil Di Update!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Religion $religion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function deleteagama(Religion $id)
    {
        Religion::destroy($id->id);

        return redirect('religion')->with('success', 'Agama sudah dihapus!');
    }
}
